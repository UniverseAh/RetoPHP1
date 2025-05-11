<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="text-center mb-4">Formulario de Registro</h2>

            <form method="post" action="registro.php" class="border p-4 rounded shadow">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" name="correo" id="correo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" class="form-control" required>
                </div>

                <div class="d-grid">
                    <input type="submit" value="Confirmar Registro" class="btn btn-primary">
                </div>
            </form>

            <p class="text-center mt-3">
                ¿Ya tienes una cuenta? <a href="loginformulario.php">Inicia sesión aquí</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
