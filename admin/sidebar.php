      <!--================================-->
      <!-- Page Container Start -->
      <!--================================-->
      <div id="loading" style=" position: fixed; width: 100%; height: 100%; left: 0; top: 0; display:none; background: rgba(51,51,51,0.7); z-index: 512319999;"></div>
      <div class="page-container">
         <!--================================-->
         <!-- Page Sidebar Start -->
         <!--================================-->
         <div class="page-sidebar">
            <div class="logo">
               <a class="logo-img" href="<?=$siteURL?>">		
                <img class="desktop-logo" src="<?=$siteURL?>assets/metrical-light/images/vadflogo.png" alt="">
                <img class="small-logo" src="<?=$siteURL?>assets/metrical-light/images/vadflogo.png" alt="">
               </a>			
               <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
            </div>
            <!--================================-->
            <!-- Sidebar Menu Start -->
            <!--================================-->
            <div class="page-sidebar-inner">
               <div class="page-sidebar-menu">
                    <ul class="accordion-menu">

                        <li class="<?php if ( ($diretorioAtual == "admin") ) { echo "active"; }  ?>">
                            <a href="<?=$siteURL?>admin"><i data-feather="home"></i>
                            <span>Início</span></a>
                        </li>
                        <li class="<?php if ( ($diretorioAtual == "funcionarios") || ($diretorioAnterior == "funcionarios") ) { echo "active open"; }  ?>">
                           <a href="<?=$siteURL?>admin/funcionarios"><i data-feather="users"></i>
                           <span>Funcionarios</span></a>
                        </li>
                    </ul>
               </div>
            </div>
            <!--/ Sidebar Menu End -->
            <!--================================-->
            <!-- Sidebar Footer Start -->
            <!--================================-->
            <div class="sidebar-footer">									
               <a class="pull-left" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Meu Perfil">
               <i data-feather="user" class="ht-15"></i></a>									
               <a class="pull-left " href="#" data-toggle="tooltip" data-placement="top" data-original-title="Mensagens">
               <i data-feather="mail" class="ht-15"></i></a>
               <a class="pull-left" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Bloquear">
               <i data-feather="lock" class="ht-15"></i></a>
               <a class="pull-left" href="<?=$siteURL?>logout.php" data-toggle="tooltip" data-placement="top" data-original-title="Sair">
               <i data-feather="log-out" class="ht-15"></i></a>
            </div>
            <!--/ Sidebar Footer End -->
         </div>
         <!--/ Page Sidebar End -->
         <!--================================-->
         <!-- Page Content Start -->
         <!--================================-->
         <div class="page-content">
            <!--================================-->
            <!-- Page Header Start -->
            <!--================================-->
            <div class="page-header">
               <div class="search-form">
                  <form action="#" method="GET">
                     <div class="input-group">
                        <input class="form-control search-input" name="search" placeholder="Pesquisar..." type="text"/>
                        <span class="input-group-btn">
                        <span id="close-search"><i class="ion-ios-close-empty"></i></span>
                        </span>
                     </div>
                  </form>
               </div>
               <!--================================-->
               <!-- Page Header  Start -->
               <!--================================-->

               <nav class="navbar navbar-expand-lg">
                  <ul class="list-inline list-unstyled mg-r-20">
                     <!-- Mobile Toggle and Logo -->
                     <li class="list-inline-item align-text-top"><a class="hidden-md hidden-lg" href="#" id="sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                     <!-- PC Toggle and Logo -->
                     <li class="list-inline-item align-text-top"><a class="hidden-xs hidden-sm" href="#" id="collapsed-sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                  </ul>
                  <!--================================-->
                  <!-- Mega Menu Start -->
                  <!--================================-->
                  <div class="collapse navbar-collapse">
                     
                  </div>
                  <!--/ Mega Menu End-->
                  <!--/ Brand and Logo End -->
                  <!--================================-->
                  <!-- Header Right Start -->
                  <!--================================-->
                  <div class="header-right pull-right">
                     <ul class="list-inline justify-content-end">
                         
                        <li class="list-inline-item align-middle dropdown hidden-xs">
                           <a  href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="flag-icon flag-icon-br"></i>
                           </a>
                           <ul class="dropdown-menu languages-dropdown shadow-2">
                              <li>
                                 <a href="" data-lang="en"><i class="flag-icon flag-icon-br mr-2"></i><span>Português</span></a>
                              </li>                              
                           </ul>
                        </li>
                        <!--/ Languages Dropdown End -->
                        <!--================================-->                                             
                        <!-- Profile Dropdown Start -->
                        <!--================================-->
                        <li class="list-inline-item dropdown">
                           <a  href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="select-profile">Olá, <?php echo $_SESSION['nome_funcionario']; ?>!</span><img src="<?=$siteURL?>assets/metrical-light/images/avatar-placeholder.png" class="img-fluid wd-35 ht-35 rounded-circle" alt=""></a>
                           <div class="dropdown-menu dropdown-menu-right dropdown-profile shadow-2">
                              <div class="user-profile-area">
                                 <div class="user-profile-heading">
                                    <div class="profile-thumbnail">
                                       <img src="<?=$siteURL?>assets/metrical-light/images/avatar-placeholder.png" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                                    </div>
                                    <div class="profile-text">
                                       <h6><?php echo $_SESSION['nome']; ?></h6>
                                       <span><?php echo $_SESSION['matricula']; ?> - <?php echo $_SESSION['nome']; ?></span>
                                    </div>
                                 </div>                                 
                                 <a href="" class="dropdown-item"><i class="icon-envelope" aria-hidden="true"></i> Mensagens <span class="badge badge-success ft-right mg-t-3">0</span></a>                                                                                                   
                                 <a href="" class="dropdown-item"><i class="icon-heart" aria-hidden="true"></i> Suporte</a>
                                 <a href="<?=$siteURL?>logout.php" class="dropdown-item"><i class="icon-power" aria-hidden="true"></i> Sair</a>
                              </div>
                           </div>
                        </li>
                        <!-- Profile Dropdown End -->
                        <!--================================-->                       
                     </ul>
                  </div>
                  <!--/ Header Right End -->
               </nav>
            </div>
            <!--/ Page Header End -->
            <!--================================-->
            