<?php
include("conexion.php");


   if(isset($_POST['reg']))
  {
    
    if(strlen($_POST['usuarios'])>=1 && strlen($_POST['contrasenas'])>=1 && strlen($_POST['correo'])>=1){
     $usuarios=trim($_POST['usuarios']);
     $contrasenas=trim($_POST['contrasenas']);
     $correo=trim($_POST['correo']);
     
    $consulta="SELECT * FROM usuarios WHERE nombre='$usuarios'";
    $resultado=mysqli_query($conex,$consulta);
    $rows_usuarios=mysqli_num_rows($resultado);

    $consulta="SELECT * FROM usuarios WHERE correo='$correo'";
    $resultado=mysqli_query($conex,$consulta);
    $rows_correos=mysqli_num_rows($resultado);
    if($rows_usuarios>0)
    {
      ?>
       <h3 class="bad">El usuario ya existe</h3>
      <?php
    }
    else if($rows_correos>0){
      ?>
       <h3 class="bad">El correo ya esta registrado</h3>
      <?php
    }
    else{
      ?>
     
      <h3 class="ok">Datos correctos</h3>
      
      <?php
      $consulta="INSERT INTO usuarios(nombre,contraseña,correo) VALUES ('$usuarios','$contrasenas','$correo')";
      $resultado=mysqli_query($conex,$consulta);

      session_start();
      $_SESSION['usuario']=$usuarios;
      header("location:index.php");
    }
    
   
  }
}
?>