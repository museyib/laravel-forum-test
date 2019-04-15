<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TopicFormRequest;
use App\Subforum;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    public function index()
    {
        $topics=Topic::all();
        return view('admin.topics.index', compact('topics'));
    }

    public function show($id)
    {
        $topic=Topic::getById($id);
        $parent=Subforum::getById($topic->subforum_id);
        return view('admin.topics.show', compact('topic', 'parent'));
    }

    public function edit(Topic $topic)
    {
        $subforums=Subforum::all();
        return view('admin.topics.edit', compact('topic', 'subforums'));
    }

    public function update(TopicFormRequest $request, Topic $topic)
    {
        $topic->title=$request->get('title');
        $topic->subforum_id=$request->get('subforum_id');

        $topic->update();
        return redirect('admin/topics')->with('message', 'Topic updated');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect('admin/topics')->with('message', 'Topic deleted');
    }
}
