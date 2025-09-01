<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Auth extends Controller
{
     public function showLoginForm()
    {
        return view('auth.login'); // vamos criar essa view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (FacadesAuth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/sign'); 
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
