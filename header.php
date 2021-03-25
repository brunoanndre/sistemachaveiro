<?php
  include 'database.php';
  include 'dao/UsuarioDaoPgsql.php';

  $usuariodao = New UsuarioDaoPgsql($pdo);
  session_start();
  //BUSCAR NOME DO USUÁRIO PARA IMPRIMIR NO HEADER
  $nomeUsuario = $usuariodao->buscarPeloId($_SESSION['id_usuario'])->getNome();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaveiro Pão de Açúcar</title>
    <link href="../images/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</head>
<body>
  <div class="header_header">..
    <div class="header-img">
        <div><img src="images/d84f7dc6e6a461f2796a86b110de4f2f.png" class="img-header" ></div>
    </div>
    <div class="header-nav">
      <nav class="nav-header">
        <ul>
          <a href="index.php?pagina=consultarServicos"><li>Serviços</li></a>    
          <a href=""><li>Financeiro</li></a>
          <a href=""><li>Estoque</li></a>
          <a href=""><li>Usuários</li></a>
        </ul>
      </nav>
    </div>
    <li class="dropdown">
      <a class="user-dropdown dropdown-toggle" href="" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none;">Chaveiro</a>
    <?php echo $nomeUsuario; ?>
    </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <a class="dropdown-item btn btn-danger" href="#">Perfil</a><br>
        <a class="dropdown-item btn btn-danger" href="#">Sair</a>
      </div>
    </li>
  </div>
    
</body>
</html>