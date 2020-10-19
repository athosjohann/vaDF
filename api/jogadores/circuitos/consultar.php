<?php
require_once("../api-header.php");
require_once("circuitojogador.dao.php");

$dao = new CircuitoJogadorDAO($ConexaoBanco);
$retorno = $dao->consultar($dadosRecebidos);
echo json_encode($retorno);