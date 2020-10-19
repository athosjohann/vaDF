<?php
require_once("../api-header.php");
require_once("pontosturisticosjogador.dao.php");

$dao = new PontosTuristicosJogadorDAO($ConexaoBanco);
$retorno = $dao->deletar($dadosRecebidos);
echo json_encode($retorno);
