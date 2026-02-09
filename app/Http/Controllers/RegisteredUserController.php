<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(Request $request){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'min:3', 'max:255'],
            'email' => ['required','email', 'max:255', Rule::unique('users', 'email') ],
            'name' => ['required','string', 'min:8', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password //bcrypt
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registration Success');
    }
}
