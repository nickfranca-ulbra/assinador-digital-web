@extends('layouts.app')

@section('title', 'Verificação de Assinatura')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Verificação de Assinatura</h1>

    @if(session('status'))
        <div class="alert alert-{{ session('status') == 'VÁLIDA' ? 'success' : 'danger' }}">
            Assinatura: <strong>{{ session('status') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('verify.check') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">ID da Assinatura ou Texto + Assinatura</label>
            <input type="text" name="id_assinatura" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>
</div>
@endsection
