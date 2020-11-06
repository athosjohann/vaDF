<?php
require_once dirname(__FILE__)."/includes.php";    

if(!$Usuario->EstaLogado() && !(isset($_ACESSOTV) && $_ACESSOTV)){ 
   $Usuario->Redirecionar($siteURL . '/login.php');    
   exit;
}

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
      <title>VáDF | Administrativo</title>
      <!-- Main CSS -->
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/bootstrap/css/bootstrap.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/font-awesome/css/font-awesome.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/flag-icon/flag-icon.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/simple-line-icons/css/simple-line-icons.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/ionicons/css/ionicons.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/toastr/toastr.min.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/chartist/chartist.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/apex-chart/apexcharts.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/css/app.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/css/style.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/sweetalert/bootstrap-sweetalert.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/jquery-ui/jquery-ui.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/spinkit/spinkit.min.css"> 
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/bootstrap-select/css/bootstrap-select.min.css">     
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/datatables/jquery.dataTables.min.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/datatables/extensions/dataTables.jqueryui.min.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css">
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/plugins/datepicker/css/datepicker.min.css">      
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/css/app.min.css"/>
      <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/css/style.min.css"/>
	  <link type="text/css" rel="stylesheet" href="<?=$siteURL?>assets/metrical-light/css/style.our.css"/>       
      <link rel="icon" href="<?=$siteURL?>favicon.ico" type="image/x-icon" />
      <script src='https://www.google.com/recaptcha/api.js'></script>
      
   </head>
   <body>