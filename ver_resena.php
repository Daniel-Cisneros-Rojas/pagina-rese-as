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
    <script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="scroll">

    
    <div class="resena-view">
    <div class="view">
    <h3><?php echo $titulo;?></h3>
    <h2>calificacion:</h2>
    <div class="stars">
        <?php
        for($i=1;$i<6;$i++)
        {
            if($i<=$calificacion)
            {
                ?>
                <i class="fas fa-star"></i>
                <?php
            }
            else
            {
                ?>
                <i class="fa-regular fa-star"></i>
                <?php
            }
            
        }
        ?>
    
    </div>
    
    <div class="creador">creada por:<?php echo $creador;?></div>
    <div class="opinion"><?php echo $opinion;?></div>
    
    
    <img src="data:image/jpg;base64,<?php echo base64_encode($imagen)?>" alt="" width="300" height="350">
    <h2>Comentarios</h2>
    
    <?php
    $consulta="SELECT * FROM comentarios WHERE idRese='$id'";
    $resultado=mysqli_query($conex,$consulta);
    while($row=$resultado->fetch_array())
    {
        $comentario=$row['comentario'];
        $creador_comentario=$row['usuario_creador'];
        ?>
        <div class="comentario"><?php echo $creador_comentario;?> : <?php echo $comentario;?></div>
        <br>
        <?php
    }
    ?>
    <form class="form-register" method="post">
    <input type="text" name="comentario" id="comentario" required="" class="txtcom" placeholder="Escribe aqui">
    <input type="submit" name="reg" class="botons" value="comentar">
    </form>

    </div>
    </div>
    </div>
<?php
    include("funciones/comentar.php");
?> 
    
</body>
</html>