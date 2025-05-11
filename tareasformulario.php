<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php
        // inicia la sesion
        session_start();

        // verificamos si el user esta autenticado
        if (!isset($_SESSION['usuario_id'])) {// (si no hay un id de user)
            //si no lo esta lo enviamos al loginformulario
            header("Location: loginformulario.php");
            exit();
        }
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Gestión de Tareas</h1>
            <!-- Botón pa Cerrar Sesion -->
            <a href="logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
        </div>

        <!-- Formulario para meter tareas -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Añadir Nueva Tarea</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="nueva_tarea.php">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la Tarea</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escribe el título de la tarea" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Escribe la descripción de la tarea" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Añadir Tarea</button>
                </form>
            </div>
        </div>

        <hr>
        <h2 class="mb-4">Mis Tareas</h2>

        <!-- Tabla de tareas -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $conexion = mysqli_connect('localhost', 'root', '', 'basereto') or
                    die("Problemas con la conexion");

                $sql = "SELECT id, titulo, descripcion, id_estado FROM tareas";
                $result = $conexion->query($sql);

                if (!$result) {
                    echo "<tr><td colspan='5' class='text-danger'>Error: " . $conexion->error . "</td></tr>";
                } elseif ($result->num_rows > 0) { #si hay mas de 0 tareas
                    while ($tarea = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $tarea['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($tarea['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($tarea['descripcion']) . "</td>";
                        echo "<td><span class='badge " . ($tarea['id_estado'] == 1 ? "bg-success" : "bg-warning text-dark") . "'>" . 
                            ($tarea['id_estado'] == 1 ? "Completada" : "Pendiente") . "</span></td>";
                        echo "<td>";
                        echo "<a href='editar_tarea.php?id=" . $tarea['id'] . "' class='btn btn-sm btn-outline-primary me-1'>Editar</a>";
                        echo "<a href='eliminar_tarea.php?id=" . $tarea['id'] . "' class='btn btn-sm btn-outline-danger me-1'>Eliminar</a>";
                        if ($tarea['id_estado'] == 2) {
                            echo "<a href='marcar_complet.php?id=" . $tarea['id'] . "' class='btn btn-sm btn-outline-success'>Marcar como Completada</a>";
                        } else {
                            echo "<a href='marcar_pendiente.php?id=" . $tarea['id'] . "' class='btn btn-sm btn-outline-warning'>Marcar como Pendiente</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>No hay tareas.</td></tr>";
                }

                $conexion->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>