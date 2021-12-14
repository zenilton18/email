<?php

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

    if($mensagem->MensagemValida()){
            echo'mensagem valida';
    }else{
        echo'nao valida';
    }



?>