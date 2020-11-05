<?php

Class FuncionariosDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function login($parametros){

        $parametros['senha'] = !empty($parametros['senha']) ? md5($parametros['senha']) : '';

        $sql = "SELECT matricula, nome_funcionario, email, token , ativo FROM tbl_funcionarios 
                where email = :email 
                and senha = :senha";
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if(empty($retorno['dados'])){
            return array("sucesso" => false, "mensagem" => "Usuario ou senha invalidos!");
        }

        if($retorno['dados'][0]['ativo'] == 0){
            return array("sucesso" => false, "mensagem" => "Usuario inativo!");
        }

        $retorno['dados'][0]['token'] = $this->gerarTokenFuncionario($retorno['dados'][0]['email']);

        $this->conexao->ExecutarSQL("UPDATE tbl_funcionarios SET token = :token , dtultconexao = now() WHERE matricula = :matricula", array("token" => $retorno['dados'][0]['token'],"matricula" => $retorno['dados'][0]['matricula']));

        return array(
            "sucesso" => true,
            "mensagem" => "Login realizado com sucesso",
            "dados" => $retorno['dados']
        );
    }

    public function ObterDadosUsuarioToken($token){

        $reposta = $this->conexao->ExecutarSQL("SELECT *
                                                FROM tbl_funcionarios
                                                WHERE token = :token
                                                AND ativo = 1", array("token" => $token));


        if(count($reposta['dados']) > 0)
        {
            $retorno = array();
            $retorno['sucesso'] = true;
            $retorno['mensagem'] = "Sessão do usuário ativa.";
            $retorno['dados'] = $reposta['dados'][0];

            $this->conexao->ExecutarSQL("UPDATE tbl_funcionarios SET dtultconexao = now() WHERE email = :email", array("email" => $reposta['dados'][0]['email']));

            return $retorno;
        }
        else
        {
            $retorno = array(
                "sucesso" => false,
                "mensagem" => "Token inválido ou usuário desconectado.");
            return $retorno;
        }

    }

    public function gerarTokenFuncionario($emailUsuario){
        return substr(substr(md5($emailUsuario), 0,25).sha1(rand()), 0, 50);;
    }

    public function cadastrar($parametros){
        
        $sql = "INSERT INTO tbl_funcionarios (
                            nome_funcionario,
                            email,
                            senha,
                            token,
                            dtultconexao,
                            ativo
                        ) VALUES ( 
                            upper(:nome_funcionario),
                            lower(:email),
                            :senha,
                            :token,
                            :dtultconexao,
                            :ativo
                        )";

        $parametros['token'] = $this->gerarTokenFuncionario($parametros['email']);
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Funcionario cadastrado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao cadastrar o funcionario.", "dados" => $retorno);
        }    

    }

    public function alterarSenha($parametros){
        
        $sql = "UPDATE tbl_funcionarios SET senha = md5(:novasenha) where senha = md5(:senha) and trim(lower(email)) = trim(lower(:email))";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Senha alterada com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao alterar senha.", "dados" => $retorno);
        }    
    }

    public function emailExiste($email){
        
        $sql = "SELECT count(*) as total from tbl_funcionarios where trim(lower(email)) = trim(lower(:email))";
        $retorno = $this->conexao->ExecutarSQL($sql, array("email" => $email));

        if($retorno['dados'][0]['total'] > 0){
            return true;
        }else{
            return false;
        }
        
    }

    public function atualizar($parametros){
        $sql = "UPDATE tbl_funcionarios set 
                    nome_funcionario = ifnull( :nome_funcionario , nome_funcionario ),
                    email = ifnull( :email , email ),
                    token = ifnull( :token , token ),
                    dtultconexao = ifnull( :dtultconexao , dtultconexao ),
                    ativo = ifnull( :ativo , ativo )
                WHERE matricula = :matricula";
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Funcionario atualizado com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao atualizar funcionario", "dados" => $retorno);
        } 
    }

    public function consultar($parametros){
        $sql = "SELECT * FROM tbl_funcionarios where 1 = 1";
        if(!empty($parametros['id_funcionario'])){
            $sql .= " and id_funcionario in (:id_funcionario) ";
        }
        if(!empty($parametros['nome_funcionario'])){
            $parametros['nome_nome_funcionariojogador'] = '%' . str_replace(' ','%', $parametros['nome_funcionario']) . '%';
            $sql .= " and upper(nome_funcionario) like upper(:nome_funcionario) ";
        }
        if(!empty($parametros['email'])){
            $sql .= " and email = :email ";
        }
        if(!empty($parametros['matricula'])){
            $sql .= " and matricula = :matricula ";
        }
        if(!empty($parametros['ativo'])){
            $sql .= " and ativo = :ativo ";
        }

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        } 
    }

}
