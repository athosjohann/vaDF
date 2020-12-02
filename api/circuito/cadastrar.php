<?php
require_once("../api-header.php");
require_once("circuitos.dao.php");

$dao = new CircuitosDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
