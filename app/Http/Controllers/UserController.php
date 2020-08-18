<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|confirmed',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = new User($request->all());
        $user->assignRole('user');
        $user->save();
        Auth::login($user);

        return redirect('/home');
    }
}
