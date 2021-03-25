<?php

include 'database.php';
require_once 'models/Usuario.php';

class UsuarioDaoPgsql implements UsuarioDAO{
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function addUsuario(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha, nivel_acesso, ativo) VALUES
            (:nome,:email,:senha,:nivel_acesso,:ativo)");
            $sql->bindValue(":nome", $u->getNome());
            $sql->bindValue(":email", $u->getEmail());
            $sql->bindValue(":senha", $u->getSenha());
            $sql->bindValue(":nivel_acesso", $u->getAcesso());
            $sql->bindValue(":ativo", $u->getAtivo());
            
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function buscarPeloId($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);

            $u = New Usuario();
            $u->setNome($linha['nome']);
            $u->setEmail($linha['email']);
            $u->setAtivo($linha['ativo']);
            $u->setAcesso($linha['nivel_acesso']);

            return $u;
        }else{
            return false;
        }
    }

    public function buscarLogin(Usuario $u){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND ativo = true");
        $sql->bindValue(":email", $u->getEmail());
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $u = New Usuario();
            $u->setID($linha['id_usuario']);
            $u->setSenha($linha['senha']);
            $u->setAcesso($linha['nivel_acesso']);
            return $u;
        }else{
            return false;
        }
    }

    public function buscarConsulta(){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE ativo = true;");
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
  
            foreach($lista as $item){
                $u = New Usuario();
                $u->setID($item['id_usuario']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setAcesso($item['nivel_acesso']);

                $array[] = $u;
            }
            return $array;
        }else{
            return false;
        }
        
    }

}