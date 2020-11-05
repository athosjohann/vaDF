<?php
require_once("../api-header.php");
require_once('funcionarios.dao.php');

$dao = new FuncionariosDAO($ConexaoBanco);

if(!isset($dadosRecebidos['matricula']) || trim($dadosRecebidos['matricula']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Id. Usuario invalido");
    echo json_encode($retorno);
    exit;
}

$retorno = $dao->atualizar($dadosRecebidos);
echo json_encode($retorno);
