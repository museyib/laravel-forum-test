<?php

namespace App\Http\Controllers\Admin;

use App\Subforum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubforumController extends Controller
{
    public function index()
    {
        $subforums=Subforum::all();

        return view('admin.subforums.index', compact('subforums'));
    }

    public function create()
    {
        $subforums=Subforum::all();

        return view('admin.subforums.create', compact('subforums'));
    }

    public function store(Request $request)
    {
        $subforum=new Subforum();
        $subforum->name=$request->get('name');
        $subforum->parent_id=$request->get('parent_id');
        $parent=Subforum::all()->where('id', $subforum->parent_id);
        if($parent->first()==null)
        {
            $subforum->level=1;
        }
        else
        {
            $subforum->level=$parent->first()->level+1;
        }


        $subforum->save();

        return redirect('admin/subforums')->with('message', 'New Subforum created');
    }

    public function show(Subforum $subforum)
    {
        return view('admin.subforums.show', compact('subforum'));
    }

    public function edit(Subforum $subforum)
    {
        $subforums=Subforum::all();
        return view('admin.subforums.edit', compact('subforum', 'subforums'));
    }

    public function update(Subforum $subforum, Request $request)
    {
        $subforum->name=$request->get('name');
        $subforum->parent_id=$request->get('parent_id');
        $parent=Subforum::all()->where('id', $subforum->parent_id);
        if($parent->first()==null)
        {
            $subforum->level=1;
        }
        else
        {
            $subforum->level=$parent->first()->level+1;
        }

        $subforum->update();

        return redirect('admin/subforums')->with('message', 'Subforum updated');
    }

    public function destroy(Subforum $subforum)
    {
        foreach ($subforum->Childs() as $child)
        {
            if (count($child->childs())>0)
            {
                $this->destroy($child);
            }
            $child->delete();
        }
        $subforum->delete();

        return redirect('admin/subforums')->with('message', 'Subforum deleted');
    }
}
