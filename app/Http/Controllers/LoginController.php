<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function save(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:4',
        ]);
        if (auth()->attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ])) {
            // Update last login time
            $user = auth()->user();
            $user->last_login_at = now();
            $user->save();
            return redirect()->route('home')->with('logedin', true);
        } else {
            return redirect()->back()
                ->with('error', __("lang.usernameOrPasswordError"))
                ->withInput();
        }
    }
}
