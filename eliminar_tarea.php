<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

                    $tarea_id = intval($_GET['id']); # se asegura que el id sea entero

                    # Conexión a la base de datos
                    $conexion = mysqli_connect("localhost", "root", "", "basereto") or
                        die("<div class='alert alert-danger text-center' role='alert'>
                                Problemas con la conexión: " . mysqli_connect_error() . "
                            </div>");

                    # Elimina la tarea de la base de datos
                    $sql = "DELETE FROM tareas WHERE id = $tarea_id";
                    if (mysqli_query($conexion, $sql)) {
                        echo "<div class='alert alert-success text-center' role='alert'>
                                <strong>¡Éxito!</strong> La tarea ha sido eliminada con éxito.
                            </div>";
                    } else {
                        echo "<div class='alert alert-danger text-center' role='alert'>
                                Error al eliminar la tarea: " . mysqli_error($conexion) . "
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