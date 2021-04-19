<?php

    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);
    $enderecodao = New EnderecoDaoPgsql($pdo);

    $nome = filter_input(INPUT_POST, 'nome');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $cnpj = filter_input(INPUT_POST, 'cnpj');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $email = filter_input(INPUT_POST, 'email');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $logradouro = filter_input(INPUT_POST,'logradouro');
    $numero = filter_input(INPUT_POST, 'numero');
    $referencia = filter_input(INPUT_POST, 'referencia');
    $id_cliente = filter_input(INPUT_POST, 'id_cliente');
    $id_endereco = filter_input(INPUT_POST, 'id_endereco');

    if($nome == '' || $nome == null){
        header('Location:index.php?pagina=editarCliente&erroNome');
    }

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
        $c->setId($id_cliente);

        if($clientedao->editar($c)){
            header('Location:index.php?pagina=exibirCliente&id='.$id_cliente.'&sucessoEdit');
        }else{
            header('Location:index.php?pagina=editarCliente&id='. $id_cliente .'&erroBD');
        }
    }else{
        $e = New Endereco();
        $e->setId($id_endereco);
        $e->setCidade($cidade);
        $e->setBairro($bairro);
        $e->setLogradouro($logradouro);
        $e->setNumero($numero);
        $e->setReferencia($referencia);

        if($enderecodao->editar($e)){
            $c = New Cliente();
            $c->setNome($nome);
            $c->setIdTipo($tipo);
            $c->setCNPJ($cnpj);
            $c->setEmail($email);
            $c->setTelefone($telefone);
            $c->setIdEndereco($id_endereco);
            $c->setId($id_cliente);

            if($clientedao->editar($c)){
                header('Location:index.php?pagina=exibirCliente&id='.$id_cliente.'&sucessoEdit');
            }else{
                header('Location:index.php?pagina=editarCliente&id='. $id_cliente .'&erroBD');
            }
        }
    }