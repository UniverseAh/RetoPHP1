<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php

        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
        die("Problemas con la conexión");


        $correo = mysqli_real_escape_string($conexion, $_REQUEST['correo']);
        $contrasena = $_REQUEST['contrasena'];

        $query = "SELECT contrasena FROM usuarios WHERE correo = '$correo'";
        $resultado = mysqli_query($conexion, $query) or die("Problemas en el select " . mysqli_error($conexion));

        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);

            if (password_verify($contrasena, $fila['contrasena'])) {
                echo "Login exitoso. <a href='tareasformulario.php'> Bienvenido </a>";
            } else {
                echo "Error: Contraseña incorrecta.";
            }
        } else {
            echo "Error: Usuario no encontrado.";
        }

        mysqli_close($conexion);
    ?>
</body>
</html>