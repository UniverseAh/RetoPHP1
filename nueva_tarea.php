<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexion = mysqli_connect("localhost", "root", "", "basereto") or
                die("Problemas con la conexión");

            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            $registros = mysqli_query($conexion, "INSERT INTO tareas (titulo, descripcion) 
            VALUES ('$titulo', '$descripcion')");

            if ($registros) {
                echo "Tarea registrada con éxito.";
            } else {
                echo "Error al registrar la tarea: " . mysqli_error($conexion);
            }

            mysqli_close($conexion);
        }

    ?>
    <a href="tareasformulario.php">Volver a la lista de tareas</a>
</body>
</html>