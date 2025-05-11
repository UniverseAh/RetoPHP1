<?php

    session_start();

    # Verifica si el usuario está autenticado
    if (!isset($_SESSION['usuario_id'])) {
        die("Error: Usuario no autenticado.");
    }

    # Verifica si se recibieron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['id']) || !isset($_POST['titulo']) || !isset($_POST['descripcion'])) {
            die("Error: Faltan datos en el formulario.");
        }

        $tarea_id = intval($_POST['id']);
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];

        # Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "basereto") or
            die("Problemas con la conexión: " . mysqli_connect_error());

        # Actualiza los datos de la tarea
        $sql = "UPDATE tareas SET titulo = ?, descripcion = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $titulo, $descripcion, $tarea_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Tarea actualizada con éxito.";
        } else {
            die("Error al actualizar la tarea: " . mysqli_error($conexion));
        }

        # Cierra la conexión
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        # Redirige de vuelta a la lista de tareas
        header("Location: tareasformulario.php");
        exit();
    } else {
        die("Error: Solicitud inválida.");
    }
    
?>
