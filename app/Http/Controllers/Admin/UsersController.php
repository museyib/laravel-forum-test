<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if (!is_null($password)) {
            $user->password = Hash::make($password);
        }
        $user->save();
        $user->saveRoles($request->get('role'));

        return redirect('admin/users')->with('message', 'The user has been created');
    }

    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selected_roles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'selected_roles'));
    }

    public function update($id, Request $request)
    {
        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if (is_null($password)) {
            $user->password = Hash::make($password);
        }
        $user->save();
        $user->saveRoles($request->get('role'));

        return redirect('admin/users')->with('message', 'The user has been updated');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect('admin/users')->with('message', 'The user has been deleted.');
    }
}
