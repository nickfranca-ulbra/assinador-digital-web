@extends('layouts.app')

@section('title', 'Verificação de Assinatura')

@section('content')
<div class="container mt-5 w-50">
    <h1 class="mb-4 text-center">Verificação de Assinatura</h1>

    <!-- Verify by ID -->
    <form action="{{ route('verify.id') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">ID da Assinatura</label>
            <input type="number" name="id" class="form-control" value="{{ old('id') }}">
        </div>
        <button type="submit" class="btn btn-primary w-100">Verificar por ID</button>
    </form>

    <hr> <p class="text-center m-5">OU INSIRA SOMENTE O TEXTO E A ASSINATURA ABAIXO</p> <hr>
    

    <!-- Verify by Text + Signature -->
    <form action="{{ route('verify.text') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Texto</label>
            <textarea name="texto" class="form-control">{{ old('texto') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Assinatura (base64)</label>
            <textarea name="assinatura" class="form-control">{{ old('assinatura') }}</textarea>
        </div>
        <button type="submit" class="btn btn-secondary w-100">Verificar por Texto + Assinatura</button>
    </form>

    @if(session('status'))
        <div class="mt-4 alert {{ session('status') === 'VÁLIDA' ? 'alert-success' : 'alert-danger' }}">
            <h4>Status: {{ session('status') }}</h4>
            @if(session('assinatura'))
                <p><strong>Signatário:</strong> {{ session('assinatura')->user->name }}</p>
                <p><strong>Algoritmo:</strong> SHA-256 + RSA</p>
                <p><strong>Data/Hora:</strong> {{ session('assinatura')->created_at }}</p>
            @endif
        </div>
    @endif
</div>
@endsection
