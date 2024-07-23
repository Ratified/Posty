<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    
    public function store(Request $request){        
        $userData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable'
        ]);

        if(!auth()->attempt($userData)){
            return back()->with('status', 'Invalid login details');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
