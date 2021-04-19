<?php

    require 'dao/ClienteDaoPgsql.php';
    require 'dao/EnderecoDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);
    $enderecodao = New EnderecoDaoPgsql($pdo);

    $nome = filter_input(INPUT_GET, 'nomeCliente');
    $tipo = filter_input(INPUT_GET, 'tipoCliente');
    $email = filter_input(INPUT_GET, 'emailCliente');
    $telefone = filter_input(INPUT_GET, 'telefoneCliente');
    $cpf = filter_input(INPUT_GET, 'cpfCliente');
    $cnpj = filter_input(INPUT_GET, 'cnpjCliente');
    $cidade = filter_input(INPUT_GET, 'cidade');
    $bairro = filter_input(INPUT_GET, 'bairro');
    $logradouro = filter_input(INPUT_GET, 'logradouro');
    $numero = filter_input(INPUT_GET, 'numero');
    $referencia = filter_input(INPUT_GET, 'referencia');
    $status = 1;

    if($nome !== "" && $nome !== null){
        $response = "Cliente cadastrado com sucesso.";

        switch($tipo){
            case 'Pessoa Física':
                $tipo = 1;
                break;
            case 'Condomínio':
                $tipo = 2;
                break;
            case 'Empresa':
                $tipo = 3;
                break;
        }

        if($tipo == 1 || $tipo == 3){
            $c = new Cliente();
            $c->setNome($nome);
            $c->setIdTipo($tipo);
            $c->setCPF($cpf);
            $c->setCNPJ($cnpj);
            $c->setEmail($email);
            $c->setTelefone($telefone);
            $c->setStatus($status);

            $idCliente = $clientedao->adicionarPeloModal($c);

            if($idCliente == false){
                $response = "Ocorreu um erro no banco de dados, contate o administrador.";
            }
        }else{
            $e = New Endereco();
            $e->setCidade($cidade);
            $e->setBairro($bairro);
            $e->setLogradouro($logradouro);
            $e->setNumero($numero);
            $e->setReferencia($referencia);
    
            $id_endereco = $enderecodao->adicionar($e);
            if($id_endereco > 0){
                $c = New Cliente();
                $c->setNome($nome);
                $c->setIdTipo($tipo);
                $c->setCNPJ($cnpj);
                $c->setEmail($email);
                $c->setTelefone($telefone);
                $c->setIdEndereco($id_endereco);
                $c->setStatus($status);
                
                $idCliente = $clientedao->adicionarPeloModal($c);
                if($idCliente == false){
                    $response = "Ocorreu um erro no banco de dados, contate o administrador.";
                }
            }
        }
    }else{
        $response = "O nome do cliente não foi informado.";
    }

    echo $response;