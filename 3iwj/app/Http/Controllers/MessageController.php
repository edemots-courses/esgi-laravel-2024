<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::query()
            ->select(['id', 'content', 'author_name'])
            // ->orderBy('created_at', 'asc')
            // ->orderBy('created_at')
            ->oldest()
            ->get();

        return view('messages.index', [
            'toto' => $messages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->author_name = $request->get('author_name');
        $message->content = $request->get('content');
        $message->save();

        // return redirect()->route('messages.index');
        // return to_route('messages.index');
        return back()->with('success', "Le message a bien été créé.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $message->author_name = $request->get('author_name');
        $message->content = $request->get('content');
        $message->save();

        return back()->with('success', "Le message a bien été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return back()->with('success', "Le message de {$message->author_name} a bien été supprimé.");
    }
}
