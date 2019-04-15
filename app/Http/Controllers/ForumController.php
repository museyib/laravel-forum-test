<?php

namespace App\Http\Controllers;

use App\Subforum;

class ForumController extends Controller
{
    public function index()
    {
        $subforums=Subforum::all();
        $level=0;
        return view('forum.index', compact('subforums', 'level'));
    }

    public function show($id)
    {
        $parent=Subforum::all()->where('id', $id)->first();
        $level=$parent->level;
        $subforums=Subforum::all()->where('parent_id', $parent->id);
        return view('forum.show', compact('subforums', 'level', 'parent'));
    }
}
