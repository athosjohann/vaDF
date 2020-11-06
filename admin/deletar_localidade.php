<?php
    include '../header.php';    
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
		<base href="https://localhost/es/" target="_blank">
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
        <title>Deletar Localidade | Painel Vá DF</title>
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
        <h1> Deletar Localidade</h1>
        <div class="ht-100v d-flex">
            <div class="card shadow-none pd-100 mx-auto wd-1000 bd-1">
                <form method="POST">                   
                    <div class="form-group input-group">
                        <label for="nome"> Nome </label>
                        <select class="form-control" id="localidade_nome" name="nome" onchange="select_name()">
                            <option selected value=''></option>
                            <option value="Praça dos três poderes">Praça dos três poderes</option>
                          </select>
                    </div>
                    <div id="localidade_info">
                        <div class="form-group input-group">
                            <label for="experiencia"> Experiência </label>
                            <input class="form-control form-control-sm" type="text" name="experiencia" />
                        </div>
                        <div class="form-group input-group">
                            <label for="imagem"> Imagem </label>
                            <input class="form-control form-control-sm" type="text" name="imagem" />
                        </div>
                        <div class="form-group input-group">
                            <label for="descricao"> Descrição </label>
                            <input class="form-control form-control-sm" type="text" name="descricao" />
                        </div>
                        <div class="form-group input-group">
                            <label for="circuitos"> Circuitos </label>
                            <input class="form-control form-control-sm" type="text" name="circuitos" />
                        </div>
                        <div class="form-group input-group">
                            <label for="coodernadas"> Coodernadas </label>
                            <input class="form-control form-control-sm" type="text" name="coodernadas" />
                        </div>
                        <div class="row">
                            <div class="p-2 float-right">
                                <p style="color: red;"> Tem certeza que deseja deletar esta localidade?</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-inline-flex p-2 bd-highlight float-right">
                        <button type="button" class="btn btn-danger">
						<a href="admin" >Cancelar</a>
						</button>
                        <button type="button" class="btn btn-success">
						<a href="admin">Deletar</a>
						</button>
                    </div>
                </form>
                <label for="historico_alteracoes"> Histórico de Alterações </label>
                <textarea id="historico_alteracoes" class="swal2-input" rows="100" disabled></textarea> 
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

<script>
    $('#localidade_info').hide();

    function select_name(){
        if(document.getElementById('localidade_nome').value){
            $('#localidade_info').show();
        }else{
            $('#localidade_info').hide();
        };
    };
</script> 


<?php include '../footer.php'; ?>