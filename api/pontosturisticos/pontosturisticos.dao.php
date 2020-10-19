<?php

Class PontosTuristicosDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function consultar($parametros){
        $sql = "SELECT 
                tbl_pontos_turisticos.id_ponto_turistico,
                tbl_pontos_turisticos.nome,
                tbl_pontos_turisticos.experiencia,
                tbl_pontos_turisticos.url_imagem,
                tbl_pontos_turisticos.descricao,
                tbl_pontos_turisticos.matricula_cadastro,
                tbl_funcionarios.nome_funcionario,
                tbl_pontos_turisticos.id_badge,
                tbl_badges.nome_badge
            FROM tbl_pontos_turisticos, tbl_funcionarios, tbl_badges 
            WHERE tbl_pontos_turisticos.matricula_cadastro = tbl_funcionarios.matricula 
            AND   tbl_pontos_turisticos.id_badge = tbl_badges.id_badge";
        if(!empty($parametros['id_badge'])){
            $sql .= " and tbl_pontos_turisticos.id_badge = :id_badge ";
        }
        if(!empty($parametros['nome'])){
            $parametros['nome'] = '%' . str_replace(' ','%', $parametros['nome']) . '%';
            $sql .= " and upper(tbl_pontos_turisticos.nome) like upper(:nome) ";
        }
        if(!empty($parametros['descricao'])){
            $parametros['descricao'] = '%' . str_replace(' ','%', $parametros['descricao']) . '%';
            $sql .= " and upper(tbl_pontos_turisticos.descricao) like upper(:descricao) ";
        }
        if(!empty($parametros['experiencia'])){
            $sql .= " and tbl_pontos_turisticos.experiencia = :experiencia";
        }        
        
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        }    
    }

    public function cadastrar($parametros){
        
        if(!empty($parametros['id_ponto_turistico'])){
            return $this->atualizar($parametros);
        }
        $erros = $this->validaDados($parametros);
        if(!empty($erros)){
            return $erros;
        }
        $sql = "INSERT INTO tbl_pontos_turisticos (
                            nome,
                            experiencia,
                            url_imagem,
                            descricao,
                            matricula_cadastro,
                            id_badge
                        ) VALUES ( 
                            :nome,
                            :experiencia,
                            :url_imagem,
                            :descricao,
                            :matricula_cadastro,
                            :id_badge
                        )";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Ponto turistico cadastrado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao cadastrar ponto turistico.", "dados" => $retorno);
        }    

    }

    public function atualizar($parametros){
        
        $sql = "UPDATE tbl_pontos_turisticos SET 
                    nome = ifnull( :nome , nome ),
                    experiencia = ifnull( :experiencia , experiencia ),
                    url_imagem = ifnull( :url_imagem , url_imagem ),
                    descricao = ifnull( :descricao , descricao ),
                    matricula_cadastro = ifnull( :matricula_cadastro , matricula_cadastro ),
                    id_badge = ifnull( :id_badge , id_badge )
                where id_ponto_turistico = :id_ponto_turistico";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Ponto turistico atualizado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao atualizar o ponto turistico.", "dados" => $retorno);
        }    
    }

    public function validaDados($parametros){
        $arrayErros = array();
        if(empty($parametros['nome'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Nome do ponto turistico invalido"));
        }
        if(empty($parametros['experiencia'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Experiencia do ponto turistico invalido"));
        }
        if(empty($parametros['url_imagem'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Url da imagem invalida"));
        }
        if(empty($parametros['descricao'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Descricao invalida"));
        }
        if(empty($parametros['matricula_cadastro'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Matricula do funcionario que realizou o cadastro invalida"));
        }
        if(empty($parametros['id_badge'])){
            array_push($arrayErros, array("sucesso" => false, "mensagem" => "Badge invalida"));
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