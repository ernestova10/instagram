<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Instagram</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center">
            <h1 class="mb-4">Bienvenido a Instagram</h1>
            <a href="{{ route('login') }}" class="btn btn-primary mb-2">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-primary mb-2">Registro</a>
        </div>
    </div>
</body>
</html>
