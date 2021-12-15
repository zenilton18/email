<?php

    
    require './bibliotecas/PHPmailer/Exception.php';
    require './bibliotecas/PHPmailer/PHPMailer.php';
    require './bibliotecas/PHPmailer/OAuth.php';
    require './bibliotecas/PHPmailer/POP3.php';
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
            echo'mensagem nao  valida';
    }else{
       //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'teste87651@gmail.com';                     //SMTP username
            $mail->Password   = '87651teste';                               //SMTP password
            $mail->SMTPSecure = 'tls' ;            // Habilita a criptografia TLS implícita 
            $mail->Port       = 587; 

            //Recipients
            $mail->setFrom('teste87651@gmail.com', 'testeemail');
            $mail->addAddress('teste87651@gmail.com', ' User');     //Add a recipient
            $mail->addAddress('teste87651@gmail.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
           // $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'assunto';
            $mail->Body    = 'body <b>aaaaaaa!</b>';
            $mail->AltBody = 'caso nao funcione ';

            $mail->send();
            echo 'sucesso';
        } catch (Exception $e) {
            echo "
            Error: {$mail->ErrorInfo}";
        }
    }
?>