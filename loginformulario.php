<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <form method="post" action="login.php" class="bg-white p-4 rounded shadow-sm" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <div class="mb-3">
            <input type="email" name="correo" placeholder="Correo electrónico" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="password" name="contrasena" placeholder="Contraseña" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>

</body>
</html>
