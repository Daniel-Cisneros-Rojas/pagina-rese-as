<?php
session_start();
if(isset($_POST['reg']))
{
        
        $filtro=trim($_POST['filtro']);
        $_SESSION['filtro']=$filtro;
        ?>
        <script>window.history.go(-1)</script>
        <?php
    
        
}

?>