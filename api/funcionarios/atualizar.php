<?php
require_once("../api-header.php");
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);

if(!isset($dadosRecebidos['idusuario']) || trim($dadosRecebidos['idusuario']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Id. Usuario invalido");
    echo json_encode($retorno);
    exit;
}

$retorno = $dao->atualizar($dadosRecebidos);
echo json_encode($retorno);
