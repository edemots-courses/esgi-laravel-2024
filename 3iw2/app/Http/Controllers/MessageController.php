<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Tag;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::query()
            ->select(['id', 'content', 'published_at', 'user_id'])
            ->orderBy('published_at', 'desc')
            ->with(['user:id,name', 'tags:id,name,slug,color'])
            ->get();

        $tags = Tag::query()
            ->select(['id', 'name'])
            ->get();

        return view('messages.index', [
            'messages' => $messages,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'min:3'], // 'required|min:3|...'
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $message = new Message();
        $message->content = $validatedData['content'];
        // $message->user_id = Auth::id();
        // $message->user_id = auth()->id();
        // $message->user_id = $request->user()->id;
        $message->user()->associate($request->user());
        $message->save();

        $message->tags()->sync($validatedData['tags']);

        return to_route('messages.index');
    }
}
