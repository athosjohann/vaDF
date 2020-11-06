<?php

require_once("email/class.phpmailer.php");

Class Email {

    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();  // Ativar SMTP
        $this->mail->SMTPDebug = 2;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $this->mail->Debugoutput = 'html';
        $this->mail->SMTPAuth = true;  // Autenticação ativada
        $this->mail->SMTPSecure = 'tls';
    }

    public function ConfigEmail($emailsaida, $senha, $host, $porta, $de_nome) {
        $this->mail->Host = $host;                 // SMTP utilizado
        $this->mail->Port = intval($porta);    // A porta 587 deverá estar aberta em seu servidor
        $this->mail->Username = $emailsaida;
        $this->mail->Password = $senha;
        $this->mail->SetFrom($emailsaida, $de_nome);
    }

    function EnviarEmail($para, $assunto, $corpo) {
        $this->mail->Subject = $assunto;
        $this->mail->Body = $corpo;
        $this->mail->IsHTML(true);
        $this->mail->AddAddress($para);
        // $mail->Send();
        if (!$this->mail->send()) {
            $error = $this->mail->ErrorInfo;
            echo $error;
        }
    }

}
