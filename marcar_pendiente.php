<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estado de Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                    # Inicia la sesión
                    session_start();

                    # Verifica si el usuario está autenticado
                    if (!isset($_SESSION['usuario_id'])) {
                        echo "<div class='alert alert-danger text-center' role='alert'>
                                Error: Usuario no autenticado.
                            </div>";
                        exit;
                    }

                    # Verifica si se recibió el ID de la tarea
                    if (!isset($_GET['id'])) {
                        echo "<div class='alert alert-danger text-center' role='alert'>
                                Error: ID de tarea no especificado.
                            </div>";
                        exit;
                    }

                    $tarea_id = intval($_GET['id']); # Asegúrate de que el ID sea un número entero

                    # Conexión a la base de datos
                    $conexion = mysqli_connect("localhost", "root", "", "basereto") or
                        die("<div class='alert alert-danger text-center' role='alert'>
                                Problemas con la conexión: " . mysqli_connect_error() . "
                            </div>");

                    # Consulta para obtener el estado actual de la tarea
                    $query = "SELECT id_estado FROM tareas WHERE id = $tarea_id";
                    $resultado = mysqli_query($conexion, $query);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        $tarea = mysqli_fetch_assoc($resultado);
                        $estado_actual = $tarea['id_estado'];

                        # Alterna el estado: si está "Completada" (1), cambia a "Pendiente" (2); si está "Pendiente", cambia a "Completada"
                        $nuevo_estado = ($estado_actual == 1) ? 2 : 1;

                        # Actualiza el estado de la tarea
                        $sql = "UPDATE tareas SET id_estado = $nuevo_estado WHERE id = $tarea_id";
                        if (mysqli_query($conexion, $sql)) {
                            echo "<div class='alert alert-success text-center' role='alert'>
                                    <strong>¡Éxito!</strong> El estado de la tarea ha sido actualizado.
                                </div>";
                        } else {
                            echo "<div class='alert alert-danger text-center' role='alert'>
                                    Error al actualizar el estado de la tarea: " . mysqli_error($conexion) . "
                                </div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger text-center' role='alert'>
                                Error: Tarea no encontrada.
                            </div>";
                    }

                    # Cierra la conexión
                    mysqli_close($conexion);
                ?>

                <div class="text-center mt-4">
                    <a href="tareasformulario.php" class="btn btn-primary">Volver a la lista de tareas</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>