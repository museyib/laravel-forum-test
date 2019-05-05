<?php

namespace App\Http\Controllers\Admin;

use App\Role;
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

    public function store()
    {
        Role::create(request()->validate([
            'name'=>'required|min:3',
            'display_name'=>'required|min:3',
            'description'=>'required|min:10'
        ]));

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

    public function update(Role $role)
    {
        $role::update(request()->validate([
            'name'=>'required|min:3',
            'display_name'=>'required|min:3',
            'description'=>'required|min:10'
        ]));

        return redirect('admin/roles')->with('message', 'The role has been updated');
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

        return redirect('admin/roles')->with('message', 'The role has been deleted');
    }
}
