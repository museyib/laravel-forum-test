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

        return redirect('admin/roles/create')->with('message', 'A new role has been created');
    }
}
