<?php
include("funciones/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilo/style3.css">
   
</head>
<body>
    
    <form action="">
    
    <h2>INSTRUCCIONES</h2>
    <a href="registro.php">Registrarse</a>

    <?php
    session_start();
    error_reporting(0);
    $varsesion=$_SESSION['usuario'];
    $usuario=$_SESSION['usuario'];

    if($varsesion==null||$varsesion='')
    {
        ?>
        <br>
        <a href="login.php">Iniciar sesion</a>
        <?php
      
    }
    else
    {
        $consulta="SELECT * FROM usuarios WHERE nombre='$usuario'";
        $resultado=mysqli_query($conex,$consulta);
        $row=$resultado->fetch_array();
        $verificado=$row['verificado'];

        if($verificado=='0')
        {
            ?>
            <br>
             <a href="validacion_correo.php">verificar correo</a>
            <?php
        }
        
        ?>
        <br>
        <a href="cerrar_sesion.php">cerrar sesion</a>
        <br>
        <a href="crear_resena.php">crear reseña</a>
        <?php
    }

        $consulta="SELECT * FROM resenas";
        $resultado=mysqli_query($conex,$consulta);
       
        while($row=$resultado->fetch_array())
        {
            $id=$row['id'];
            $titulo=$row['titulo'];
            $opinion=$row['opinion'];
            $calificacion=$row['calificacion'];
            $creador=$row['creador'];
            $imagen=$row['imagen'];
            $idUsu=$row['idUsu'];

            ?>
            <h2><?php echo $titulo;?>  creada por:<?php echo $creador;?></h2>
            <h2>calificacion: <?php echo $calificacion;?></h2>
            <img src="data:image/jpg;base64,<?php echo base64_encode($imagen)?>" alt="">
            <p><a href="ver_resena.php?variable=<?php echo $id;?>">ver reseña</a></p>
            <?php
        }
        
    
    ?>
    
    </form>
    
</body>
</html>

