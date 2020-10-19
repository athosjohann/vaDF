<?php
require_once("../api-header.php");
require_once("pontosturisticoscircuitos.dao.php");

$dao = new PontosTuristicosCircuitosDAO($ConexaoBanco);
$retorno = $dao->consultar($dadosRecebidos);
echo json_encode($retorno);