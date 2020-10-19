<?php
require_once("../api-header.php");
require_once("badges.dao.php");

$dao = new BadgesDAO($ConexaoBanco);
$retorno = $dao->cadastrar($dadosRecebidos);
echo json_encode($retorno);
