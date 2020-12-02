<?php

Class CircuitosDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                    tbl_circuitos.id_circuito,
                    tbl_circuitos.nome_circuito,
                    tbl_circuitos.experiencia,
                    tbl_circuitos.matricula_cadastro,
                    tbl_funcionarios.nome_funcionario,
                    tbl_circuitos.id_badge,
                    tbl_badges.nome_badge
         FROM tbl_circuitos, tbl_funcionarios, tbl_badges 
         where tbl_circuitos.idbadge = tbl_badges.idbadge
         and tbl_circuitos.matricula_cadastro = tbl_funcionarios.matricula";
        if(!empty($parametros['id_circuito'])){
            $sql .= " and tbl_circuitos.id_circuito = :id_circuito ";
        }
        if(!empty($parametros['nome_circuito'])){
            $parametros['nome_badge'] = '%' . str_replace(' ','%', $parametros['nome_badge']) . '%';
            $sql .= " and upper(tbl_circuitos.nome_badge) like upper(:nome_badge) ";
        }
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        }    
    }

    public function cadastrar($parametros){
        
         if(!empty($parametros['id_circuito'])){
            return $this->atualizar($parametros);
        }
        $erros = $this->validaDados($parametros);
        if(!empty($erros)){
            return $erros;
        }
        $sql = "INSERT INTO tbl_circuitos (
                            nome_circuito,
                            experiencia,
                            matricula_cadastro,
                            id_badge
                        ) VALUES ( 
                            :nome_circuito,
                            :experiencia,
                            :matricula_cadastro,
                            :id_badge
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Circuito cadastrado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao cadastrar circuito.", "dados" => $retorno);
        }    

    }

    public function atualizar($parametros){
        
        $sql = "UPDATE tbl_badges SET 
                    nome_circuito = ifnull( :nome_circuito , nome_circuito ),
                    experiencia = ifnull( :experiencia , experiencia ),
                    matricula_cadastro = ifnull( :matricula_cadastro , matricula_cadastro ),
                    id_badge = ifnull( :id_badge , id_badge )
                where id_circuito = :id_circuito";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Circuito atualizado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao atualizar a circuito.", "dados" => $retorno);
        }    
    }

    public function validaDados($parametros){
        $arrayErros = array();
        if(empty($parametros['nome_circuito'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Nome do circuito invalido"));
        }
        if(empty($parametros['id_badge'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Badge invalida"));
        }
        if(empty($parametros['experiencia'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Experiencia da badge invalido"));
        }
        if(empty($parametros['matricula_cadastro'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Matricula do funcionario que realizou o cadastro invalida"));
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