<?php
$validarUsuario = true;
require_once("../api-header.php");
require_once('funcionarios.dao.php');

$dao = new FuncionariosDAO($ConexaoBanco);
$retorno = $dao->consultar($dadosRecebidos);
echo json_encode($retorno);