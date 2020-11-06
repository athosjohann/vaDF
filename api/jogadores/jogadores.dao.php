<?php

Class JogadoresDAO{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function login($parametros){

        $parametros['senha'] = !empty($parametros['senha']) ? md5($parametros['senha']) : '';

        $sql = "SELECT id_jogador, nome_jogador, email, ativo, email_confirmado FROM tbl_jogador 
                where email = :email 
                and senha = :senha";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);        
        if(empty($retorno['dados'])){
            return array("sucesso" => false, "mensagem" => "Usuario ou senha invalidos!");
        }

        if($retorno['dados'][0]['ativo'] == 0){
            return array("sucesso" => false, "mensagem" => "Usuario inativo!");
        }

        if($retorno['dados'][0]['email_confirmado'] == 0){
            return array("sucesso" => false, "mensagem" => "E-mail não confirmado!");
        }

        $retorno['dados'][0]['token'] = $this->gerarTokenJogador($retorno['dados'][0]['email']);

        $this->conexao->ExecutarSQL("UPDATE tbl_jogador SET token = :token , dtultconexao = now() WHERE id_jogador = :id_jogador", array("token" => $retorno['dados'][0]['token'],"id_jogador" => $retorno['dados'][0]['id_jogador']));

        return array(
            "sucesso" => true,
            "mensagem" => "Login realizado com sucesso",
            "dados" => $retorno['dados']
        );
    }

    public function ObterDadosUsuarioToken($token){

        $reposta = $this->conexao->ExecutarSQL("SELECT *
                                                FROM tbl_jogador
                                                WHERE token = :token
                                                AND ativo = 1", array("token" => $token));


        if(count($reposta['dados']) > 0)
        {
            $retorno = array();
            $retorno['sucesso'] = true;
            $retorno['mensagem'] = "Sessão do usuário ativa.";
            $retorno['dados'] = $reposta['dados'][0];

            $this->conexao->ExecutarSQL("UPDATE tbl_jogador SET dtultconexao = now() WHERE email = :email", array("email" => $reposta['dados'][0]['email']));

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

    public function gerarTokenJogador($emailUsuario){
        return substr(substr(md5($emailUsuario), 0,25).sha1(rand()), 0, 50);;
    }

    public function cadastrar($parametros){
        
        $sql = "INSERT INTO tbl_jogador (
                            nome_jogador,
                            data_nascimento,
                            email,
                            senha,
                            coordenadas,	
                            experiencia,
                            titulo,
                            token	
                        ) VALUES ( 
                            trim(:nome_jogador) , 
                            STR_TO_DATE( :data_nascimento , '%d/%m/%Y'),
                            trim(lower(:email)), 
                            md5(:senha), 
                            :coordenadas,
                            0,
                            :titulo,
                            :token
                        )";

        $parametros['token'] = $this->gerarTokenJogador($parametros['email']);
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Jogador cadastrado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao cadastrar o jogador.", "dados" => $retorno);
        }    

    }

    public function alterarSenha($parametros){
        
        $sql = "UPDATE tbl_jogador SET senha = md5(:novasenha) where senha = md5(:senha) and trim(lower(email)) = trim(lower(:email))";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Senha alterada com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao alterar senha.", "dados" => $retorno);
        }    
    }

    public function confirmarEmail($parametros){
        
        $sql = "UPDATE tbl_jogador SET email_confirmado = 1 where token = :token";

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "E-mail confirmado com sucesso!", "dados" => $parametros);
        } else {
            return array("sucesso" => false, "mensagem" => "E-mail já confirmado ou link inválido.", "dados" => $retorno);
        }    
    }

    public function emailExiste($email){
        
        $sql = "SELECT count(*) as total from tbl_jogador where trim(lower(email)) = trim(lower(:email))";
        $retorno = $this->conexao->ExecutarSQL($sql, array("email" => $email));

        if($retorno['dados'][0]['total'] > 0){
            return true;
        }else{
            return false;
        }
        
    }

    public function atualizar($parametros){
        $sql = "UPDATE tbl_jogador set 
                    nome_jogador = ifnull( :nome_jogador, nome_jogador ),
                    data_nascimento = ifnull( :data_nascimento, data_nascimento ),
                    email = ifnull( :email, email ),
                    senha = ifnull( :senha, senha ),
                    token = ifnull( :token, token ),
                    dtultconexao = ifnull( :dtultconexao, dtultconexao ),
                    coordenadas = ifnull( :coordenadas, coordenadas ),
                    experiencia = ifnull( :experiencia, experiencia ),
                    titulo = ifnull( :titulo, titulo ),
                    email_confirmado = ifnull( :email_confirmado, email_confirmado ),
                    ativo = ifnull( :ativo, ativo )
                WHERE id_jogador = :id_jogador";
        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Jogador atualizado com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao atualizar jogador", "dados" => $retorno);
        } 
    }

    public function consultar($parametros){
        $sql = "SELECT * FROM tbl_jogador where 1 = 1";
        if(!empty($parametros['id_jogador'])){
            $sql .= " and id_jogador in (:id_jogador) ";
        }
        if(!empty($parametros['nome'])){
            $parametros['nome_jogador'] = '%' . str_replace(' ','%', $parametros['nome_jogador']) . '%';
            $sql .= " and upper(nome_jogador) like upper(:nome_jogador) ";
        }
        if(!empty($parametros['email'])){
            $sql .= " and email = :email ";
        }
        if(!empty($parametros['ativo'])){
            $sql .= " and ativo = :ativo ";
        }
        if(!empty($parametros['email_confirmado'])){
            $sql .= " and email_confirmado = :email_confirmado ";
        }

        $retorno = $this->conexao->ExecutarSQL($sql, $parametros);

        if ($retorno["sucesso"] == true){
            return array("sucesso" => true, "mensagem" => "Consulta realizada com sucesso", "dados" => $retorno['dados']);
        } else {
            return array("sucesso" => false, "mensagem" => "Erro desconhecido ao realizar consulta", "dados" => $retorno);
        } 
    }

}
