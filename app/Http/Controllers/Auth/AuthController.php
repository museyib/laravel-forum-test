<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected $redirectTo=[];

    public function __construct()
    {
        $this->middleware('guest', ['except'=>'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|confirmed|min:6'
        ]);
    }

    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $data=Socialite::with('facebook')->redirect();
        $user=User::where('email', $data->email)->first();

        if (! is_null($user))
        {
            Auth::login($user);
            $user->name=$data->user['name'];
            $user->provider_id=$data->user['id'];
            $user->save();
        }
        else
        {
            $user=User::where('provider_id', $user->user['id'])->first();

            if (is_null($user))
            {
                $user=new User();
                $user->name=$data->user['name'];
                $user->email=$data->email;
                $user->provider_id=$data->user['id'];
                $user->save();
            }
            Auth::login($user);
        }

        return redirect('/')->with('success', 'Successfully logged in');
    }
}
