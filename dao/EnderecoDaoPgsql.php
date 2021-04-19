<?php

    include 'database.php';
    require_once 'models/Endereco.php';

    class EnderecoDaoPgsql implements EnderecoDAO{
        private $pdo;

        public function __construct(PDO $driver){
            $this->pdo = $driver;
        }

        public function adicionar(Endereco $e){
            $sql = $this->pdo->prepare("INSERT INTO endereco (cidade, bairro, logradouro, numero, referencia) VALUES
            (:cidade, :bairro, :logradouro, :numero, :referencia)");
            $sql->bindValue(":cidade", $e->getCidade());
            $sql->bindValue(":bairro", $e->getBairro());
            $sql->bindValue(":logradouro", $e->getLogradouro());
            $sql->bindValue(":numero", $e->getNumero());
            $sql->bindValue(":referencia", $e->getReferencia());

            
            if($sql->execute()){
                $id = $this->pdo->lastInsertId();
                return $id;
            }else{
                return false;
            }
        }

        public function buscarEndereco($logradouro, $numero){
            $sql = $this->pdo->prepare("SELECT * FROM endereco WHERE logradouro = :logradouro AND numero = :numero");
            $sql->bindValue(":logradouro", $logradouro);
            $sql->bindValue(":numero", $numero);
            $sql->execute();

            if($sql->rowCount() > 0 ){
                $linha = $sql->fetch(PDO::FETCH_ASSOC);
                return $linha['id'];
            }else{
                return false;
            }
        }

        public function buscarPeloId($id){
            $sql = $this->pdo->prepare("SELECT * FROM endereco WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $linha = $sql->fetch(PDO::FETCH_ASSOC);

                $e = New Endereco();
                $e->setCidade($linha['cidade']);
                $e->setBairro($linha['bairro']);
                $e->setLogradouro($linha['logradouro']);
                $e->setNumero($linha['numero']);
                $e->setReferencia($linha['referencia']);

                return $e;
            }else{
                return false;
            }
        }

        public function editar(Endereco $e){
            $sql = $this->pdo->prepare("UPDATE endereco SET cidade = :cidade, bairro = :bairro, logradouro = :logradouro, numero = :numero, referencia = :referencia WHERE id = :id");
            $sql->bindValue(":cidade", $e->getCidade());
            $sql->bindValue(":bairro", $e->getBairro());
            $sql->bindValue(":logradouro", $e->getLogradouro());
            $sql->bindValue(":numero", $e->getNumero());
            $sql->bindValue(":referencia", $e->getReferencia());
            $sql->bindValue(":id", $e->getId());

            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }
    }