<?php

Class PontosTuristicosJogadorDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                tbl_jogador_pontos_turisticos.id_jogador,
                tbl_jogador.nome_circuito,
                tbl_jogador_pontos_turisticos.id_ponto_turistico,
                tbl_pontos_turisticos.nome as ponto_turistico
            FROM tbl_jogador_pontos_turisticos, tbl_jogador, tbl_pontos_turisticos 
            WHERE tbl_jogador_pontos_turisticos.id_jogador = tbl_jogador.id_jogador 
            AND   tbl_pontos_turisticos.id_ponto_turistico = tbl_jogador_pontos_turisticos.id_ponto_turistico";
        if(!empty($parametros['id_ponto_turistico'])){
            $sql .= " and tbl_jogador_pontos_turisticos.id_ponto_turistico = :id_ponto_turistico ";
        }
        if(!empty($parametros['id_jogador'])){
            $sql .= " and tbl_jogador_pontos_turisticos.id_jogador = :id_jogador ";
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
            return array("sucesso" => false, "mensagem" => "Ponto turistico já vinculado a esse jogador");
        }
        $sql = "INSERT INTO tbl_jogador_pontos_turisticos (
                            id_jogador,
                            id_ponto_turistico
                        ) VALUES ( 
                            :id_jogador,
                            :id_ponto_turistico
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Ponto turistico vinculado ao jogador com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao vincular ponto turistico ao jogador.", "dados" => $retorno);
        }    

    }

    public function deletar($parametros){
        $arrayErros = $this->validaDados($parametros);
        if(!empty($arrayErros)){
            return $arrayErros;
        }
        $sql = "DELETE FROM tbl_jogador_pontos_turisticos 
                where id_jogador = :id_jogador
                AND id_ponto_turistico = :id_ponto_turistico ";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Ponto turistico desvinculado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao desvincular ponto turistico.", "dados" => $retorno);
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
        if(empty($parametros['id_ponto_turistico'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Ponto turistico invalido"));
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