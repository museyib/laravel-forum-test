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

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Role $role, Request $request)
    {
        $role->name=$request->get('name');
        $role->display_name=$request->get('display_name');
        $role->description=$request->get('description');

        $role->save();

        return redirect('admin/roles')->with('message', 'A new role has been update');
    }

    public function destroy(Role $role)
    {
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
