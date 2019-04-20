<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function reply($topic, $post)
    {
        return view('forum.topics.reply', compact('topic', 'post'));
    }


    public function store(Request $request)
    {
        $post=new Post();
        $post->content=$request->get('content');
        $post->topic_id=$request->get('topic_id');
        $post->user_id=$request->get('user_id');
        if (! is_null($request->get('reply_to')))
        {
            $post->reply_to=$request->get('reply_to');
        }
        $post->save();
        $topic=Topic::where('id', $post->topic_id)->first();
        $topic->updated_at=new \DateTime();
        $topic->save();

        return redirect()->action('TopicController@show', ['topic'=>$post->topic_id, 'parent'=>$topic]);
    }

    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        $subforum_id=$post->subforum_id;
        return view('forum.posts.edit', compact('post', 'subforum_id'));
    }


    public function update(Request $request, Post $post)
    {
        $post->content=$request->get('content');
        $post->updated_at=new \DateTime();
        $post->update();
        $topic=Topic::getById($post->topic_id);

        return redirect()->action('TopicController@show', ['topic'=>$post->topic_id, 'parent'=>$topic->subforum_id]);
    }
}
