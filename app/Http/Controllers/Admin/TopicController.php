<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subforum;
use App\Topic;
use Exception;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();

        return view('admin.topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        $parent = Subforum::find($topic->subforum_id);

        return view('admin.topics.show', compact('topic', 'parent'));
    }

    public function edit(Topic $topic)
    {
        $subforums = Subforum::all();

        return view('admin.topics.edit', compact('topic', 'subforums'));
    }

    public function update(Topic $topic)
    {
        $topic->update(request()->validate([
            'title' => 'required|min:3',
            'subforum_id' => 'required'
        ]));

        return redirect('admin/topics')->with('message', 'The topic has been updated');
    }

    public function destroy(Topic $topic)
    {
        try {
            $topic->delete();
        } catch (Exception $e) {
            return redirect('admin/topics')->with('message', 'Something went wrong!');
        }

        return redirect('admin/topics')->with('message', 'The topic has been deleted');
    }
}
