<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" action="nueva_tarea.php">
        <input type="text" name="titulo" placeholder="Título de la tarea" required>
        <textarea name="descripcion" placeholder="Descripción de la tarea" required></textarea>
        <br>
        <br>
        <button type="submit">Añadir Tarea</button>
    </form>

    <hr>
    <h2>Mis Tareas</h2>
    <ul>
        <?php

        $conexion = mysqli_connect('localhost', 'root', '', 'basereto') or
            die("Problemas con la conexión");
        
            $sql = "SELECT id, titulo, descripcion, completada FROM tareas";
            $result = $conexion->query($sql);

            if (!$result) {
                die("<p>Error al ejecutar la consulta: " . $conexion->error . "</p>");
            }

            if ($result->num_rows > 0) {
                while ($tarea = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>" . htmlspecialchars($tarea['titulo']) . "</strong>: " . htmlspecialchars($tarea['descripcion']);
                    echo $tarea['completada'] ? " (Completada)" : "";
                    echo " <a href='editar_tarea.php?id=" . $tarea['id'] . "'>Editar</a>";
                    echo " <a href='eliminar_tarea.php?id=" . $tarea['id'] . "'>Eliminar</a>";
                    if (!$tarea['completada']) {
                        echo " <a href='marcar_completada.php?id=" . $tarea['id'] . "'>Marcar como Completada</a>";
                    }
                    echo "</li>";
                }
            } else {
                echo "<li>No hay tareas.</li>";
            }

        $conexion->close();
        ?>
    </ul>
</body>
</html>