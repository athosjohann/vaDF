<?php
require_once("../api-header.php");
require_once("badgesjogador.dao.php");

$dao = new BadgesJogadorDAO($ConexaoBanco);
$retorno = $dao->deletar($dadosRecebidos);
echo json_encode($retorno);
