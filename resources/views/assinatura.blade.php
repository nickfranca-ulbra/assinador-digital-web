@extends('layouts.app')

@section('title', 'Assinar Documento')

@section('content')
<div class="mt-5  w-75 h-100">
        <h1 class="mb-3">Assinar</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('sign.store') }}">
    @csrf
    <div class="mt-2 mb-3">
        <label class="form-label">Insira um texto para assinar</label>
        <textarea name="texto" class="form-control" rows="5" required></textarea>
        @error('texto')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Assinar</button>
</form>
</div>
@endsection
