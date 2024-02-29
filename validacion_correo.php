<?php
include("funciones/conexion.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

    session_start();
    error_reporting(0);
    //generar codigo verif
    $codigo=$_SESSION['codigo'];
    $usuario=$_SESSION['usuario'];
    $intentos=$_SESSION['intentos'];
    if($codigo==null||$codigo=='')
    {
    srand(time());
    $_SESSION['codigo']= rand(100,999);
    $codigo=$_SESSION['codigo'];    
    }
    if($intentos==null||$intentos=='')
    {
     $_SESSION['intentos']=3;
    }

      //buscar correo usuario
    $consulta="SELECT * FROM usuarios WHERE nombre='$usuario'";
    $resultado=mysqli_query($conex,$consulta);
    $row=$resultado->fetch_array();
    $correo=$row['correo'];

    if($_SESSION['intentos']==3)
    {
        try {
       
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dan493075@gmail.com';                     //SMTP username
            $mail->Password   = 'lsnc ddrr xiuq ymko';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('dan493075@gmail.com', 'Solicitud');
            $mail->addAddress($correo);     //Add a recipient
            
            
            
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Codigo verificacion';
            $mail->Body    = $_SESSION['codigo'];
            $mail->AltBody = 'su correo no soporta html';
        
            $mail->send();
            echo '';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
   

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="estilo/style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiempo de espera</title>
    
</head>
<body>
    <form method="post" autocomplete"off">
        <h2>Verificacion correo</h2>
    <div class="temporizador">
      
        <div class="bloque">
           <div class="minutos" id="minutos">--</div>
           <p>MINUTOS</p>
        </div>

        <div class="bloque">
           <div class="segundos" id="segundos">--</div>
           <p>SEGUNDOS</p>  
        </div>
    </div>
    
    <div class="input-container">
    
    </div>
    <h4>Se mando un correo con su codigo de verificacion</h4>
    <input class="controls" type="text" name="codigo" id="codigo" placeholder="Ingrese su codigo" required="" pattern="[0-9]+">
    <input type="submit" name="send" class="btn" value="Confirmar">

<h3>codigo: <?php echo $_SESSION['codigo'];  ;?></h3>

    <script src="funciones/contador.js"></script>
    </form>
    
    <?php
      include("funciones/validar_correo.php");
    ?>
    
      
</body>
</html>