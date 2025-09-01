<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssinaturaController extends Controller
{
     public function assinatura() // página de assinatura
    {
        return view('assinatura');
    }

    public function store(Request $request){
      $request->validate([
            'texto' => 'required|string',
        ]);

        $user = Auth::user();

        // Calcular hash SHA-256
        $hash = hash('sha256', $request->texto);

        // Assinar hash com chave privada
        openssl_sign($hash, $assinatura, $user->chave_privada, OPENSSL_ALGO_SHA256);

        // Salvar assinatura
        $assinaturaModel = Assinatura::create([
            'id_user'   => $user->id,
            'texto'     => $request->texto,
            'hash'      => $hash,
            'assinatura'=> base64_encode($assinatura),
            'algoritmo'  => 'SHA-256',
        ]);

        return redirect()->route('sign', $assinaturaModel->id)
                         ->with('success', 'Texto assinado com sucesso!');
    }
    public function show($id)
    {
        $assinatura = Assinatura::findOrFail($id);
        return view('assinatura', compact('assinatura'));
    }
}
