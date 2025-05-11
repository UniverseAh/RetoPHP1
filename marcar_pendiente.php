<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estado de Tarea</title>
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

        $tarea_id = intval($_GET['id']); // Asegúrate de que el ID sea un número entero

        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
            die("Problemas con la conexión: " . mysqli_connect_error());

        // Consulta para obtener el estado actual de la tarea
        $query = "SELECT id_estado FROM tareas WHERE id = $tarea_id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $tarea = mysqli_fetch_assoc($resultado);
            $estado_actual = $tarea['id_estado'];

            // Alterna el estado: si está "Completada" (1), cambia a "Pendiente" (2); si está "Pendiente", cambia a "Completada"
            $nuevo_estado = ($estado_actual == 1) ? 2 : 1;

            // Actualiza el estado de la tarea
            $sql = "UPDATE tareas SET id_estado = $nuevo_estado WHERE id = $tarea_id";
            if (mysqli_query($conexion, $sql)) {
                echo "El estado de la tarea ha sido actualizado.";
            } else {
                die("Error al actualizar el estado de la tarea: " . mysqli_error($conexion));
            }
        } else {
            die("Error: Tarea no encontrada.");
        }

        // Cierra la conexión
        mysqli_close($conexion);
    ?>

    <a href="tareasformulario.php">Volver a la lista de tareas</a>
</body>
</html>