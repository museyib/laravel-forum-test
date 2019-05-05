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

    public function store(TopicFormRequest $request)
    {
        $topic=new Topic();
        $topic->title=$request->get('title');
        $topic->subforum_id=$request->get('subforum_id');
        $topic->user_id=$request->get('user_id');

        $topic->save();

        $post=new Post();
        $post->content=$request->get('content');
        $post->topic_id=$topic->id;
        $post->user_id=$topic->user_id;

        $post->save();

        return redirect()->action('TopicController@show', [
            'parent'=>Subforum::find($topic->subforum_id),
            'topic'=>$topic
            ])->with('message', 'New topic created');
    }

    public function show($parent, $topic)
    {
        try
        {
            $topic=Topic::where('id', $topic)->first();
            $parent=Subforum::find($parent);
            return view('forum.topics.show', compact('topic', 'parent'));
        }
        catch (\Exception $exception)
        {
            abort(404);
        }
    }
}
