<?php
session_start();
require_once 'classes/usuario.php';
require_once 'classes/servicosapi.php';
$siteURL = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';

$Usuario = new Usuario();

if (!$Usuario->EstaLogado()) {
    $Usuario->Redirecionar('login.php');
    exit;
}else{
    $ServicosAPI = new ServicosAPI($siteURL, $_SESSION['tokenusuario']);
    $Usuario = new Usuario($ServicosAPI);
}
?><!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Painel Vá DF">
        <meta name="keyword" content="Vá DF">
        <meta name="author"  content="Vá DF"/>
        <!-- Page Title -->
        <title>Menu | Painel Vá DF</title>
        <!-- Main CSS -->			
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/bootstrap/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/font-awesome/css/font-awesome.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/simple-line-icons/css/simple-line-icons.css">
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/ionicons/css/ionicons.css">
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/css/app.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/css/style.min.css"/>
        <!-- Favicon -->	
        <link rel="icon" href="<?=$siteURL?>favicon.ico" type="image/x-icon" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            body {
                background-image: url('assets/metrical-light/images/login-background.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
              }
        </style>
    </head>
    <body>
        <!--================================-->
        <!-- User Singin Start -->
        <!--================================-->			
        <div class="ht-100v d-flex">
            <div class="card shadow-none pd-20 mx-auto wd-300 text-center bd-1 align-self-center">
                <p>                    
                    <img class="desktop-logo" src="assets/metrical-light/images/vadflogo.png" alt="">
                </p>                                         
                <div class="login-wrap">
                    
                        <a href="admin" class="btn btn-danger btn-block mg-b-10">Administração</a>
                    
 
                    <hr>  
                    <a href="logout.php" class="dropdown-item"><i class="icon-power" aria-hidden="true"></i> Sair</a>                    
                </div>
                </form>
            </div>
        </div>
        <!-- Footer Script -->
        <!--================================-->	
        <script src="assets/metrical-light/plugins/jquery/jquery.min.js"></script>
        <script src="assets/metrical-light/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="assets/metrical-light/plugins/popper/popper.js"></script>
        <script src="assets/metrical-light/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/metrical-light/plugins/pace/pace.min.js"></script>
        <script src="assets/metrical-light/js/jquery.slimscroll.min.js"></script>
        <script src="assets/metrical-light/js/custom.js"></script>
    </body>
</html>