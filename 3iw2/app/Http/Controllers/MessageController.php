<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all(['id', 'content', 'author_name', 'published_at']);

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'min:3'],
            'author_name' => ['required', 'min:1', 'max:255'],
        ]);

        $message = new Message();
        $message->content = $validatedData['content'];
        $message->author_name = $validatedData['author_name'];
        $message->save();

        return to_route('messages.index');
    }
}
