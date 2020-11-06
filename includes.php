<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/classes/usuario.php';
require_once dirname(__FILE__).'/classes/servicosapi.php';
require_once dirname(__FILE__).'/classes/funcoes.php';
$siteURL = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';

//tratamento de url
$urlArray = explode("/",ltrim($_SERVER['SCRIPT_NAME'],"/"));
$diretorioCompleto = array_reverse($urlArray);
$paginaAtual = isset($diretorioCompleto[0]) ? $diretorioCompleto[0] : "";
$diretorioAtual = isset($diretorioCompleto[1]) ? $diretorioCompleto[1] : "";
$diretorioAnterior = isset($diretorioCompleto[2]) ? $diretorioCompleto[2] : "";

$urlApi = "https://va-df.herokuapp.com/";

$ServicosAPI = new ServicosAPI($urlApi, $_SESSION['tokenusuario']);
$Usuario = new Usuario($ServicosAPI);
$Funcoes = new Funcoes();

$json = json_decode(file_get_contents('php://input'), true);
$json = !empty($json) ? $json : array();

$dadosRecebidos = array_merge($_GET, $_POST, $json);

?>