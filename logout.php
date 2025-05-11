<?php
    session_start();
    session_destroy(); # se destruye la sesion
    header("Location: loginformulario.php"); # manda otra ve al formulario de login
    exit();
?>
