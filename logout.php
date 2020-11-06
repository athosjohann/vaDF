<?php

session_start();
ob_start();

require_once 'classes/usuario.php';
$Usuario = new Usuario();

if (!$Usuario->EstaLogado()){
    $Usuario->Redirecionar('login.php');
}

if ($Usuario->EstaLogado()){
    $Usuario->Logout();
    $Usuario->Redirecionar('login.php');
}

?>