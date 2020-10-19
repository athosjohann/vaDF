<?php
require_once("../api-header.php");
require_once("circuitojogador.dao.php");

$dao = new CircuitoJogadorDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
