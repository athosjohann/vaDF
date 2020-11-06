
<?php
require_once( "../../header.php");
require_once( "../sidebar.php");

if ( isset($_POST["btnSubmit"]) ){
   if(!empty($dadosRecebidos['matricula'])){
        $retorno = $ServicosAPI->POST('funcionarios/alterarsenha.php', $dadosRecebidos);
        if (isset($retorno["sucesso"]) && ( $retorno["sucesso"] == true) ){
            $Usuario->Redirecionar('index.php?sucesso=1&nome=' . $dadosRecebidos['matricula']);
        }
    } 
}

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
                <span class="breadcrumb-item active">Senha</span>
            </div>
        </div>
        
        <?php if (isset($retorno) && array_key_exists('sucesso', $retorno) && $retorno['sucesso'] == false) { ?>                        
            <div class="webnots-failure webnots-notification-box"><?=$retorno["mensagem"]?></div>               
        <?php } ?> 
        
        <?php if (isset($retorno) && array_key_exists('sucesso', $retorno) && $retorno['sucesso'] == true) { ?>                        
            <div class="webnots-success webnots-notification-box"><?=$retorno["mensagem"]?></div>               
        <?php } ?> 
              
            <div class="card-body collapse show">
                <div class="col-md-5 col-lg-5">
                    <div class="card mg-b-5">
                        <div class="card-header">
                           <h4 class="card-header-title">
                              Dados do Funcionario
                           </h4>                  
                        </div>

                        <form role="form" method="POST" action="" id="formsenhas">

                            <div class="card-body collapse show" id="collapse1">
                               <div class="form-layout form-layout-1">
                                  <div class=" mg-b-5">

                                    <input type="text" id="matricula" name="matricula" hidden value="<?=!empty($dadosRecebidos['matricula']) ? $dadosRecebidos['matricula'] : ''?>">                                                                        
                                    <div class="col-lg-12">
                                       <div class="form-group mg-b-10-force">
                                          <label class="form-control-label active">Senha: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="password" id="senha" name="senha" value="<?=!empty($dadosRecebidos['senha']) ? $dadosRecebidos['senha'] : ''?>"  autocomplete="off" required>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label class="form-control-label active">Nova Senha: <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="password" onkeyup="verificaSenhas()" id="novasenha" name="novasenha" value="<?=!empty($dadosRecebidos['novasenha']) ? $dadosRecebidos['novasenha'] : ''?>" autocomplete="off" required>
                                       </div>
                                    </div>
                                     <!-- col-4 -->
                                     <div class="col-lg-12">
                                        <div class="form-group">
                                           <label class="form-control-label active">Confirmação senha: <span class="tx-danger">*</span></label>
                                           <input class="form-control" type="password" onkeyup="verificaSenhas()" value="<?=!empty($dadosRecebidos['confirmacao']) ? $dadosRecebidos['confirmacao'] : ''?>" id="confirmacao" name="confirmacao" autocomplete="off" required>
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
                                <button type="button" onClick="enviarSenhas()" class="btn btn-custom-primary">Salvar</button>
                                <button type="button" onClick="history.go(-1)" class="btn btn-secondary" id="btnCancelar" name="btnCancelar">Cancelar</button>
                                <button type="submit" id="btnSubmit" name="btnSubmit" hidden>Salvar</button>
                            </div>              
                        </div>
                    </div>

                </form>                                

            </div>
    </div>            

    
<?php
    require_once("../../footer.php")
?>    
    
<script type="text/javascript" language="javascript"> 

    function enviarSenhas(){
        if(verificaSenhas()){
            document.getElementById('btnSubmit').click();
        } else {
            document.getElementById('confirmacao').setCustomValidity("Confirmação de senha incorreta");
            document.getElementById('formsenhas').reportValidity();
        }
    }

    function verificaSenhas() {
        let senha = document.getElementById('novasenha').value;
        let confimacao = document.getElementById('confirmacao').value;
        if(senha != '' && confimacao != ''){
            if(senha == confimacao){
                document.getElementById('novasenha').style.borderColor = 'green';
                document.getElementById('confirmacao').style.borderColor = 'green';
                return true;
            } 
        }
        document.getElementById('novasenha').style.borderColor = 'red';
        document.getElementById('confirmacao').style.borderColor = 'red';
        return false;
        
    }
    
</script>
