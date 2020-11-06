<?php

require_once( "../../header.php");
require_once( "../sidebar.php");   

$listaUsuarios = $ServicosAPI->POST('funcionarios/consultar.php', $dadosRecebidos);  
$listaUsuarios = !empty($listaUsuarios['dados']) ? $listaUsuarios['dados'] : array();

?>

<!-- Page Inner Start -->
<!--================================-->
<div class="page-inner"> 
    <!-- Main Wrapper -->
    <div id="main-wrapper">
        <!--================================-->
        <!-- Breadcrumb Start -->
        <!--================================-->
        <div class="pageheader pd-t-25 pd-b-35">
            <div class="pd-t-5 pd-b-5">
                <h1 class="pd-0 mg-0 tx-20">Funcionarios</h1>
            </div>
            <div class="breadcrumb pd-0 mg-0">
                <a class="breadcrumb-item" href="/"><i class="icon ion-ios-home-outline"></i> Início</a>
                <a class="breadcrumb-item" active>Painel de Controle</a>
                <span class="breadcrumb-item active">Funcionarios</span>
            </div>
        </div>
        
        <?php if (isset($dadosRecebidos["sucesso"]) && $dadosRecebidos["sucesso"] == 1) { ?>                        
            <div class="webnots-success webnots-notification-box">Sucesso - Funcionario: <?=$dadosRecebidos["nome"]?> salvo com sucesso.</div>
        <?php } ?>  
        
        <div class="card mg-b-20">
            
            <div class="card-header">
                <h4 class="card-header-title">
                    Filtros
                </h4>
            </div>
            <div class="card-body collapse show" id="collapse7">
                <form  role="form" method="GET" id="filtros" name="filtros" action="">
                    <div class="form-row">
                        <input type="hidden" class="form-control" id="pesquisa" name="pesquisa" value="">
                        
                        <div class="col-md-1 mb-3">
                            <label>Matricula:</label>
                            <input type="text" class="form-control" id="matricula" name="matricula" value="<?=isset($_GET["matricula"]) ? $_GET["matricula"] : ""?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Nome:</label>
                            <input type="text" class="form-control" id="nome_funcionario" name="nome_funcionario" value="<?=isset($_GET["nome_funcionario"]) ? $_GET["nome_funcionario"] : ""?>">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?=isset($_GET["email"]) ? $_GET["email"] : ""?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Status</label>
                            <div class="input-group">
                                <select class="form-control" name="ativo" id="ativo">
                                    <?php
                                    echo '<option value="1" '; 
                                    if ( isset($_GET["ativo"]) && $_GET["ativo"] == "1" ) { echo ' selected=""'; } 
                                    echo '>Ativos</option>';
                                    
                                    echo '<option value="0" '; 
                                    if ( isset($_GET["ativo"]) && $_GET["ativo"] == "0" ) { echo ' selected=""'; }
                                    echo '>Inativos</option>';
                                    
                                    echo '<option value="" '; 
                                    if ( isset($_GET["ativo"]) && $_GET["ativo"] == "" ) { echo ' selected=""'; }
                                    echo '>Todos</option>';                                
                                    ?>
                                </select>
                                <div class="input-group-append">
                                   &nbsp;<button type="submit" name="btnPesquisar" class="btn btn-blue"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</button>
                                </div>
                             </div>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
        <div class="row row-xs clearfix">         
            <div class="col-md-12 col-lg-12">
            
                <div class="form-row">
                    <div class="col-sm-3 col-md-3">
                        <form  role="form" method="GET" id="filtros" name="filtros" action="editar.php">
                            <button type="sumbit" class="btn btn-primary btn-block mg-b-10"><i class="fa fa-plus mg-r-10"></i>Cadastrar Funcionario</button>
                        </form>
                    </div>
                    
                </div>
            
            </div>
        </div>
        
        <div class="row row-xs clearfix">         
                <div class="col-md-12 col-lg-12">           
                        <div class="card mg-b-20">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Funcionarios
                            </h4>
                        </div>
                        <div class="card-body collapse show" id="collapse5">
                        
                            <table id="orderActiveTable" class="table hover responsive display nowrap">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>                                     
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ativo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            if ( isset($listaUsuarios) && count($listaUsuarios) > 0 ){
                                foreach($listaUsuarios as &$usuario){ ?>                                                
                                    <tr>
                                        <td><?=$usuario["matricula"]?></td>
                                        <td><?=$usuario["nome_funcionario"]?></td>
                                        <td><?=$usuario["email"]?></td>
                                        <td>
                                            <?php
                                            if($usuario['ativo'] == '1'){
                                                    echo '<span class="badge bg-soft-success"><a>Ativo</a></span>';
                                                } else {
                                                    echo '<span class="badge bg-soft-danger"><a>Inativo</a></span>';
                                                }
                                                
                                            ?>  
                                        </td> 
                                        <td class="text-left table-actions">
                                            <a class="table-action  mg-r-10" title="Editar cadastro" href="editar.php?matricula=<?=$usuario["matricula"]?>"><i class="fa fa-pencil"></i></a>                                          
                                            <a class="table-action  mg-r-10" title="Alterar senha" href="senha.php?matricula=<?=$usuario["matricula"]?>"><i class="fa fa-lock"></i></a>                                          
                                        </td>
                                        
                                    </tr>
                          <?php }
                            }
                        ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Matricula</th>                                     
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ativo</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                            </table>                            
                        </div>
                    </div>               
            </div>
        </div>
    </div>
</div>

<?php
require_once("../../footer.php");
?>