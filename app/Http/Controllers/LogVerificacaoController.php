<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\LogVerificacao;
use Illuminate\Http\Request;

class LogVerificacaoController extends Controller
{
      public function log_verificacao(Request $request)
    {
         $request->validate([
        'id' => 'required|integer',
    ]);

    $assinatura = Assinatura::find($request->id);
    if (!$assinatura) {
        return back()->with('error', 'Assinatura não encontrada.');
    }

    $user = $assinatura->user;

    // Verificar assinatura
    $hash = hash('sha256', $assinatura->texto);
    $assinaturaBinaria = base64_decode($assinatura->assinatura);
    $valida = openssl_verify($hash, $assinaturaBinaria, $user->chave_publica, OPENSSL_ALGO_SHA256);

    $status = $valida === 1 ? 'VÁLIDA' : 'INVÁLIDA';


    $log = \App\Models\LogVerificacao::create([
        'assinatura_id' => $assinatura->id,
        'status'        => $status,
        'verificado_em' => now(),
    ]);

    return view('verify_result', [
        'status'      => $status,
        'signatario'  => $user->nome,
        'algoritmo'   => $assinatura->algoritmo,
        'data_hora'   => $assinatura->created_at,
        'texto'       => $assinatura->texto,
    ]);
    }
}
