@extends('layouts.app')

@section('title', 'Cadastro de Usuário')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Usuário</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Senha</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

    </div>
@endsection
