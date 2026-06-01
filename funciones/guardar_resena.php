<?php
include("conexion.php");

define('IMG_MAX_WIDTH', 800);
define('IMG_MAX_HEIGHT', 600);
define('IMG_QUALITY', 85);

function redimensionar_imagen($origen, $max_w, $max_h)
{
    if (!extension_loaded('gd')) {
        return file_get_contents($origen);
    }

    $info = @getimagesize($origen);
    if (!$info) {
        return file_get_contents($origen);
    }

    list($ancho, $alto) = $info;
    $tipo = $info[2];

    if ($ancho <= $max_w && $alto <= $max_h) {
        return file_get_contents($origen);
    }

    $escala = min($max_w / $ancho, $max_h / $alto);
    $nuevo_ancho = (int)round($ancho * $escala);
    $nuevo_alto  = (int)round($alto * $escala);

    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $src = @imagecreatefromjpeg($origen);
            break;
        case IMAGETYPE_PNG:
            $src = @imagecreatefrompng($origen);
            break;
        case IMAGETYPE_GIF:
            $src = @imagecreatefromgif($origen);
            break;
        default:
            return file_get_contents($origen);
    }

    if (!$src) {
        return file_get_contents($origen);
    }

    $dst = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

    ob_start();
    imagejpeg($dst, null, IMG_QUALITY);
    $datos = ob_get_clean();

    imagedestroy($src);
    imagedestroy($dst);

    return $datos;
}

if (isset($_POST['reg']))
{
    if (strlen($_POST['titulo']) >= 1 && strlen($_POST['opinion']) >= 1)
    {
        session_start();
        $creador = $_SESSION['usuario'];
        $titulo = trim($_POST['titulo']);
        $opinion = trim($_POST['opinion']);
        $calificacion = trim($_POST['rate']);

        $imagen = '';
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen = redimensionar_imagen($_FILES['imagen']['tmp_name'], IMG_MAX_WIDTH, IMG_MAX_HEIGHT);
            $imagen = addslashes($imagen);
        }

        $consulta = "SELECT * FROM usuarios WHERE nombre='$creador'";
        $resultado = mysqli_query($conex, $consulta);
        $row = $resultado->fetch_array();
        $id = $row['id'];

        $consulta = "SELECT * FROM resenas WHERE creador='$creador' AND titulo='$titulo'";
        $resultado = mysqli_query($conex, $consulta);
        $rows_resul = mysqli_num_rows($resultado);

        if ($rows_resul > 0)
        {
            ?>
            <h3 class="bad">Ya tienes una reseña con ese titulo</h3>
            <?php
        }
        else
        {
            $consulta = "INSERT INTO resenas(titulo,opinion,calificacion,imagen,creador,idUsu) VALUES ('$titulo','$opinion','$calificacion','$imagen','$creador','$id')";
            $resultado = mysqli_query($conex, $consulta);
            ?>
            <h3 class="ok">Reseña creada</h3>
            <?php
            header("location:index.php");
        }
    }
}
?>
