<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexion = mysqli_connect("localhost", "root", "", "basereto") or
                die("Problemas con la conexión: " . mysqli_connect_error());

            #pa que se tengan que llenar los campos esos
            if (!isset($_POST['titulo']) || !isset($_POST['descripcion'])) {
                die("Error: Faltan datos en el formulario.");
            }

            #verifica si el usuario esta autenticado
            if (!isset($_SESSION['usuario_id'])) {
                die("Error: Usuario no autenticado.");
            }

            
            $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
            $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
            $usuario_id = $_SESSION['usuario_id']; 
            $id_estado = 2;

            $sql = "INSERT INTO tareas (titulo, descripcion, usuario_id, id_estado) VALUES ('$titulo', '$descripcion', $usuario_id, $id_estado)";
            if (mysqli_query($conexion, $sql)) {
                echo "Tarea registrada con éxito.";
            } else {
                die("Error al registrar la tarea: " . mysqli_error($conexion));
            }

            mysqli_close($conexion);
        }
    ?>
    
    <a href="tareasformulario.php">Volver a la lista de tareas</a>
</body>
</html>