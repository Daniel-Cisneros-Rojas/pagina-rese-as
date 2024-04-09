<?php
include("conexion.php");
if(isset($_POST['reg']))
{
    if(strlen($_POST['titulo'])>=1 && strlen($_POST['opinion'])>=1)
    {
        session_start();
        $creador=$_SESSION['usuario'];
        $titulo=trim($_POST['titulo']);
        $opinion=trim($_POST['opinion']);
        $calificacion=trim($_POST['rate']);
        $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));


        $consulta="SELECT * FROM usuarios WHERE nombre='$creador'";
        $resultado=mysqli_query($conex,$consulta);
        $row=$resultado->fetch_array();
        $id=$row['id'];

        $consulta="SELECT * FROM resenas WHERE creador='$creador' AND titulo='$titulo'";
        $resultado=mysqli_query($conex,$consulta);
        $rows_resul=mysqli_num_rows($resultado);
        
        
         if($rows_resul>0)
         {
         ?>
            <h3 class="bad">Ya tienes una reseña con ese titulo</h3>
         <?php
         }
         else
         {
            $consulta="INSERT INTO resenas(titulo,opinion,calificacion,imagen,creador,idUsu) VALUES ('$titulo','$opinion','$calificacion','$imagen','$creador','$id')";
            $resultado=mysqli_query($conex,$consulta);
            ?>
              <h3 class="ok">Reseña creada</h3>
             <?php
             header("location:index.php");
            
         }

    }

}

?>