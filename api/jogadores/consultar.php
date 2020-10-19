<?php
require_once("../api-header.php");
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);
$retorno = $dao->consultar($dadosRecebidos);
echo json_encode($retorno);