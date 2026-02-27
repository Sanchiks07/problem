<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('tasks.index');
    }
}
