<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function user() // método para cadastro
    {
        return view('registro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);


        $keyPair = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($keyPair, $privateKey);
        $publicKey = openssl_pkey_get_details($keyPair)['key'];

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'chave_privada' => $privateKey,
            'chave_publica' => $publicKey,
        ]);

        return redirect()->route('sign')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function downloadPublicKey()
{
    $user = Auth::user();

    $filename = 'public_key_' . $user->id . '.pem';
    $headers = [
        'Content-Type' => 'application/x-pem-file',
        'Content-Disposition' => "attachment; filename={$filename}"
    ];

    return response($user->chave_publica, 200, $headers);
}

}
