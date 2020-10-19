<?php

require_once('mailer/class.phpmailer.php');

class Email {

    function __construct() {
    }

    function EnviarEmail($emailDestino, $mensagemHTML, $assuntoEmail) {
        
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "mail.vadf.com.br";
        $mail->Port = 465;
        $mail->AddAddress($emailDestino);
        $mail->Username = "nao-responder@vadf.com.br";
        $mail->Password = "nz4BtSmzs!_6";
        $mail->SetFrom('nao-responder@vadf.com.br', 'Vá DF');
        $mail->AddReplyTo("nao-responder@vadf.com.br", "Vá DF");
        $mail->Subject = $assuntoEmail;
        $mail->MsgHTML($mensagemHTML);
        $mail->Send();
    }

    function EnviarEmailCadastro($emailUsuario, $tokenUsuario){
        
        $assunto = "Confirmação de Cadastrado - VáDF";

        $mensagem = 'Olá, 
                    <br/><br/>
                    Confirme seu cadastro na VáDF para poder realizar o login, <a href="https://vadf.com.br/confirmar-email?token='.$tokenUsuario.'">clique aqui</a> ou então copie e cole o link abaixo em seu navegador.
                    <br/><br/>
                    <a href="https://vadf.com.br/confirmar-email?token='.$tokenUsuario.'">https://vadf.com.br/confirmar-email?token='.$tokenUsuario.'</a>
                    <br/><br/>
                    Obrigado por se cadastrar em nossa plataforma! :)<br/>
                    <br/>
                    Atenciosamente,<br/>
                    Equipe VáDF
                    <br/>';        

        $this->EnviarEmail($emailUsuario, $mensagem, $assunto);
    }
}

?>