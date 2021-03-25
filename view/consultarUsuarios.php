<?php
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);
    
    $consultaUsuarios = $usuariodao->buscarConsulta();
