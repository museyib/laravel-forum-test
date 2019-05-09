<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicFormRequest;
use App\Post;
use App\Subforum;
use App\Topic;

class TopicController extends Controller
{
    public function index()
    {
        return view('forum.topics.index');
    }

    public function create(Subforum $parent)
    {
        return view('forum.topics.create', compact('parent'));
    }

    public function store()
    {
        $topic=Topic::create(request()->validate([
            'title'=>'required|min:3',
            'subforum_id'=>'required',
            'user_id'=>'required'
        ]));

        Post::create([
           'content'=>request('content'),
           'topic_id'=>$topic->id,
           'user_id'=>request('user_id')
        ]);

        return redirect()->route('topics.show', [
            'parent'=>Subforum::find($topic->subforum_id),
            'topic'=>$topic
            ])->with('message', 'New topic created');
    }

    public function show($parent, $topic)
    {
        $topic=Topic::where('id', $topic)->first();
        $parent=Subforum::find($parent);
        return view('forum.topics.show', compact('topic', 'parent'));
    }
}
