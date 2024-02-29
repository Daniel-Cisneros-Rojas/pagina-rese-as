<?php
include("conexion.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

if(isset($_POST['reg']))
{
    if(strlen($_POST['comentario'])>=1)
    {
        $comentario=trim($_POST['comentario']);
        session_start();
        error_reporting(0);
        $idRese=$_SESSION['idRese'];
        $usuario=$_SESSION['usuario'];
        $idcreadorRes=$_SESSION['idCreadorRese'];
        $titrese=$_SESSION['TitRese'];

        if($usuario==null||$usuario=='')
        {
           echo 'necesitas iniciar sesion para poder comentar';
        }
        else
        {
            $consulta="SELECT * FROM comentarios WHERE comentario='$comentario' AND usuario_creador='$usuario' ";
            $resultado=mysqli_query($conex,$consulta);
            $rows_usuarios=mysqli_num_rows($resultado);

            if($rows_usuarios>0)
            {
            
            }
            else
            {
                $consulta="INSERT INTO comentarios(comentario,usuario_creador,idRese) VALUES ('$comentario','$usuario','$idRese')";
                $resultado=mysqli_query($conex,$consulta);
    
                $consulta="SELECT * FROM usuarios WHERE id='$idcreadorRes'";
                $resultado=mysqli_query($conex,$consulta);
                $row=$resultado->fetch_array();
                $verificado=$row['verificado'];
                $correo=$row['correo'];
                if($verificado==1||$verificado=='1')
                {
                    
                    $texto_subject=$usuario . " ha comentado";
                    $texto_cuerpo=$usuario . " ha comentado " . $comentario . " en su reseña " . $titrese;
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
                        $mail->Subject = $texto_subject;
                        $mail->Body    = $texto_cuerpo;
                        $mail->AltBody = 'su correo no soporta html';
                    
                        $mail->send();
                        echo '';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }

                echo '<script type="text/JavaScript"> location.reload(); </script>';
            }

           
            
        }

    }

}


?>