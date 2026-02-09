<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
       $attributes =  $request->validate([
            'email' => ['required','email', 'max:255'],
            'password' => ['required','string', 'min:8', 'max:255'],
        ]);

        if(!Auth::attempt($attributes)){
            return back()
                ->withErrors(['password' => 'We were Unable to authenticate the provided credentials'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', "Successfully Login");
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
