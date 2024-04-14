<?php
include("conexion.php");
session_start();
error_reporting(0);


if(isset($_POST['borrar']))
{
$id=$_SESSION['idRese'];

$consulta="DELETE FROM resenas WHERE id='$id'";
$resultado=mysqli_query($conex,$consulta);
?>
<script>
    window.location.replace("index.php");
</script>
<?php
}
?>