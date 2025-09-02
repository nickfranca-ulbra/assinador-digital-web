@extends('layouts.app')

@section('title', 'Minhas Assinaturas')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Minhas Assinaturas</h1>

    @if($assinaturas->isEmpty())
        <p class="text-center">Você ainda não possui assinaturas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Texto</th>
                    <th>Assinatura (base64)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assinaturas as $assinatura)
                    <tr>
                        <td>{{ $assinatura->id }}</td>
                        <td>{{ $assinatura->texto }}</td>
                        <td style="word-break: break-word;">{{ $assinatura->assinatura }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
