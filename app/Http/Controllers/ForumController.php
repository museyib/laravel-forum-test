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

    public function show(Subforum $parent)
    {
        $level=$parent->level;
        $subforums=Subforum::where('parent_id', $parent->id)->get();
        return view('forum.show', compact('subforums', 'level', 'parent'));
    }
}
