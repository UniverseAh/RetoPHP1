<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        $tarea_id = intval($_GET['id']); # se asegura qu ele id sea entero

        # Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
            die("Problemas con la conexión: " . mysqli_connect_error());

        # Consulta para obtener los datos de la tarea
        $query = "SELECT titulo, descripcion FROM tareas WHERE id = $tarea_id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $tarea = mysqli_fetch_assoc($resultado);
        } else {
            die("Error: Tarea no encontrada.");
        }

        # Cierra la conexión temporalmente
        mysqli_close($conexion);
    ?>

    <div class="container mt-5">
        <h2>Editar Tarea</h2>
        <form method="POST" action="guardar_cambios.php">
            <input type="hidden" name="id" value="<?php echo $tarea_id; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarea['titulo']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="tareasformulario.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>