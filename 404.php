<?php
header("HTTP/1.0 404 Not Found");
$siteURL = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keyword" content="">
      <meta name="author"  content=""/>
      <!-- Page Title -->
      <title>404 - Não encontrado</title>
      <!-- Main CSS -->			
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/plugins/bootstrap/css/bootstrap.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/plugins/font-awesome/css/font-awesome.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/plugins/simple-line-icons/css/simple-line-icons.css">
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/plugins/ionicons/css/ionicons.css">
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/css/app.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $siteURL; ?>assets/metrical-light/css/style.min.css"/>
      <!-- Favicon -->	
      <link rel="icon" href="<?php echo $siteURL; ?>assets/metrical-light/images/favicon.ico" type="image/x-icon">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!--================================-->
      <!-- 404 Start -->
      <!--================================-->	
      <div class="ht-100v d-flex">
         <div class="card shadow-none mx-auto text-center bd-transparent bg-transparent align-self-center">
            <h1 class="tx-bold tx-140 tx-gray-500">4<span class="text-danger">0</span>4</h1>
            <h3 class="text-uppercase">Página não encontrada!</h3>
            <p class="tx-gray-500">Parece que o que você está procurando não existe.</p>            
           <div class="text-center">
               <p>VáDF - &copy; <?php echo date("Y"); ?>.</p>
            </div>
         </div>
      </div>
      <!--/  404 End -->
      <!--================================-->
      <!-- Footer Script -->
      <!--================================-->	
      <script src="<?php echo $siteURL; ?>assets/metrical-light/plugins/jquery/jquery.min.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/plugins/jquery-ui/jquery-ui.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/plugins/popper/popper.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/plugins/pace/pace.min.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/js/jquery.slimscroll.min.js"></script>
      <script src="<?php echo $siteURL; ?>assets/metrical-light/js/custom.js"></script>
   </body>
</html>