<?php

Class BadgesDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                tbl_badges.id_badge,
                tbl_badges.nome_badge,
                tbl_badges.requisito,
                tbl_badges.url_imagem,
                tbl_badges.experiencia,
                tbl_badges.matricula_cadastro,
                tbl_funcionarios.nome_funcionario
            FROM tbl_badges , tbl_funcionarios 
            where tbl_badges.matricula_cadastro = tbl_funcionarios.matricula ";
        if(!empty($parametros['id_badge'])){
            $sql .= " and tbl_badges.id_badge = :id_badge ";
        }
        if(!empty($parametros['nome_badge'])){
            $parametros['nome_badge'] = '%' . str_replace(' ','%', $parametros['nome_badge']) . '%';
            $sql .= " and upper(tbl_badges.nome_badge) like upper(:nome_badge) ";
        }
        if(!empty($parametros['experiencia'])){
            $sql .= " and tbl_badges.experiencia = :experiencia";
        }
        if(!empty($parametros['experienciaini']) && !empty($parametros['experienciafim'])){
            $sql .= " and tbl_badges.experiencia between :experienciaini and :experienciafim";
        }        
        
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        }    
    }

    public function cadastrar($parametros){
        
        if(!empty($parametros['id_badge'])){
            return $this->atualizar($parametros);
        }
        $erros = $this->validaDados($parametros);
        if(!empty($erros)){
            return $erros;
        }
        $sql = "INSERT INTO tbl_badges (
                            nome_badge,
                            requisito,
                            url_imagem,
                            experiencia,
                            matricula_cadastro
                        ) VALUES ( 
                            :nome_badge,
                            :requisito,
                            :url_imagem,
                            :experiencia,
                            :matricula_cadastro
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Badge cadastrada com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao cadastrar badge.", "dados" => $retorno);
        }    

    }

    public function atualizar($parametros){
        
        $sql = "UPDATE tbl_badges SET 
                    nome_badge = ifnull( :nome_badge , nome_badge ),
                    requisito = ifnull( :requisito , requisito ),
                    url_imagem = ifnull( :url_imagem , url_imagem ),
                    experiencia = ifnull( :experiencia , experiencia ),
                    matricula_cadastro = ifnull( :matricula_cadastro , matricula_cadastro )
                where id_badge = :id_badge";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Badge atualizado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao atualizar a badge.", "dados" => $retorno);
        }    
    }

    public function validaDados($parametros){
        $arrayErros = array();
        if(empty($parametros['nome_badge'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Nome da badge invalida"));
        }
        if(empty($parametros['requisito'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Requisitos da badge invalido"));
        }
        if(empty($parametros['url_imagem'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Url da imagem invalida"));
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