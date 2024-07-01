<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::query()
            ->when($request->has('types'), function (Builder $query) use ($request) {
                $query->whereIn('id_genre', $request->get('types'));
            })
            ->with(['type', 'distributor'])
            ->paginate();

        $apiKey = env('OMDB_API_KEY');
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

        $types = MovieType::query()->get();

        return view('movie.index', compact('movies', 'types'));
    }

    public function show(Movie $movie)
    {
        $apiKey = env('OMDB_API_KEY');
        $omdbMovie = Cache::rememberForever("movie_{$movie->id_film}", function () use ($apiKey, $movie) {
            return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$movie->titre}")->json('Search');
        });

        if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
            $movie->poster = $omdbMovie[0]['Poster'];
        } else {
            $movie->poster = null;
        }

        $recommandations = Movie::query()
            ->whereRelation('type', 'id_genre', $movie->id_genre)
            ->whereKeyNot($movie->id_film)
            ->limit(5)
            ->get();

        foreach ($recommandations as $recommandation) {
            /** @var Movie $recommandation */
            $omdbMovie = Cache::rememberForever("movie_{$recommandation->id_film}", function () use ($apiKey, $recommandation) {
                return Http::get("http://www.omdbapi.com/?apikey={$apiKey}&s={$recommandation->titre}")->json('Search');
            });
            if ($omdbMovie && $omdbMovie[0] && array_key_exists('Poster', $omdbMovie[0]) && $omdbMovie[0]['Poster'] !== 'N/A') {
                $recommandation->poster = $omdbMovie[0]['Poster'];
            } else {
                $recommandation->poster = null;
            }
        }

        return view('movie.show', compact('movie', 'recommandations'));
    }
}
