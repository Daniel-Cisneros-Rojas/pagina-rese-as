<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="estilo/style2.css">
</head>
<body>
    <form class="form-register" method="post">
        <h4>Formulario Registro</h4>
        <input class="controls" type="text" name="usuarios" id="usuarios" placeholder="Ingrese un nombre">
        <input class="controls" type="password" name="contrasenas" id="contrasenas" placeholder="Ingrese una contraseña">
        <input class="controls" type="text" name="correo" id="correo" placeholder="Ingrese un correo">
        <input type="submit" name="reg" class="botons" value="Enviar">
</form>
    <?php
    include("funciones/funcion_registrar.php");
    ?>

</body>
</html>