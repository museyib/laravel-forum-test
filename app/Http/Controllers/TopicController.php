<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicFormRequest;
use App\Post;
use App\Subforum;
use App\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forum.topics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subforum_id)
    {
        return view('forum.topics.create', compact('subforum_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicFormRequest $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
