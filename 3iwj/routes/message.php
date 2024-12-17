<?php

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/messages', function () {
    $messages = Message::query()
        ->select(['content', 'author_name'])
        // ->orderBy('created_at', 'asc')
        // ->orderBy('created_at')
        ->oldest()
        ->get();

    return view('messages.index', [
        'toto' => $messages,
    ]);
})->name('messages.index');

Route::post('/messages', function (Request $request) {
    $message = new Message();
    $message->author_name = $request->get('author_name');
    $message->content = $request->get('content');
    $message->save();

    // return redirect()->route('messages.index');
    // return to_route('messages.index');
    return back();
});
