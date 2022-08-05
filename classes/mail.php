<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class mail{

    private $mail = null;
    
    function __construct(){
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->Username = "uptask21441@gmail.com";
        $this->mail->Password = "xirekudnxdieptbh";
        $this->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
    }


    public function confirmar( string $nombre, string $correo, $token  ){
        $this->mail->setFrom("appendouptaskero@gmail.com", "Creacion de Cuenta");
        $this->mail->addAddress($correo,$nombre);
        $this->mail->Subject = "Confirmacion de Cuenta";


        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$nombre. "</strong> has creado tu cuenta en UpTask, solo debes confirmarla en el siguiente enlace</p>";
        $contenido.="<p>Visita la siguiente pagina: <a href='http://".$_SERVER['HTTP_HOST']."/confirmar?token=".$token."'>Confirmar</a> </p> ";
        $contenido.="<p>Si tu no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido.="</html>";
     

        $this->mail->Body = $contenido;
        $this->mail->isHTML(true);
        $this->mail->CharSet = "UTF-8";
        return $this->mail->send();
    }

    public function reestablecer( string $nombre, string $correo, $token  ){
        $this->mail->setFrom("frutiapptest@gmail.com", "Creacion de Cuenta");
        $this->mail->addAddress($correo,$nombre);
        $this->mail->Subject = "Confirmacion de Cuenta";


        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$nombre. "</strong> has solicitado reestablcer tu contraseña</p>";
        $contenido.="<p>Visita la siguiente pagina: <a href='http://".$_SERVER['HTTP_HOST']."/reestablecer?token=".$token."'>Reestablecer</a> </p> ";
        $contenido.="</html>";
     

        $this->mail->Body = $contenido;
        $this->mail->isHTML(true);
        $this->mail->CharSet = "UTF-8";
        return $this->mail->send();
    }
}