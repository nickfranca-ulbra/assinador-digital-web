@extends('layouts.app')

@section('title', 'Verificação de Assinatura')

@section('content')
<div class="container mt-5 w-50">
    <h1 class="mb-4 text-center">Verificação de Assinatura</h1>

    <form action="{{ route('verify.check') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">ID da Assinatura (opcional)</label>
            <input type="number" name="id" class="form-control" value="{{ old('id') }}">
        </div>

        <p class="text-center">ou</p>

        <div class="mb-3">
            <label class="form-label">Texto</label>
            <textarea name="texto" class="form-control">{{ old('texto') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Assinatura (base64)</label>
            <textarea name="assinatura" class="form-control">{{ old('assinatura') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Verificar</button>
    </form>

    @isset($status)
        <div class="mt-4 alert {{ $status === 'VÁLIDA' ? 'alert-success' : 'alert-danger' }}">
            <h4>Status: {{ $status }}</h4>
            @if($assinatura)
                <p><strong>Signatário:</strong> {{ $assinatura->user->name }}</p>
                <p><strong>Algoritmo:</strong> SHA-256 + RSA</p>
                <p><strong>Data/Hora:</strong> {{ $assinatura->created_at }}</p>
            @endif
        </div>
    @endisset
</div>
@endsection
