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
        public  $status = array( 'codigo_status' => null, 'b' => '' );


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
           header('location: index.php');
    }else{
       //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = false;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'teste87651@gmail.com';                     //SMTP username
            $mail->Password   = '87651teste';                               //SMTP password
            $mail->SMTPSecure = 'tls' ;            // Habilita a criptografia TLS implícita 
            $mail->Port       = 587; 

            //Recipients
            $mail->setFrom('teste87651@gmail.com');
            $mail->addAddress($mensagem->__get('para'));     //Add a recipient
            //$mail->addAddress('teste87651@gmail.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
           // $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mensagem->__get('assunto');
            $mail->Body    = $mensagem->__get('assunto');
            $mail->AltBody = 'caso nao funcione ';

            $mail->send();

            
            $mensagem->status['codigo_status'] = 1;
			$mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';

        } catch (Exception $e) {
            
            $mensagem->status['codigo_status']=2;
            $mensagem->status['descricao_status']= 'Não foi possivel enviar seu email, tente novamente mais tarde! , detalhe do erro:'       . $mail->ErrorInfo . '';
            
        }

    }
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Ze Mail Send</title>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>
        <body>
            <div class="container">
                <div class="py-3 text-center">
                    <img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
                    <h2>Ze Mail</h2>
                    <p class="lead">Seu app de envio de e-mails particular!</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                          if($mensagem->status['codigo_status']==1){ ?>

                             <div class="container">
                                 <h1 class="display-4 text-success">Sucesso</h1>
                                 <p><?php echo $mensagem->status['descricao_status']?>  </p>  
                                 <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
                             </div>

                          <?php } ?>
                        <?php
                          if($mensagem->status['codigo_status']==2){ ?>

                            <div class="container">
                                 <h1 class="display-4 text-danger">Ops!</h1>
                                 <p><?php echo $mensagem->status['descricao_status']  ?>  </p>  
                                 <a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
                             </div>

                        <?php } ?>


                    </div>
                </div>

            </div>
            
        </body>
    </html>