<?php
require_once("../api-header.php");
require_once("pontosturisticoscircuitos.dao.php");

$dao = new PontosTuristicosCircuitosDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
