<?php

    require './bibliotecas/PHPmailer/Exception.php';
    require './bibliotecas/PHPmailer/PHPMailer.php';
    require './bibliotecas/PHPmailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{

        private $para= null;
        private $assunto=null;
        private $mensagem=null;


        function __get($attr){
            return $this->$attr;
        }

        function __set($attr,$value){
            $this->$attr=$value;
        }

        function MensagemValida(){
            if(empty($this->para)||empty($this->assunto)|| empty($this->mensagem)){
               return false;
            }else{
                return true;
            }  
        }

    }

    $mensagem= new Mensagem();
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->MensagemValida()){
            echo'mensagem valida';
    }else{
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-relay.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'teste87651@gmail.com';                     //SMTP username
            $mail->Password   = '87651teste';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('teste87651@gmail.com', 'teste');
            $mail->addAddress('teste87651@gmail.com', 'destinatario User');     //Add a recipient
            
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'oi ass ';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'sucesso';
        } catch (Exception $e) {
            echo "Erros ao enviar mensagem: {$mail->ErrrInfo}";
        }
            }


?>