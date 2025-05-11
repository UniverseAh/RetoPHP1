<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Completada</title>
</head>
<body>
    <?php
        # Inicia la sesión
        session_start();

        # Verifica si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            die("Error: Usuario no autenticado.");
        }

        # Verifica si se recibió el ID de la tarea
        if (!isset($_GET['id'])) {
            die("Error: ID de tarea no especificado.");
        }

        $tarea_id = intval($_GET['id']); # Asegúrate de que el ID sea un número entero

        # Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
            die("Problemas con la conexión: " . mysqli_connect_error());

        # Actualiza el estado de la tarea a "Completada"
        $sql = "UPDATE tareas SET id_estado = 1 WHERE id = $tarea_id";
        if (mysqli_query($conexion, $sql)) {
            echo "La tarea ha sido marcada como completada.";
        } else {
            die("Error al actualizar la tarea: " . mysqli_error($conexion));
        }

        # Cierra la conexión
        mysqli_close($conexion);
    ?>

    <a href="tareasformulario.php">Volver a la lista de tareas</a>
</body>
</html>