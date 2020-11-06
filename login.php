<?php
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/includes.php";    

if ($Usuario->EstaLogado()) {
    $Usuario->Redirecionar('index.php');
    exit;
}

if (isset($_POST['btnLogin'])) {

    if (isset($_POST["salvarUsuario"]) && $_POST["salvarUsuario"] == "S"){
        setcookie("login", $_POST["login"], time() + (3600*24*30*12*5));
    }

    // if(!isset($_POST["g-recaptcha-response"]) || $_POST["g-recaptcha-response"] == ""){
    //     $retorno = array("sucesso" => false, "mensagem" => "Captcha não resolvido.");
    // }else{
    //     $captcha = $_POST["g-recaptcha-response"];
    //     $secretKey = "6Lcvp7IZAAAAAEsItCQKAwBXiKTiJG6YVUO9W_qi";
    //     $ip = $_SERVER['REMOTE_ADDR'];
    //     // post request to server
    //     $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    //     $response = file_get_contents($url);
    //     $responseKeys = json_decode($response,true);
    //     // should return JSON with success as true
    //     if(!$responseKeys["success"]) {
    //         $retorno = array("sucesso" => false, "mensagem" => "Captcha incorreto.");
    //     }else{
            $email = trim($_POST['email']);
            $senha = trim($_POST['password']);

            $retornoLogin = $Usuario->login($email, $senha);
            if ($retornoLogin['sucesso'] == true) {
                $Usuario->Redirecionar('index.php');
            } else {
                $retorno = $retornoLogin;
            }
            
    //     }
    // }
    
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Painel Vá DF">
        <meta name="keyword" content="Vá DF">
        <meta name="author"  content="Vá DF"/>        
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <meta name="grecaptcha-key" content="6LdWo7IZAAAAAMhWx4aAsDFz-ZvhDRd_beNxOarQ">
        <!-- Page Title -->
        <title>Login | Painel Vá DF</title>
        <!-- Main CSS -->			
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/bootstrap/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/font-awesome/css/font-awesome.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/simple-line-icons/css/simple-line-icons.css">
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/plugins/ionicons/css/ionicons.css">
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/css/app.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/metrical-light/css/style.min.css"/>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
            <div class="card shadow-none pd-20 mx-auto wd-350 text-center bd-1 align-self-center">
                <p>                    
                    <img class="desktop-logo" src="assets/metrical-light/images/vadflogo.png" alt="">
                </p>                                
                <form method="POST">                   
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text pd-x-9"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input class="form-control form-control-sm" placeholder="Usuário" type="text" name="email" value="<?=isset($_COOKIE['email']) ? $_COOKIE['email'] : ""?>" required <?=!isset($_COOKIE['email']) ? "autofocus" : ""?>>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control form-control-sm" placeholder="Senha" type="password" name="password" required <?=isset($_COOKIE['login']) ? "autofocus" : ""?>>
                    </div>
                    <div class="form-group input-group">
                        <div class="custom-control custom-checkbox">													
                            <input id="salvarUsuario" name="salvarUsuario" type="checkbox" value="S" class="custom-control-input input-mini" checked/>
                            <label class="custom-control-label" for="salvarUsuario">Lembrar usuário</label>
                        </div>
                    </div>
                    <!-- <div class="g-recaptcha" data-callback="recaptchaCallback"  data-sitekey="6Lcvp7IZAAAAAAIU9Au6knd6IXsmncgaYpFS7uG3"></div> -->
                    <?php if(isset($retorno) && array_key_exists('mensagem', $retorno)){ 
                        echo '<div class="center">
                                <p class="text-danger">'.$retorno['mensagem'].'</p>
                              </div>';
                    }
                    ?>
                    <p></p>
                    <div class="form-group">
                        <button class="btn btn-danger btn-block mg-b-10" name="btnLogin" id="btnLogin" onclick="onClick();" > Entrar </button>
                    </div>                    
                </form> 
            </div>
        </div>
        </body>
        <!--/ User Singin End -->
        <!--================================-->
        <!-- Footer Script -->
        <!--================================-->	
        <script src="assets/metrical-light/plugins/jquery/jquery.min.js"></script>
        <script src="assets/metrical-light/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="assets/metrical-light/plugins/popper/popper.js"></script>
        <script src="assets/metrical-light/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/metrical-light/plugins/pace/pace.min.js"></script>
        <script src="assets/metrical-light/js/jquery.slimscroll.min.js"></script>
        <script src="assets/metrical-light/js/custom.js"></script>        
        <script>
        function recaptchaCallback() {
            $('#btnLogin').removeAttr('disabled');
            document.getElementById('btnLogin').focus();
        };
        </script>     
</html>