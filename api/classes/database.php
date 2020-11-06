<?php

class Database {
    
    private $servername = "191.252.130.80";
    private $username = "luanroxc_facul";
    private $password = "?n@)3}hwDLD$";
    private $dbname = "luanroxc_facul";    
    
    private $conexao;  
      
    function __construct() {
        $this->conexao = $this->getConnectionMysql();
    }

    private function getConnectionMysql(){
        
        try{
            $conn_mysql = new PDO("mysql:host=" . $this->servername .";dbname=" . $this->dbname, 
                                                  $this->username, 
                                                  $this->password, 
                                                  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conn_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
            
            return $conn_mysql;
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

    }

    public function ExecutarSQL($comandoSQL, $parametros = array()) {                        
                
        if ( !empty($parametros) ){
            $parametros = array_change_key_case($parametros, CASE_LOWER);  
            $parametros = $this->TrataParametrosSQL($comandoSQL, $parametros);
        }

        try {
            $query = $this->conexao->prepare($comandoSQL);
            $query->execute($parametros);
            
            if (( strpos( trim(strtolower($comandoSQL)), "select" ) === 0) || ( strpos( trim(strtolower($comandoSQL)), "with" ) === 0)) {    
                return  array("sucesso" => true, "mensagem" => "Realizado com sucesso", "dados" => $query->fetchAll(PDO::FETCH_ASSOC));
            } else {

                if ( ( strpos( trim(strtolower($comandoSQL)), "insert") === 0) || ( strpos( trim(strtolower($comandoSQL)), "replace" ) === 0) ) {
                    return array("sucesso" => true, "mensagem" => "Realizado com sucesso", "dados" => array("ultimoid" => $this->conexao->lastInsertId()));
                } else {

                    if ( ((strpos( trim(strtolower($comandoSQL)), "update") === 0) || ( strpos( trim(strtolower($comandoSQL)), "delete") === 0)) && ( $query->rowCount() > 0 ) ){
                        return array( "sucesso" => true, "mensagem" => "Realizado com sucesso", "dados" => array("linhasafetadas" => $query->rowCount()) );
                    } else {
                        return array( "sucesso" => false, "mensagem" => "Nenhuma linha afetada", "dados" => array("linhasafetadas" => $query->rowCount()) );
                    } 
                }    
            }                                                                 
        } catch (PDOException $e) {
            return array("sucesso" => false, "mensagem" => $e->getMessage());
        }           
    }

    private function TrataParametrosSQL($stringSQL, $arrayParametros) {        
        $parametrosRetorno = array();
        $listaParametros = [];         
        preg_match_all("/\:([a-zA-Z0-9_]+)/", $stringSQL, $listaParametros);
        
        for ($i = 0; $i < count($listaParametros[0]); $i++) {   

            $parametro =  str_replace(')', '', str_replace(')', '', str_replace(',', '', $listaParametros[0][$i])));
            $chave =  str_replace('(', '', str_replace(')', '', str_replace(',', '', $listaParametros[1][$i])));
            
            if(array_key_exists($chave, $arrayParametros)){   
                $parametrosRetorno[$parametro] = $arrayParametros[$chave];              
            } else{
                $parametrosRetorno[$parametro] = null;
            }
        }
        
        return $parametrosRetorno;
    }
    
}


?>