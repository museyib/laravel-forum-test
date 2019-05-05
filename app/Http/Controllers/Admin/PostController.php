<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Topic;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function destroy(Post $post)
    {
        $post->delete();
        $topic=Topic::find($post->topic_id);
        if (count($topic->posts)>0)
        {
            return back()->with('message', 'The post has been deleted.');
        }
        $id=$topic->subforum_id;
        $topic->delete();
        return redirect()->route('forum.show', ['id'=>$id])
            ->with('message', 'The post and the topic has been deleted.');
    }
}
