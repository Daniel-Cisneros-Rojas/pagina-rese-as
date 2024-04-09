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
    <script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
</head>
<body>
<form class="form-register" method="post" enctype="multipart/form-data">
        <h4>Crear Reseña</h4>
        <input class="controls" type="text" name="titulo" id="titulo" placeholder="Titulo de la obra">
             
        <div class="input-container">
        <textarea name="opinion" cols="28" rows="10" placeholder="Opinion"></textarea>
        </div>
        <div class="rating">
            <h3>          calificacion  :         </h3>
            <input value="5" name="rate" id="star5"type="radio">
            <label title="text" for="star5"></label>
            <input value="4" name="rate" id="star4"type="radio">
            <label title="text" for="star4"></label>
            <input value="3" name="rate" id="star3"type="radio">
            <label title="text" for="star3"></label>
            <input value="2" name="rate" id="star2"type="radio">
            <label title="text" for="star2"></label>
            <input value="1" name="rate" id="star1"type="radio">
            <label title="text" for="star1"></label>
        </div>
        <h3>Imagen :</h3>
        <br>
        <input class="archivo" type="file" name="imagen" id="imagen" accept=".png, .jpg">
        <label class="archivolabel" for="imagen"><i class="fa-solid fa-upload"></i>Upload File</label>
        <input type="submit" name="reg" class="botons">
</form>
    
<?php
    include("funciones/guardar_resena.php");
?>
</body>
</html>