<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function registing(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|min:8'
        ]);

            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user'
            ]);

            return redirect('/');



    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role == 'user') {
                return redirect('/dashboard');
            }elseif (auth()->user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }elseif (auth()->user()->role == 'superadmin') {
                return redirect('/superadmin/dashboard');
            }
        }
 
        return back()->withErrors([
            'email' => 'Your Account is not match our records.',
        ]);
    }

    public function logout(Request $request)
{
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
}
}
