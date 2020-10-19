<?php
session_start();
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

$siteURL = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';

require_once("classes/database.php");
require_once("classes/utils.php");
require_once("classes/vadf.php");

$ConexaoBanco = new Database();
$Utils = new Utils();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Max-Age: 86400');  

$json = json_decode(file_get_contents('php://input'), true);
$json = !empty($json) ? $json : array();
$post = $_POST;
$get = $_GET;

$dadosRecebidos = array_merge($post, $get, $json);
$validarUsuario = isset($validarUsuario) ? $validarUsuario : false;

if($validarUsuario){

    $tokenUsuario = (isset($_SESSION['tokenusuario']) && ($_SESSION['tokenusuario'] <> '')) ? $_SESSION['tokenusuario'] : $Utils->getBearerToken();
    
    if(!isset($tokenUsuario) || $tokenUsuario != null || $tokenUsuario != ''){  

        $VaDFAPI = new VaDFAPI('https://vadf.com.br/api/');    
        $dadosUsuario = $VaDFAPI->POST('usuarios/sessaoativa.php', array("tokenusuario" => $tokenUsuario));
    
        if(!array_key_exists('sucesso', $dadosUsuario) || !($dadosUsuario['sucesso'] == true)){
            $Utils->retornaErro("Usuário não logado ou sessão inválida.", 401);
            exit;
        }else{
            $dadosUsuario = $dadosUsuario["dados"];
        }
    }else{
        $Utils->retornaErro("Requer autenticação.", 401);
        exit;
    }
}

