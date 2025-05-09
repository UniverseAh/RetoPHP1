<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    
    <form method="post" action="registro.php">

        Ingrese su nombre:
        <input type="text" name="nombre">
        
        <br>
        <br>

        Ingrese su Correo:
        <input type="mail" name="correo">

        <br>
        <br>

        Ingrese su Contraseña:
        <input type="password" name="contrasena">

        <br>
        <br>

        Confirme su Contraseña:
        <input type="password" name="confirmar_contrasena">

        <br>
        <br>

        <input type="submit" value="confirmar">
    </form>

    <br>
    <p>¿Ya tienes una cuenta? <a href="loginformulario.php">Inicia sesión aquí</a></p>

</body>
</html>