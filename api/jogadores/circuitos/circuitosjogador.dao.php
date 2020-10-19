<?php

Class CircuitoJogadorDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                tbl_jogador_circuito.id_jogador,
                tbl_jogador.nome_jogador,
                tbl_jogador_circuito.id_circuito,
                tbl_circuitos.nome_circuito
            FROM tbl_jogador_circuito, tbl_jogador, tbl_circuitos 
            WHERE tbl_jogador_circuito.id_jogador = tbl_jogador.id_jogador 
            AND   tbl_circuitos.id_circuito = tbl_jogador_circuito.id_circuito";
        if(!empty($parametros['id_circuito'])){
            $sql .= " and tbl_jogador_circuito.id_circuito = :id_circuito ";
        }
        if(!empty($parametros['id_jogador'])){
            $sql .= " and tbl_jogador_circuito.id_jogador = :id_jogador ";
        }        
        
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        }    
    }

    public function cadastrar($parametros){
        $erros = $this->validaDados($parametros);
        if(!empty($erros)){
            return $erros;
        }
        if($this->VerificaSeExiste($parametros)){
            return array("sucesso" => false, "mensagem" => "Circuito já vinculado a esse jogador");
        }
        $sql = "INSERT INTO tbl_jogador_circuito (
                            id_jogador,
                            id_circuito
                        ) VALUES ( 
                            :id_jogador,
                            :id_circuito
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Circuito vinculado ao jogador com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao vincular circuito ao jogador.", "dados" => $retorno);
        }    

    }

    public function deletar($parametros){
        $arrayErros = $this->validaDados($parametros);
        if(!empty($arrayErros)){
            return $arrayErros;
        }
        $sql = "DELETE FROM tbl_jogador_circuito 
                where id_jogador = :id_jogador
                AND id_circuito = :id_circuito ";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Circuito desvinculado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao desvincular circuito.", "dados" => $retorno);
        }    
    }

    private function VerificaSeExiste($parametros){
        $retorno = $this->consultar($parametros);
        if(!empty($retorno['dados'])){
            return true;
        }
        return false;
    }

    public function validaDados($parametros){
        $arrayErros = array();
        if(empty($parametros['id_jogador'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Jogador invalido"));
        }
        if(empty($parametros['id_circuito'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Circuito invalido"));
        }
        
        if(!empty($arrayErros)){
            return array(
                "sucesso"   => false,
                "mensagem"  => "Parametros invalidos",
                "dados"     => $arrayErros
            );
        }
    }

}