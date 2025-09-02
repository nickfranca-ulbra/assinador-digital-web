<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\LogVerificacao;
use Illuminate\Http\Request;

class LogVerificacaoController extends Controller
{
       public function log_verificacao()
{
    return view('verificacao'); 
}

public function verifyById(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
    ]);

    $status = 'INVÁLIDA';
    $assinaturaRecord = Assinatura::find($request->id);

    if ($assinaturaRecord) {
        $decodedSig = base64_decode($assinaturaRecord->assinatura);
        $hash = hash('sha256', $assinaturaRecord->texto);

        $verify = openssl_verify(
            $hash,
            $decodedSig,
            $assinaturaRecord->user->chave_publica,
            OPENSSL_ALGO_SHA256
        );

        $status = $verify === 1 ? 'VÁLIDA' : 'INVÁLIDA';

        LogVerificacao::create([
            'id_assinatura' => $assinaturaRecord->id,
            'status' => $status,
            'ip' => $request->ip(),
            'agente' => $request->header('User-Agent'),
        ]);
    }

    return redirect()->route('verify')->with([
        'status' => $status,
        'assinatura' => $assinaturaRecord,
    ]);
}

public function verifyByText(Request $request)
{
    $request->validate([
        'texto' => 'required|string',
        'assinatura' => 'required|string',
    ]);

    $status = 'INVÁLIDA';
    $assinaturaRecord = null;

    $assinaturas = Assinatura::where('texto', $request->texto)->get();

    foreach ($assinaturas as $assinatura) {
        $decodedSig = base64_decode($request->assinatura);
        $hash = hash('sha256', $request->texto);

        $verify = openssl_verify($hash, $decodedSig, $assinatura->user->chave_publica, OPENSSL_ALGO_SHA256);

        if ($verify === 1) {
            $assinaturaRecord = $assinatura;
            $status = 'VÁLIDA';
            break;
        }
    }

    LogVerificacao::create([
        'id_assinatura' => $assinaturaRecord?->id,
        'status' => $status,
        'ip' => $request->ip(),
        'agente' => $request->header('User-Agent'),
    ]);

    return redirect()->route('verify')->with([
        'status' => $status,
        'assinatura' => $assinaturaRecord,
    ]);
}

}
