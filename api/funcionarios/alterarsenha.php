<?php
$validarUsuario = true;
require_once('../api-header.php');
require_once('funcionarios.dao.php');

$dao = new FuncionariosDAO($ConexaoBanco);

if(!isset($dadosRecebidos['email']) || $dadosRecebidos['email'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['senha']) || $dadosRecebidos['senha'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Senha alterior não informada.");
    echo json_encode($retorno);
    exit;
} 

if(!isset($dadosRecebidos['novasenha']) || $dadosRecebidos['novasenha'] == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Nova senha não informada.");
    echo json_encode($retorno);
    exit;
} 

$retorno = $dao->alterarSenha($dadosRecebidos);
echo json_encode($retorno);

?>

