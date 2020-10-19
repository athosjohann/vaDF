<?php
require_once('../api-header.php');
require_once('jogadores.dao.php');

$dao = new JogadoresDAO($ConexaoBanco);

if(!isset($dadosRecebidos['tokenusuario'])){
    $retorno = array("sucesso" => false, "mensagem" => "Token do usuário não informado.");
}
else{
     $retorno = $dao->ObterDadosUsuarioToken($dadosRecebidos['tokenusuario']);
}
 
$jsonRetorno = json_encode($retorno);
echo $jsonRetorno;

?>
