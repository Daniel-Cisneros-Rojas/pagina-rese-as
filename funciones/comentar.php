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
                    
                    $texto_subject=$usuario . " ha comentado en tu reseña";
                    $texto_cuerpo='
                    <!DOCTYPE html>
                    <html>
                    <head><meta charset="UTF-8"></head>
                    <body style="margin:0;padding:0;background-color:#F7F0E6;font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#F7F0E6;padding:30px 0;">
                            <tr>
                                <td align="center">
                                    <table width="480" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;border-radius:16px;overflow:hidden;box-shadow:0 8px 30px rgba(93,78,55,0.15);">
                                        <tr>
                                            <td style="background:linear-gradient(135deg,#93C572 0%,#A8D88A 100%);padding:25px 30px;text-align:center;">
                                                <h1 style="margin:0;color:#FFFFFF;font-size:22px;font-weight:800;">💬 Nuevo comentario</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:30px;">
                                                <p style="color:#5D4E37;font-size:16px;margin:0 0 15px;">
                                                    Hola, <strong style="color:#5D4E37;">' . $usuario . '</strong> ha comentado en tu rese&ntilde;a 
                                                    <strong style="color:#93C572;">"' . $titrese . '"</strong>:
                                                </p>
                                                <div style="background:#FAF7F2;border-left:4px solid #93C572;border-radius:8px;padding:15px 20px;margin:0 0 15px;">
                                                    <p style="margin:0;color:#5D4E37;font-size:15px;font-style:italic;">"' . $comentario . '"</p>
                                                </div>
                                                <p style="color:#B8A89A;font-size:13px;margin:0;">
                                                    Inicia sesi&oacute;n para ver la conversaci&oacute;n completa.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background:#FAF7F2;padding:15px 30px;text-align:center;border-top:1px solid #E8D5C0;">
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
                        $mail->Subject = $texto_subject;
                        $mail->Body    = $texto_cuerpo;
                        $mail->AltBody = $usuario . ' ha comentado "' . $comentario . '" en tu reseña "' . $titrese . '"';
                    
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
