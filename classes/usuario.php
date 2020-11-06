<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();

class Usuario {

    private $ServicosAPI;

    public function __construct($ServicosAPI = null) {
        $this->ServicosAPI = $ServicosAPI;
    }

    public function EstaLogado() {     
        if (isset($_SESSION['matricula']) && $_SESSION['matricula'] <> '' && (isset($_SESSION['tokenusuario']) && $_SESSION['tokenusuario'] <> '')) {
            return true;           
        }
        else{
            return false;        
        }        
    }

    public function sessaoAtiva(){
        if (isset($_SESSION['dtsessaoativa']) && (time() - $_SESSION['dtsessaoativa'] > 600)) {
            
            $dadosUsuario = array("tokenusuario" => $_SESSION['tokenusuario']);
            $retornoUsuario = $this->ServicosAPI->POST("funcionarios/sessaoativa.php", $dadosUsuario);

            if(array_key_exists('sucesso', $retornoUsuario) && $retornoUsuario['sucesso'] == true){
                return true;
            }else{
                return false;
            }
        }else{
            if(!isset($_SESSION['dtsessaoativa'])){
                return false;
            }else{
                return true;         
            }            
        }     
    }

    public function Redirecionar($url) {
        header("Location: $url");
        exit;
    }

    public function Logout() {
        session_destroy();
        $_SESSION['matricula'] = false;
        $_SESSION['nome_funcionario'] = false;
        $_SESSION['tokenusuario'] = false;
    }

    public function getMatricula() {
        return $_SESSION['matricula'];
    }

    public function getNome() {
        return $_SESSION['nome'];
    }

    public function getTokenUsuario() {
        return $_SESSION['tokenusuario'];
    }

    public function usuarioAdmin(){
        return $_SESSION['admin'];
    }

    public function login($email, $senha) {
        
        $retorno = $this->ServicosAPI->POST("funcionarios/login.php", array("email" => $email, "senha" => $senha));
        if ($retorno['sucesso'] == true) {
            
            $_SESSION['matricula'] = $retorno['dados'][0]['matricula'];
            $_SESSION['nome_funcionario'] = $retorno['dados'][0]['nome_funcionario'];
            $_SESSION['email'] = $retorno['dados'][0]['email'];
            $_SESSION['ativo'] = $retorno['dados'][0]['ativo'];
            $_SESSION['tokenusuario'] = $retorno['dados'][0]['token'];
        }

        return $retorno;
    }

}
