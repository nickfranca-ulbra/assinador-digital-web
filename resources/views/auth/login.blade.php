@extends('layouts.app')

@section('title', 'Cadastro de Usuário')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4 w-50">
            <h1 class="mb-4 text-center">Login</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-1 mb-2 text-center">Não possui cadastro? <a href="{{ route('register') }}">Clique aqui</a> para realizar!</div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
@endsection
