
<!--Page Footer Start-->	
<!--================================-->
<footer class="page-footer">
    <div class="pd-t-4 pd-b-0 pd-x-20">
        <div class="tx-10 tx-uppercase">
            <p class="pd-y-10 mb-0">Copyright&copy; <?php echo date("Y"); ?> | Todos os direitos reservados. | <a href="#">VáDF</a></p>
        </div>           
    </div>
</footer>
<!--/ Page Footer End -->		
</div>
<!--/ Page Content End -->
</div>
<!--/ Page Container End -->
<!--================================-->
<!-- Scroll To Top Start-->
<!--================================-->	
<a href="" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<!--/ Scroll To Top End -->
<!--================================-->     
<!-- Footer Script -->
<!--================================-->
<script src="<?=$siteURL?>assets/metrical-light/plugins/jquery/jquery.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/jquery-ui/jquery-ui.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/js/jquery.slimscroll.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/popper/popper.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/feather-icon/feather.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/pace/pace.min.js"></script>


<script src="<?=$siteURL?>assets/metrical-light/plugins/toastr/toastr.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/countup/counterup.min.js"></script>		
<script src="<?=$siteURL?>assets/metrical-light/plugins/waypoints/waypoints.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/apex-chart/apexcharts.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/apex-chart/irregular-data-series.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/google-chart/google-chart.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/flot/jquery.flot.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/simpler-sidebar/jquery.simpler-sidebar.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/js/dashboard/analytics-dashboard-init.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/js/jquery.slimscroll.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/js/highlight.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/steps/jquery.steps.js" type="0943b3fd05f8be162f2f73f4-text/javascript"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/parsleyjs/parsley.js"></script>

<script src="<?=$siteURL?>assets/metrical-light/js/utils.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/modal/ui-modals.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/sweetalert/bootstrap-sweetalert.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/datatables/responsive/dataTables.responsive.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/datatables/extensions/dataTables.jqueryui.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/datepicker/js/datepicker.min.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/plugins/datepicker/js/datepicker.es.js"></script>

<script src="<?=$siteURL?>assets/metrical-light/plugins/formatter/jquery.formatter.min.js"></script>

<script src="<?=$siteURL?>assets/metrical-light/plugins/steps/rocket-loader.min.js" data-cf-settings="0943b3fd05f8be162f2f73f4-|49" defer=""></script>
<script src="<?=$siteURL?>assets/metrical-light/js/app.js"></script>
<script src="<?=$siteURL?>assets/metrical-light/js/custom.js"></script>


<?php require_once dirname(__FILE__)."/footer-autocomplete.php"; ?>
<script> 
  var vResponsive = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
  vResponsive = screen.width <= 1366 || vResponsive ? true : 	false
  $('#orderActiveTable').DataTable({
      
        responsive: vResponsive,
        language: {
          searchPlaceholder: 'Pesquisar...',
          sSearch: ''
        },
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 50,
        
  }); 

    $('#orderActiveTable2').DataTable({
      
        responsive: vResponsive,
        language: {
          searchPlaceholder: 'Pesquisar...',
          sSearch: ''
        },
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 50,
        
  }); 
  $('#ordemascendente').DataTable({
      
        responsive: vResponsive,
        language: {
          searchPlaceholder: 'Pesquisar...',
          sSearch: ''
        },
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 50,
        
  });
  $('#naoresponsiva').DataTable({
      
        responsive: vResponsive,
        language: {
          searchPlaceholder: 'Pesquisar...',
          sSearch: ''
        },
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 50,
        
  });

  $(document.getElementsByClassName("formatar-cnpj")).formatter({
    'pattern': '{{99}}.{{999}}.{{999}}/{{9999}}-{{99}}',
    'persistent': true
  });

  //Formatar cpf
  $(document.getElementsByClassName("formatar-cpf")).formatter({
    'pattern': '{{999}}.{{999}}.{{999}}-{{99}}',
    'persistent': true
  });

  $(document.getElementsByClassName("formatar-telefone")).formatter({
    'pattern': '({{99}}) {{9999}}-{{9999}}',
    'persistent': true
  });

  $(document.getElementsByClassName("formatar-celular")).formatter({
    'pattern': '({{99}}) {{99999}}-{{9999}}',
    'persistent': true
  });

  $(document.getElementsByClassName("formatar-cep")).formatter({
    'pattern': '{{99999}}-{{999}}',
    'persistent': true
  });
</script>

</body>
</html>
