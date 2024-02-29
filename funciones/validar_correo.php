<?php
include("conexion.php");
if(isset($_POST['send'])) {
    if(strlen($_POST['codigo'])>=1)
    {
        $codigo_puesto=trim($_POST['codigo']);
        session_start();
        if($_SESSION['codigo']==$codigo_puesto)
        {
            ?>
            <h3 class="ok">codigo correcto</h3>
            <?php
            $usuario=$_SESSION['usuario'];
            $consulta="UPDATE usuarios SET verificado=1 WHERE nombre='$usuario'";
            $resultado=mysqli_query($conex,$consulta);
            header("location:index.php");
        }
        else
        {
            $_SESSION['intentos']=$_SESSION['intentos']-1;
            ?>
            <h3 class="bad">codigo incorrecto , intentos restantes: <?php echo $_SESSION['intentos'];?></h3>
            <?php

            if($_SESSION['intentos']<=0)
            {
                header("location:cerrar_sesion.php");
            }

        }
    }
}

?>