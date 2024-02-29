<?php
include("conexion.php");
if(isset($_POST['reg']))
{
    if(strlen($_POST['usuarios'])>=1 && strlen($_POST['contrasenas'])>=1)
    {
        $usuarios=trim($_POST['usuarios']);
        $contrasenas=trim($_POST['contrasenas']);

        $consulta="SELECT * FROM usuarios WHERE nombre='$usuarios' AND contraseña='$contrasenas'";
        $resultado=mysqli_query($conex,$consulta);
        $rows_usuarios=mysqli_num_rows($resultado);

        if($rows_usuarios>0)
        {
            session_start();
            $_SESSION['usuario']=$usuarios;
            
            header("location:index.php");
        }
        else
        {
            ?>
            <h3 class="bad">Datos incorrectos</h3>
            <?php
        }
    }

}


?>