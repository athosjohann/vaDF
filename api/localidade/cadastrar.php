<?php
require_once("../api-header.php");
require_once("pontosturisticos.dao.php");

$dao = new PontosTuristicosDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
