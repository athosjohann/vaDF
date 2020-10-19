<?php

Class BadgesJogadorDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                tbl_jogador_badge.id_jogador,
                tbl_jogadores.nome_jogador,
                tbl_jogador_badge.id_badge,
                tbl_badges.nome_badge
            FROM tbl_jogador_badge, tbl_jogadores, tbl_badges 
            WHERE tbl_jogador_badge.id_jogador = tbl_jogadores.id_jogador 
            AND   tbl_badges.id_badge = tbl_jogador_badge.id_badge";
        if(!empty($parametros['id_badge'])){
            $sql .= " and tbl_jogador_badge.id_badge = :id_badge ";
        }
        if(!empty($parametros['id_jogador'])){
            $sql .= " and tbl_jogador_badge.id_jogador = :id_jogador ";
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
            return array("sucesso" => false, "mensagem" => "Badge já vinculada a esse jogador");
        }
        $sql = "INSERT INTO tbl_jogador_badge (
                            id_jogador,
                            id_badge
                        ) VALUES ( 
                            :id_jogador,
                            :id_badge
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Badge vinculada ao jogador com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao vincular badge ao jogador.", "dados" => $retorno);
        }    

    }

    public function deletar($parametros){
        $arrayErros = $this->validaDados($parametros);
        if(!empty($arrayErros)){
            return $arrayErros;
        }
        $sql = "DELETE FROM tbl_jogador_badge 
                where id_jogador = :id_jogador
                AND id_badge = :id_badge ";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Badge desvinculada com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao desvincular a badge.", "dados" => $retorno);
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
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Ponto turistico invalido"));
        }
        if(empty($parametros['id_badge'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Badge invalido"));
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