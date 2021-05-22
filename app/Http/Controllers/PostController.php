<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subforum;

class PostController extends Controller
{
    public function reply($subforum, $topic, $post)
    {
        return view('forum.topics.reply', compact('subforum', 'topic', 'post'));
    }


    public function store()
    {
        $post = Post::create(request()->validate([
            'content' => 'required',
            'topic_id' => 'required',
            'user_id' => 'required',
            'reply_to' => 'sometimes'

        ]));
        $topic = $post->topic;
        $topic->updated_at = new \DateTime();
        $topic->save();

        $parent = $topic->subforum;
        return redirect(route('topics.show',
                ['parent' => $parent->id, 'topic' => $topic->id]) . '#post_' . $post->id);
    }

    public function edit(Subforum $subforum, Post $post)
    {
        return view('forum.posts.edit', compact('post'));
    }


    public function update(Post $post)
    {
        $post->update(\request()->validate([
            'content' => 'required'
        ]));
        $post->updated_at = new \DateTime();
        $post->update();

        $topic = $post->topic;
        $parent = $topic->subforum;
        return redirect(route('topics.show',
                ['parent' => $parent->id, 'topic' => $topic->id]) . '#post_' . $post->id);
    }
}
