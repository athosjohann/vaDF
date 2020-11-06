
<?php
require_once( "../../header.php");
require_once( "../sidebar.php");

if ( isset($_POST["btnSalvar"]) ){
    if(empty($dadosRecebidos['matricula'])){
        $retorno = $ServicosAPI->POST('funcionarios/cadastrar.php', $dadosRecebidos);
    } else {
        $retorno = $ServicosAPI->POST('funcionarios/atualizar.php', $dadosRecebidos);
    }
    if (isset($retorno["sucesso"]) && ( $retorno["sucesso"] == true) ){
        $Usuario->Redirecionar('index.php?sucesso=1&nome=' . $dadosRecebidos['nome']);
    }
}

if(!empty($dadosRecebidos['matricula'])){
    $dadosRecebidos = $ServicosAPI->POST('funcionarios/consultar.php', array("matricula" => !empty($dadosRecebidos['matricula']) ? $dadosRecebidos['matricula'] : ''));
}
$dadosRecebidos = !empty($dadosRecebidos['dados']) ? $dadosRecebidos['dados'][0] : array();


?>
<!-- Page Inner Start -->
<!--================================-->
<div class="page-inner"> 
    <!-- Main Wrapper -->
    <div id="main-wrapper">
        <div class="pageheader pd-t-25 pd-b-35">
            <div class="pd-t-5 pd-b-5">
                <h1 class="pd-0 mg-0 tx-20">Funcionarios</h1>
            </div>
            <div class="breadcrumb pd-0 mg-0">
                <a class="breadcrumb-item" href="/"><i class="icon ion-ios-home-outline"></i> Início</a>
                <a class="breadcrumb-item" href="#">Funcionarios</a>
                <span class="breadcrumb-item active">Cadastro</span>
            </div>
        </div>
        
        <?php if (isset($retorno) && array_key_exists('sucesso', $retorno) && $retorno['sucesso'] == false) { ?>                        
            <div class="webnots-failure webnots-notification-box"><?=$retorno["mensagem"]?></div>               
        <?php } ?> 
        
        <?php if (isset($retorno) && array_key_exists('sucesso', $retorno) && $retorno['sucesso'] == true) { ?>                        
            <div class="webnots-success webnots-notification-box"><?=$retorno["mensagem"]?></div>               
        <?php } ?> 
              
            <div class="card-body collapse show">
                <div class="col-md-12 col-lg-12">
                    <div class="card mg-b-20">
                        <div class="card-header">
                           <h4 class="card-header-title">
                              Dados do Funcionario
                           </h4>                  
                        </div>

                        <form role="form" method="POST" action="" id="">

                            <div class="card-body collapse show" id="collapse1">
                               <div class="form-layout form-layout-1">
                                  <div class="row mg-b-25">

                                    <input type="text" id="matricula" name="matricula" hidden value="<?=!empty($dadosRecebidos['matricula']) ? $dadosRecebidos['matricula'] : ''?>">                                                                        
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label class="form-control-label active">Nome: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" id="nome_funcionario" name="nome_funcionario"  style="text-transform:uppercase" value="<?=!empty($dadosRecebidos['nome_funcionario']) ? $dadosRecebidos['nome_funcionario'] : ''?>" autocomplete="off" required>
                                       </div>
                                    </div>
                                    <!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label active">Email: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" id="email" name="email" value="<?=!empty($dadosRecebidos['email']) ? $dadosRecebidos['email'] : ''?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- col-4 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label active">Senha: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="password" <?=!empty($dadosRecebidos['matricula']) ? 'readonly' : ''?> id="senha" name="senha" value="<?=!empty($dadosRecebidos['senha']) ? 'aquiésegurobb' : ''?>" autocomplete="off" required>
                                        </div>
                                    </div>     
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label active">Status do Funcionario: <span class="tx-danger">*</span></label>
                                            <select class="form-control " data-provide="selectpicker" id="ativo" name="ativo">
                                                <option value="1" <?=(!empty($dadosRecebidos['ativo']) && $dadosRecebidos['ativo'] == '1') ? " selected " : ""?>>Ativo</option>
                                                <option value="0" <?=(!empty($dadosRecebidos['ativo']) && $dadosRecebidos['ativo'] == '0') ? " selected " : ""?>>Inativo</option>
                                            </select>                                                               
                                        </div>
                                    </div> 
                                  </div>

                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="collapse1">
                        <div class="form-layout form-layout-1">                                   
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-custom-primary" id="btnSalvar" name="btnSalvar">Salvar</button>
                                <button type="button" onClick="history.go(-1)" class="btn btn-secondary" id="btnCancelar" name="btnCancelar">Cancelar</button>
                            </div>              
                        </div>
                    </div>

                </form>                                

            </div>
    </div>            

    
<?php
    require_once("../../footer.php")
?>    

