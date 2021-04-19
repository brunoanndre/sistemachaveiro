<?php

    require 'dao/ClienteDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);

    $cliente = $_GET['value'];
    $idInput = $_GET['id'];
    $id = 'cliente';

    $nomesClientes = $clientedao->mostrarResultado($cliente);


    $hint = "";

    foreach($nomesClientes as $item){
        $hint .= '<input type="button" class="autocompleteBtn col-sm-16" value="'.$item->getNome().'" onclick="selecionaCliente(this.value,'.$id.')" "> <br>';
    }


    if($hint == ""){
        $response = "Cliente não encontrado.";
    }else{
        $response = $hint;
    }

    echo $response;