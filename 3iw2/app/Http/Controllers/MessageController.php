<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::query()
            ->select(['id', 'content', 'published_at', 'user_id'])
            ->orderBy('published_at', 'desc')
            ->with(['user:id,name', 'tags:id,name,slug,color'])
            ->when($request->has('tags'), function (Builder $query) use ($request) {
                // 1.
                // $query->join('message_tag', 'messages.id', '=', 'message_tag.message_id')
                //     ->join('tags', 'tags.id', '=', 'message_tag.tag_id')
                //     ->where('tags.slug', '=', $request->query('tags'));
                // 2.
                // $query->whereHas('tags', function (Builder $query) use ($request) {
                //     $query->where('slug', '=', $request->query('tags'));
                // });
                // 3.
                $query->whereRelation('tags', 'slug', $request->query('tags'));
            })
            ->get();

        $tags = Tag::query()
            ->select(['id', 'name', 'slug'])
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
