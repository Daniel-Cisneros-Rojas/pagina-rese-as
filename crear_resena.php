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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear reseña</title>
    <link rel="stylesheet" href="estilo/forms.css">
    <script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
</head>
<body>
<form class="form-register" method="post" enctype="multipart/form-data">
    <h4><i class="fa-solid fa-pen-to-square" style="margin-right: 8px; color: #93C572;"></i>Nueva Reseña</h4>

    <input class="controls" type="text" name="titulo" id="titulo" placeholder="Titulo del tema / obra" required>

    <div class="input-container">
        <textarea name="opinion" cols="28" rows="6" placeholder="Escribe tu opinion aqui..." required></textarea>
    </div>

    <div class="rating-wrapper">
        <p><i class="fa-solid fa-star" style="color: #93C572; margin-right: 5px;"></i>Calificacion</p>
        <div class="rating">
            <input value="5" name="rate" id="star5" type="radio">
            <label title="5 estrellas" for="star5"></label>
            <input value="4" name="rate" id="star4" type="radio">
            <label title="4 estrellas" for="star4"></label>
            <input value="3" name="rate" id="star3" type="radio">
            <label title="3 estrellas" for="star3"></label>
            <input value="2" name="rate" id="star2" type="radio">
            <label title="2 estrellas" for="star2"></label>
            <input value="1" name="rate" id="star1" type="radio" checked>
            <label title="1 estrella" for="star1"></label>
        </div>
    </div>

    <div class="file-upload-wrapper">
        <p><i class="fa-solid fa-image" style="color: #D4A574; margin-right: 5px;"></i>Imagen alusiva</p>
        <input class="archivo" type="file" name="imagen" id="imagen" accept=".png, .jpg, .jpeg">
        <label class="archivolabel" for="imagen"><i class="fa-solid fa-upload"></i>Seleccionar archivo</label>
        <div class="preview-container" id="previewContainer">
            <img id="previewImage" src="#" alt="Vista previa">
        </div>
    </div>

    <input type="submit" name="reg" class="botons" value="Publicar reseña">
</form>

<script>
document.getElementById('imagen').addEventListener('change', function(e) {
    var preview = document.getElementById('previewImage');
    var container = document.getElementById('previewContainer');
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        container.style.display = 'none';
    }
});
</script>

<?php
    include("funciones/guardar_resena.php");
?>
</body>
</html>
