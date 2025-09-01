@extends('layouts.app')

@section('title', 'Assinar Documento')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">
        Assinar Documento
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('sign.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Texto para assinar</label>
        <textarea name="texto" class="form-control" rows="5" required></textarea>
        @error('texto')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Assinar</button>
</form>

    </div>
</div>
@endsection
