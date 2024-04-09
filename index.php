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
    <script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
   
</head>
<body>
    <header>
    <h1>RESEÑAS</h1>
        <nav>
        
            <ul>
            
                <li><a href="registro.php">Registrarse</a></li>

                <?php
     session_start();
    error_reporting(0);
    $varsesion=$_SESSION['usuario'];
    $usuario=$_SESSION['usuario'];
    $filtro=$_SESSION['filtro'];
    

    if($varsesion==null||$varsesion='')
    {
        ?>
        
        <li><a href="login.php">Iniciar sesion</a></li>
        
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
            
            <li><a href="validacion_correo.php">verificar correo</a></li>
             
            <?php
        }
        
        ?>
        
        <li><a href="cerrar_sesion.php">cerrar sesion</a></li>
       
        <li><a href="crear_resena.php">crear reseña</a></li>
       
            
    <?php
    }
?>
            <form action="" method="post" id="filtro">
                <li><input type="text" name="filtro" id="filtro" placeholder="titulo a buscar" form="filtro" class="filtrostxt" ></li>
                <li><input type="submit" name="reg" value="Filtrar" form="filtro" class="filtrosbtn" ></li>
            </form>
      </ul>
        </nav>
    </header>          
    <div class="container">
    <div class="resenas-container">
   <?php

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
 
             
            if($filtro==null||$filtro=='')
            {
                ?>
                <div class="resena" data-name="p-1">
                <img src="data:image/jpg;base64,<?php echo base64_encode($imagen)?>" alt="" width="300" height="350">
                <h3><?php echo $titulo;?></h3>
                <div class="creador">by :<?php echo $creador;?></div>
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
                <p><a href="ver_resena.php?variable=<?php echo $id;?>">ver reseña</a></p>
                </div>
                
                <?php
            }
            else if(strpos($titulo,$filtro) !== false)
            {
                ?>
                <div class="resena" data-name="p-1">
                <img src="data:image/jpg;base64,<?php echo base64_encode($imagen)?>" alt="" width="300" height="350">
                <h3><?php echo $titulo;?></h3>
                <div class="creador">by :<?php echo $creador;?></div>
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
                <p><a href="ver_resena.php?variable=<?php echo $id;?>">ver reseña</a></p>
                </div>
                
                <?php
            }
            ?>
            
            <?php
        }
        
    
    ?>
    </div>
    </div>
    <?php
    include("funciones/filtrar_resena.php");
?>
</body>
</html>

