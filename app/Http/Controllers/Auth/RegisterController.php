<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register'); 
    }

    public function store(Request $request){
        $userData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        $userData['password'] = bcrypt($userData['password']);

        // dd($userData);
        User::create($userData);
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
