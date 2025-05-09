<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        
        $conexion = mysqli_connect('localhost', 'root', '', 'basereto'); 
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $nombre = $_REQUEST['nombre']; 
            $correo = $_REQUEST['correo']; 
            $contrasena = $_REQUEST['contrasena']; 
            $confirmar_contrasena = $_REQUEST['confirmar_contrasena'];

            if ($contrasena !== $confirmar_contrasena) {
                echo "Las contraseñas no coinciden. <br><br> <a href='registroformulario.php'> Volver </a>";
                exit;
            } else {
                $hash = password_hash($contrasena, PASSWORD_DEFAULT); 
                $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)"); 
                $stmt->bind_param("sss", $nombre, $correo, $hash); 
                
                if ($stmt->execute()) { 
                    echo "Usuario registrado con éxito."; 
                } else { 
                    echo "Error: " . $stmt->error; 
                } 
                $stmt->close(); 
            }
        } 
    ?>

</body>
</html>