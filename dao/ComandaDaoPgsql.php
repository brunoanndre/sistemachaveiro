<?php

    include 'database.php';
    require_once 'models/Comanda.php';

    class ComandaDaoPgSql implements ComandaDAO{
        private $pdo;
        
        public function __construct(PDO $driver){
            $this->pdo = $driver;
        }

        public function cadastrar(Comanda $c){
            $sql = $this->pdo->prepare("INSERT INTO comandas (idendereco, idusuario1, idusuario2, idcliente, dataInicial, descricao, tipo, prioridade, agendamento, previsaochegada) VALUES
            (:endereco, :usuario1, :usuario2,:cliente,:dataInicial, :descricao, :tipo, :prioridade, :agendamento ,:previsaoChegada)");
            $sql->bindValue(":endereco", $c->getIdEndereco());
            if($c->getIdUsuario1() == ""){
                $sql->bindValue(":usuario1", null, PDO::PARAM_NULL);
            }else{
                $sql->bindValue(":usuario1", $c->getIdUsuario1());
            }
            if($c->getIdUsuario2() == ""){
                $sql->bindValue(":usuario2", null, PDO::PARAM_NULL);
            }else{
                $sql->bindValue(":usuario2", $c->getIdUsuario2());
            }
            $sql->bindValue(":cliente", $c->getIdCliente());
            $sql->bindValue(":dataInicial", $c->getDataInicial());
            $sql->bindValue(":descricao", $c->getDescricao());
            $sql->bindValue(":tipo", $c->getTipo());
            $sql->bindValue(":prioridade", $c->getPrioridade());
            $sql->bindValue(":agendamento", $c->getAgendamento());
            if($c->getAgendamento() == "false"){
                $sql->bindValue(":previsaoChegada", null, PDO::PARAM_NULL);
            }else{
                $sql->bindValue(":previsaoChegada", $c->getPrevisaoChegada());
            }

            if($sql->execute()){
                $id_comanda = $this->pdo->lastInsertId();
                return $id_comanda;
            }else{
                return false;
            }

        }

        public function buscarConsulta($parametro){
            if($parametro == "todas"){
                $sql = $this->pdo->prepare("SELECT * FROM comandas");
                $sql->execute();

                if($sql->rowCount() > 0){
                    $listaComandas = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($listaComandas as $comanda){
                        $c = New Comanda();
                        $c->setId($comanda['id']);
                        $c->setIdCliente($comanda['idcliente']);
                        $c->setIdEndereco($comanda['idendereco']);
                        $c->setDescricao($comanda['descricao']);
                        $c->setDataInicial($comanda['datainicial']);

                        $array[] = $c;
                    }
                    return $array;
                }else{
                    return false;
                }
            }

        }

        public function editar(Comanda $c){
            
        }

        public function cancelar(Comanda $c){
            
        }

        public function encerrar(Comanda $c){
            
        }

    }