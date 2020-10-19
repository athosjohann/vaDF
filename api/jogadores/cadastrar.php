<?php
require_once("../api-header.php");
require_once("usuarios.dao.php");
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);
$email = new Email();

if(!isset($dadosRecebidos['email']) || trim($dadosRecebidos['email']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail não informado.");
    echo json_encode($retorno);
    exit;
}

if($dao->emailExiste($dadosRecebidos['email'])){
    $retorno = array("sucesso" => false, "mensagem" => "Já existe um usuário cadastrado com o e-mail informado.");
    echo json_encode($retorno);
    exit;
}

if(!preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $dadosRecebidos['email'])){
    $retorno = array("sucesso" => false, "mensagem" => "E-mail informado é inválido.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['nome_jogador']) || trim($dadosRecebidos['nome_jogador']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Nome não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['data_nascimento']) || trim($dadosRecebidos['data_nascimento']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Data de nascimento não informada.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['senha']) || trim($dadosRecebidos['senha']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Senha não informada.");
    echo json_encode($retorno);
    exit;
} 

if(!isset($dadosRecebidos['coordenadas']) || trim($dadosRecebidos['coordenadas']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Coordenadas do jogador não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['experiencia']) || trim($dadosRecebidos['experiencia']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Experiencia do jogador não informado.");
    echo json_encode($retorno);
    exit;
}

if(!isset($dadosRecebidos['titulo']) || trim($dadosRecebidos['titulo']) == ''){
    $retorno = array("sucesso" => false, "mensagem" => "Titulo do jogador não informado.");
    echo json_encode($retorno);
    exit;
}

$retorno = $dao->cadastrar($dadosRecebidos);

if($retorno['sucesso'] == true){
    $email->EnviarEmailCadastro($retorno['dados']['email'], $retorno['dados']['token']);
}

echo json_encode($retorno);
