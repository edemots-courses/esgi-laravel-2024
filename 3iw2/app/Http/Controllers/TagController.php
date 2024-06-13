<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query()
            ->select(['name', 'slug', 'color'])
            // ->orderBy('created_at', 'desc')
            // ->orderByDesc('created_at')
            ->latest()
            ->paginate();

        // return view('tags.index', ['tags' => $tags]);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'color' => ['required', 'hex_color', 'max:7'],
        ]);

        $color = Str::after($validatedData['color'], '#');
        $i = 0;
        do {
            $slug = Str::slug($validatedData['name'], language: 'fr');
            if ($i > 0) {
                $slug .= "-{$i}";
            }
            $i++;
        } while (Tag::query()->where('slug', '=', $slug)->exists());

        $tag = new Tag();
        $tag->name = $validatedData['name'];
        $tag->slug = $slug;
        $tag->color = $color;
        $tag->save();

        return to_route('tags.index')->with('success', 'Votre tag a été ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'color' => ['required', 'hex_color', 'max:7'],
        ]);

        $color = Str::after($validatedData['color'], '#');

        $tag->name = $validatedData['name'];
        $tag->color = $color;
        $tag->save();

        return to_route('tags.show', compact('tag'))->with('success', 'Votre tag a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return to_route('tags.index')->with('success', 'Le tag a bien été supprimé.');
    }
}
