<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     public function user() // método para cadastro
    {
        return view('registro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
        ]);
        return back()->withErrors([
            'email' => 'Já possui um usuário cadastrado nesse email.',
        ]);

        $keyPair = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($keyPair, $privateKey);
        $publicKey = openssl_pkey_get_details($keyPair)['key'];

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'chave_privada' => $privateKey,
            'chave_publica' => $publicKey,
        ]);

        return redirect()->route('sign')->with('success', 'Usuário cadastrado com sucesso!');
    }
}
