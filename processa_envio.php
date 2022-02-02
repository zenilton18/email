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
