<?php 

    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $enderecodao = New EnderecoDaoPgsql($pdo);
    $clientedao = New ClienteDaoPgSql($pdo);

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
    $status = true;

    if($nome == '' || $nome == null){
        header('Location:index.php?pagina=cadastrarCliente&erroNome');
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
        $c->setStatus($status);

        if($clientedao->adicionar($c)){
            header('Location:index.php?pagina=cadastrarCliente&sucesso');
        }else{
            header('Location:index.php?pagina=cadastrarCliente&erroBD');
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

            if($clientedao->adicionar($c)){
                header('Location:index.php?pagina=cadastrarCliente&sucesso');
            }else{
                header('Location:index.php?pagina=cadastrarCliente&erroBD');
            }
        }
    }