<?php
require_once("../api-header.php");
require_once('funcionarios.dao.php');

$dao = new FuncionariosDAO($ConexaoBanco);

if(!isset($dadosRecebidos['email']) || trim($dadosRecebidos['email']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail não informado.");
    echo json_encode($retorno);
    exit;
}

if(!preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $dadosRecebidos['email'])){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail informado é inválido.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['nome_funcionario']) || trim($dadosRecebidos['nome_funcionario']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Nome não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['senha']) || trim($dadosRecebidos['senha']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Senha não informada.");
    echo json_encode($retorno);
    exit;
} 

$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
