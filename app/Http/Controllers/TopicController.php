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

    public function create($subforum_id)
    {
        return view('forum.topics.create', compact('subforum_id'));
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
            'parent'=>Subforum::getById($topic->subforum_id),
            'topic'=>$topic
            ])->with('message', 'New topic created');
    }

    public function show($parent, $topic)
    {
        try
        {
            $topic=Topic::where('id', $topic)->first();
            $parent=Subforum::getById($parent);
            return view('forum.topics.show', compact('topic', 'parent'));
        }
        catch (\Exception $exception)
        {
            abort(404);
        }
    }

    public function edit(Topic $topic)
    {
        //
    }

    public function update(TopicFormRequest $request, Topic $topic)
    {
        //
    }

    public function destroy(Topic $topic)
    {
        //
    }
}
