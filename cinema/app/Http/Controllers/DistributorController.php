<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieDistributor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DistributorController extends Controller
{
    public function show(MovieDistributor $distributor)
    {
        $movies = Movie::query()
            ->select('id_film', 'titre')
            ->where('id_distributeur', $distributor->id_distributeur)
            ->get();

        $apiKey = env('OMDB_API_KEY');
        /** @var Movie $movie */
        foreach ($movies as $movie) {
            $omdbMovie = Cache::rememberForever("movie_{$movie->id_film}", function () use ($apiKey, $movie) {
                return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$movie->titre}")->json('Search');
            });
            if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
                $movie->poster = $omdbMovie[0]['Poster'];
            } else {
                $movie->poster = null;
            }
        }

        return view('distributor.show', compact('distributor', 'movies'));
    }
}
