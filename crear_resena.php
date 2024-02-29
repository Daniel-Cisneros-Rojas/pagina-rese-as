<?php
    session_start();
    error_reporting(0);
    $usuario=$_SESSION['usuario'];

    if($usuario==null||$usuario=='')
    {
       echo 'Usted no tiene autorizacion';
       die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear reseña</title>
    <link rel="stylesheet" href="estilo/style2.css">
</head>
<body>
<form class="form-register" method="post" enctype="multipart/form-data">
        <h4>Crear Reseña</h4>
        <input class="controls" type="text" name="titulo" id="titulo" placeholder="Titulo de la obra">
             
        <div class="input-container">
          <textarea name="opinion" cols="28" rows="10" placeholder="Opinion"></textarea>
        </div>
        <input class="controls" type="text" name="calificacion" id="calificacion" placeholder="Ingrese su calificacion de 0-5" required="" pattern="[0-5]">
        <input type="file" name="imagen" id="imagen" required="">
        <input type="submit" name="reg" class="botons">
</form>
    
<?php
    include("funciones/guardar_resena.php");
?>
</body>
</html>