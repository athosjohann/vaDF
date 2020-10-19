<?php
require_once("../api-header.php");
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);
if(!isset($dadosRecebidos['email']) || trim($dadosRecebidos['email']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail não informado.");
    echo json_encode($retorno);
    exit;
}

if($dao->emailExiste($dadosRecebidos['email'])){
    $retorno = array("sucesso" => false, "mensagem" => "Já existe um usuário cadastrado com o e-mail informado.");
    echo json_encode($retorno);
    exit;
} else {
    $retorno = array("sucesso" => true, "mensagem" => "Email ainda não cadastrado");
    echo json_encode($retorno);
}