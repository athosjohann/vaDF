<?php

require_once('../api-header.php');
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);

if(!isset($dadosRecebidos['tokenusuario']) || $dadosRecebidos['tokenusuario'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Link inválidou ou expirado.");
    echo json_encode($retorno);
    exit;
}

$retorno = $dao->confirmarEmail($dadosRecebidos);
echo json_encode($retorno);

?>

