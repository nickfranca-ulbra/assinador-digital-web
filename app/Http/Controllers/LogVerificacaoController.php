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

    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'texto' => 'required_without:id|string',
            'assinatura' => 'required_with:texto|string',
        ]);

        $status = 'INVÁLIDA';
        $assinaturaRecord = null;

        if ($request->id) {
            $assinaturaRecord = Assinatura::find($request->id);
        }
        elseif ($request->texto && $request->assinatura) {
            $assinaturas = Assinatura::where('texto', $request->texto)->get();

            foreach ($assinaturas as $assinatura) {
                $decodedSig = base64_decode($request->assinatura);
                $hash = hash('sha256', $request->texto);
                $verify = openssl_verify($hash, $decodedSig, $assinatura->user->chave_publica, OPENSSL_ALGO_SHA256);
                if ($verify === 1) {
                    $assinaturaRecord = $assinatura;
                    break;
                }
            }
        }
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

        return view('verificacao', [
            'status' => $status,
            'assinatura' => $assinaturaRecord,
        ]);
    }
}
