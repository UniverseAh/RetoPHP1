<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
        session_start();

        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
        die("Problemas con la conexión");

        $correo = mysqli_real_escape_string($conexion, $_REQUEST['correo']);
        $contrasena = $_REQUEST['contrasena'];

        $query = "SELECT id, contrasena FROM usuarios WHERE correo = '$correo'";
        $resultado = mysqli_query($conexion, $query) or die("Problemas en el select " . mysqli_error($conexion));

        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);

            if (password_verify($contrasena, $fila['contrasena'])) {
                # Guarda en la variable el ID del usuario en la sesión
                $_SESSION['usuario_id'] = $fila['id'];
                #cosito 
    ?>
    
                <div class='alert alert-success text-center' role='alert' style='max-width: 400px; margin: 20px auto'> 
                        <strong>¡Login exitoso!</strong><br>
                        <a href='tareasformulario.php' class='btn btn-success mt-2'>Bienvenido</a>
                    </div>

                <?php
            } else {
                ?>
                <div class='alert alert-danger text-center' role='alert' style='max-width: 400px; margin: 20px auto'>
                        Error: Contraseña incorrecta.
                    </div>

                <?php
            }
        } else {
            echo "Error: Usuario no encontrado.";
        }

        mysqli_close($conexion);
    ?>
    
</body>
</html>