@extends('layouts.app')

@section('title', 'Resultado da Verificação')

@section('content')
<div class="container mt-5">
    <h2>Resultado da Verificação</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Status:</strong> 
                <span class="{{ $status === 'VÁLIDA' ? 'text-success' : 'text-danger' }}">
                    {{ $status }}
                </span>
            </p>
            <p><strong>Signatário:</strong> {{ $signatario }}</p>
            <p><strong>Algoritmo:</strong> {{ $algoritmo ?? 'SHA-256' }}</p>
            <p><strong>Data/Hora:</strong> {{ $data_hora }}</p>
            <p><strong>Texto:</strong></p>
            <pre>{{ $texto }}</pre>
        </div>
    </div>

    <a href="{{ route('verify') }}" class="btn btn-secondary mt-3">Verificar outra assinatura</a>
</div>
@endsection
