<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user=User::whereId($id)->firstOrFail();
        $roles=Role::all();
        $selectedroles=$user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'selectedroles'));
    }

    public function update($id, Request $request)
    {
        $user=User::whereId($id)->firstOrFail();
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $password=$request->get('password');

        if($password!='')
        {
            $user->password=Hash::make($password);
        }
        $user->save();
        $user->saveRoles($request->get('role'));

        return redirect(action('Admin\UsersController@edit', $user->id))->with('message', 'The user has been updated');
    }
}
