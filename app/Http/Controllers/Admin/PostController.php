<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Subforum;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function destroy(Post $post)
    {
        $post->delete();
        $topic=Topic::find($post->topic_id);
        if (count($topic->posts()->get())>0)
        {
            $parent=Subforum::find($topic->subforum_id);
            return redirect(action('TopicController@show', ['topic'=>$topic, 'parent'=>$parent]))
                ->with('message', 'Post has been deleted');
        }
        $id=$topic->subforum_id;
        $topic->delete();
        return redirect(action('ForumController@show', ['id'=>$id]))
            ->with('message', 'Post ant topic has been deleted');
    }
}
