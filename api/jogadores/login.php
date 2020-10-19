<?php
require_once('../api-header.php');
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);

if(!isset($dadosRecebidos['email']) || $dadosRecebidos['email'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['senha']) || $dadosRecebidos['senha'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Senha não informada.");
    echo json_encode($retorno);
    exit;
} 

$retorno = $dao->login($dadosRecebidos);
echo json_encode($retorno);

?>

