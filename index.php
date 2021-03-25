
<?php
include 'database.php';


session_start();

if($_SESSION['login'] == true){
    $pagina = $_GET['pagina'];
}else{
    if($_GET['pagina'] ==  'esqueceuSenha'){
        $pagina = 'esqueceuSenha';
    }else{
        $pagina = 'login';
    }
}

if($pagina != 'login' && $pagina != 'esqueceuSenha'){
    include 'header.php';
}

if(isset($_SESSION['nivel_acesso'])){
    if($_SESSION['nivel_acesso'] == 1){
        switch($pagina){
           default: case 'consultarServicos': include 'view/consultarServicos.php'; break;
           case 'consultarUsuarios': include 'view/consultarUsuarios.php'; break;
        }
    }else{
        switch($pagina){
            default: case 'consultarServicos': include 'view/consultarServicos.php'; break;
        }
    }
}
