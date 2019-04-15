<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=new Post();
        $post->content=$request->get('content');
        $post->topic_id=$request->get('topic_id');
        $post->user_id=$request->get('user_id');
        $post->save();
        $topic=Topic::all()->where('id', $post->topic_id)->first();
        $topic->updated_at=new \DateTime();
        $topic->save();

        return redirect()->action('TopicController@show', ['id'=>$post->topic_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $subforum_id=$post->subforum_id;
        return view('forum.posts.edit', compact('post', 'subforum_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->content=$request->get('content');
//        $post->topic_id=$request->get('topic_id');
//        $post->user_id=$request->get('user_id');
        $post->updated_at=new \DateTime();
        $post->update();
//        $topic=Topic::all()->where('id', $post->topic_id)->first();

        return redirect()->action('TopicController@show', ['id'=>$post->topic_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
