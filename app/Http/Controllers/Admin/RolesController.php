<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $role=new Role([
            'name'=>$request->get('name'),
            'display_name'=>$request->get('display_name'),
            'description'=>$request->get('description')
        ]);

        $role->save();

        return redirect('admin/roles')->with('message', 'A new role has been created');
    }

    public function show($id)
    {
        return view('admin.roles.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.roles.edit', compact('id'));
    }

    public function update($id, Request $request)
    {
        $role=Role::where('id', $id);

        $role->name=$request->get('name');
        $role->display_name=$request->get('display_name');
        $role->description=$request->get('description');

        $role->save();

        return redirect('admin/roles')->with('message', 'A new role has been update');
    }

    public function destroy($id)
    {
        $role=Role::where('id', $id)->first();
        if ($role->name=='admin')
        {
            $roles=Role::all();
            return redirect('admin/roles')
                ->with('warning', 'This is "Admin" role. You can\'t delete this.');
        }
        $role->delete();

        return redirect('admin/roles/index')->with('message', 'A new role has been deleted');
    }
}
