<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Tarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        // Inicia la sesión
        session_start();

        // Verifica si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            die("Error: Usuario no autenticado.");
        }

        // Verifica si se recibió el ID de la tarea
        if (!isset($_GET['id'])) {
            die("Error: ID de tarea no especificado.");
        }

        $tarea_id = intval($_GET['id']);//obtenemos un valor entero por el metod get con el name 'id'

        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
            die("Problemas con la conexión: " . mysqli_connect_error());

        // Elimina la tarea de la base de datos
        $sql = "DELETE FROM tareas WHERE id = $tarea_id";
        if (mysqli_query($conexion, $sql)) {
            echo "La tarea ha sido eliminada con éxito.";
        } else {
            die("Error al eliminar la tarea: " . mysqli_error($conexion));
        }

        // Cierra la conexión
        mysqli_close($conexion);
    ?>

        <div class="text-center mt-3">
            <a href="tareasformulario.php" class="btn btn-primary">Volver a la lista de tareas</a>
        </div>
    </body>
</html>