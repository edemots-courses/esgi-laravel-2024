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
            ->select(['id', 'content', 'user_id'])
            // ->orderBy('created_at', 'asc')
            // ->orderBy('created_at')
            ->oldest()
            ->with(['user:id,name'])
            ->get();

        return view('messages.index', [
            'toto' => $messages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Auth::id();
        // auth()->id();
        // $request->user()->id;
        $message = new Message();
        $message->content = $request->get('content');
        // $message->user_id = $request->user()->id;
        $message->user()->associate($request->user());
        $message->save();

        // return redirect()->route('messages.index');
        // return to_route('messages.index');
        return back()->with('success', "Le message a bien été créé.");
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
        if ($request->user()->id !== $message->user_id) {
            return abort(403);
        }

        $message->content = $request->get('content');
        $message->save();

        return back()->with('success', "Le message a bien été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Message $message)
    {
        abort_if($request->user()->isNot($message->user), 403);

        $message->delete();

        return back()->with('success', "Le message de {$message->author_name} a bien été supprimé.");
    }
}