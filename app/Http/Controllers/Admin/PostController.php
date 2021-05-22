<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Topic;
use Exception;

class PostController extends Controller
{
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (Exception $e) {
            return back()->with('message', 'Something went wrong!');
        }
        $topic = Topic::find($post->topic_id);
        if (count($topic->posts) > 0) {
            return back()->with('message', 'The post has been deleted.');
        }
        $id = $topic->subforum_id;
        $topic->delete();
        return redirect()->route('forum.show', ['id' => $id])
            ->with('message', 'The post and the topic has been deleted.');
    }
}
