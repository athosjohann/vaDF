<?php
require_once("../api-header.php");
require_once("pontosturisticosjogador.dao.php");

$dao = new PontosTuristicosJogadorDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
