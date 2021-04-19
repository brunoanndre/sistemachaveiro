<?php
    require_once 'dao/ClienteDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);

    $parametro = 'todos';

    $listaClientes = $clientedao->buscarConsulta($parametro);
?>
<div class="jumbotronContainer">
    <div class="areaTabela jumbotron">
        <a href="?pagina=cadastrarCliente"><button class="btn  btn-success">Cadastrar Cliente</button><br><br></a>
        <form action="?pagina=consultarServicos" method="post">
            <select name="tipoCliente" class="form-control" style="width:135px" onchange="buscarTipoCliente(this.value)">
                <option>Todos</option>
                <option>Condomínio</option>
                <option>Pessoa Física</option>
                <option>Empresas</option>
            </select>
        </form>
        <div>
                <h3 class="text-center">Consulta de Clientes</h3>
            </div>

        <br>
        <table id="myTable" class="display" style="width:100%">
            <thead>                    
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php if($listaClientes == false){
                    echo '<tr><td colspan="5" class="text-center">Nenhum cliente encontrado </td></tr>';
                } 
                foreach($listaClientes as $item){
                    switch($item->getIdTipo()){
                        case 1:
                            $tipo = 'Pessoa Física';
                            break;
                        case 2:
                            $tipo = 'Condomínio';
                            break;
                        case 3:
                            $tipo = 'Empresa';
                            break;
                    }
                    echo '<tr>';
                    echo '<td><a href="index.php?pagina=exibirCliente&id=' . $item->getId()  . '"><span class="glyphicon glyphicon-eye-open"></span></td></a>';
                    echo '<td>' . $item->getId() . '</td>';
                    echo '<td>' . $item->getNome() . '</td>';
                    echo '<td>' . $tipo . '</td>';
                    echo '</tr>';
                }             
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#myTable').DataTable( {
        "language": {
            "lengthMenu": "Exibir _MENU_ Registros por página",
            "zeroRecords": "Nenhuma interdição encontrada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhuma interdição registrada",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        }
    } );
} );
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>