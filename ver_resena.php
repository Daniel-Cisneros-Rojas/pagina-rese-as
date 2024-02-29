<?php
    include("funciones/conexion.php");
	if( isset($_GET["variable"]) )
    {
		$id=($_GET['variable']);
        session_start();
        error_reporting(0);
        $consulta="SELECT * FROM resenas WHERE id='$id'";
        $resultado=mysqli_query($conex,$consulta);
        $row=$resultado->fetch_array();
            $titulo=$row['titulo'];
            $opinion=$row['opinion'];
            $calificacion=$row['calificacion'];
            $creador=$row['creador'];
            $idUsu=$row['idUsu'];
            $imagen=$row['imagen'];

            $_SESSION['idRese']=$id;
            $_SESSION['TitRese']=$titulo;
            $_SESSION['idCreadorRese']=$idUsu;
	}
    else
    {
		echo 'Ocurrio un error';
        die();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo/style3.css">
</head>
<body>
    <form class="form-register" method="post">
    <h2><?php echo $titulo;?></h2>
    <h2>creada por:<?php echo $creador;?></h2>
    <h2><?php echo $opinion;?></h2>
    <h2>calificacion: <?php echo $calificacion;?></h2>
    <img src="data:image/jpg;base64,<?php echo base64_encode($imagen)?>" alt="">
    <h2>Comentarios</h2>
    
    <?php
    $consulta="SELECT * FROM comentarios WHERE idRese='$id'";
    $resultado=mysqli_query($conex,$consulta);
    while($row=$resultado->fetch_array())
    {
        $comentario=$row['comentario'];
        $creador_comentario=$row['usuario_creador'];
        ?>
        <h><?php echo $creador_comentario;?> : <?php echo $comentario;?></h>
        <br>
        <?php
    }
    ?>
    <input type="submit" name="reg" class="botons">
    <input type="text" name="comentario" id="comentario" required="">
    </form>

<?php
    include("funciones/comentar.php");
?> 
    
</body>
</html>