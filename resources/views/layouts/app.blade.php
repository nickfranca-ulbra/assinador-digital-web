<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assinador Digital Web - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1a7f5a;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('register') }}">Assinador Digital</a>
        <div>
            <a class="btn btn-outline-light me-2" href="{{ route('register') }}">Cadastro</a>
            <a class="btn btn-outline-light me-2" href="{{ route('sign') }}">Assinar</a>
            <a class="btn btn-outline-light" href="{{ route('verify') }}">Verificar</a>
        </div>
    </div>
</nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
