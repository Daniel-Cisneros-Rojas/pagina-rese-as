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
            $mail->Username   = 'correo';                     //SMTP username
            $mail->Password   = 'token correo';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('dan493075@gmail.com', 'Resenas');
            $mail->addAddress($correo);     //Add a recipient
            
            
            
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Codigo de verificacion - Resenas';
            $mail->Body    = '
            <!DOCTYPE html>
            <html>
            <head><meta charset="UTF-8"></head>
            <body style="margin:0;padding:0;background-color:#F7F0E6;font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;">
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#F7F0E6;padding:30px 0;">
                    <tr>
                        <td align="center">
                            <table width="480" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;border-radius:16px;overflow:hidden;box-shadow:0 8px 30px rgba(93,78,55,0.15);">
                                <tr>
                                    <td style="background:linear-gradient(135deg,#D4A574 0%,#C4956A 100%);padding:30px;text-align:center;">
                                        <h1 style="margin:0;color:#FFFFFF;font-size:24px;font-weight:800;">RESE&#209;AS</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:35px 30px;text-align:center;">
                                        <h2 style="color:#5D4E37;font-size:20px;margin:0 0 10px;">Verificacion de correo</h2>
                                        <p style="color:#B8A89A;font-size:15px;margin:0 0 25px;">Hola <strong style="color:#5D4E37;">' . $usuario . '</strong>, usa el siguiente codigo para verificar tu cuenta:</p>
                                        <div style="background:#FAF7F2;border:2px dashed #93C572;border-radius:12px;padding:20px;margin:0 auto 25px;max-width:200px;">
                                            <span style="font-size:42px;font-weight:800;color:#5D4E37;letter-spacing:8px;">' . $_SESSION['codigo'] . '</span>
                                        </div>
                                        <p style="color:#B8A89A;font-size:13px;margin:0;">Este codigo expirara en 1 minuto por seguridad.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#FAF7F2;padding:20px 30px;text-align:center;border-top:1px solid #E8D5C0;">
                                        <p style="margin:0;color:#B8A89A;font-size:12px;">&copy; 2026 RESE&#209;AS &mdash; Todos los derechos reservados</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $mail->AltBody = 'Tu codigo de verificacion es: ' . $_SESSION['codigo'];
        
            $mail->send();
            echo '';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
   

    

?>

<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://kit.fontawesome.com/fee347bc49.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="estilo/forms.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar correo</title>
    
</head>
<body>
    <form method="post" autocomplete="off">
        <h2><i class="fa-solid fa-envelope-circle-check" style="color: #93C572; margin-right: 8px;"></i>Verificacion</h2>
    
        <i class="fa-solid fa-shield-halved" style="font-size: 40px; color: #D4A574; margin-bottom: 15px; display: block;"></i>
        <h4>Se envio un codigo a tu correo</h4>

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
    
    <div class="input-container" style="margin-top: 25px;">
        <i class="fa-solid fa-key"></i>
        <input class="controls" type="text" name="codigo" id="codigo" placeholder="Ingresa el codigo" required pattern="[0-9]+" style="padding-left: 50px;">
    </div>
    <input type="submit" name="send" class="btn" value="Confirmar">



    <script src="funciones/contador.js"></script>
    </form>
    
    <?php
      include("funciones/validar_correo.php");
    ?>
    
      
</body>
</html>
