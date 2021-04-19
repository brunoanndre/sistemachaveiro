<?php
    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);
    $enderecodao = New EnderecoDaoPgsql($pdo);

    $id_cliente = $_GET['id'];

    $linhaCliente = $clientedao->buscarPeloId($id_cliente);

    if($linhaCliente->getIdTipo() == 2){
        $id_endereco = $linhaCliente->getIdEndereco();
        $linhaEndereco = $enderecodao->buscarPeloId($id_endereco);
    }

?>
<script>
$(document).ready(function(){
    $("#cpfInput").mask("000.000.000-00")
    $("#cnpjInput").mask("00.000.000/0000-00")
    $("#telefone").mask("(00) 00000-0000")
})
</script>

<div class="container">
    <div class="jumbotron cadastroClienteArea">
        <h3 class="text-center">Cadastro de Cliente</h3>

        <div class="boxCadastrarCliente">
    <?php if(isset($_GET['sucesso'])) { ?>
        <div class="alert alert-success" role="alert">
            Dados alterados com sucesso.
        </div>
    <?php } ?>
    <?php if(isset($_GET['erroBD'])) { ?>
        <div class="alert alert-success" role="alert">
            Erro ao cadastrar o cliente, contate o administrador.
        </div>
    <?php } ?>
            <form method="POST" action="editarCliente_controller.php">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Nome: <span style="color: red;">*</span>
                        <?php if(isset($_GET['erroNome'])){ ?><span class="alert-danger">O nome do cliente deve ser informado!</span><?php } ?>
                        </label>
                        <input type="text" name="nome" class="form-control" autocomplete="off" value="<?php echo $linhaCliente->getNome();?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <label>Tipo de Cliente:<span style="color: red;">*</span></label>
                        <select id="tipoCliente" name="tipo" class="form-control" onchange="mostrarEndereco(),verificaTipo(this.value)">
                            <option <?php if($linhaCliente->getIdTipo() == 1){echo 'selected';} ?>>Pessoa Física</option>
                            <option <?php if($linhaCliente->getIdTipo() == 2){echo 'selected';} ?>>Condomínio</option>
                            <option <?php if($linhaCliente->getIdTipo() == 3){echo 'selected';} ?>>Empresa</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                <input class="hidden" id="tipoClienteEdit" onload="exibeCpfCnpj(this.value)" value="<?php echo $linhaCliente->getIdTipo(); ?>">
                        <div id="cpf" class="col-sm-12">
                            <label>CPF:</label>
                            <input id="cpfInput" type="text" name="cpf" class="form-control" onchange="verificaCpf(this.value)" value="<?php echo $linhaCliente->getCPF(); ?>">
                            <span id="erroCpf" class="alertErro hide">CPF inválido.</span>
                        </div>
                        <div id="cnpj" class="col-sm-12">
                            <label>CNPJ:</label>
                            <input id="cnpjInput" type="text" name="cnpj" class="form-control" autocomplete="off" value="<?php echo $linhaCliente->getCNPJ() ?>">
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Telefone:</label>
                        <input id="telefone" type="text" name="telefone" class="form-control" autocomplete="off" value="<?php echo $linhaCliente->getTelefone(); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" value="<?php echo $linhaCliente->getEmail()?>">
                    </div>
                </div>
                <?php if($linhaCliente->getIdTipo() == "2"){ ?>
                    <div id="endereco">
                        <h3>Endereço</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Cidade:</label>
                                <input type="text" name="cidade" class="form-control" value="<?php echo $linhaEndereco->getCidade() ?>">
                            </div>
                            <div class="col-sm-6">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control" value="<?php echo $linhaEndereco->getBairro() ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" value="<?php echo $linhaEndereco->getLogradouro() ?>">
                            </div>
                            <div class="col-sm-6">
                                <label>Número</label>
                                <input type="text" class="form-control" name="numero" autocomplete="off" value="<?php echo $linhaEndereco->getNumero() ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Referência:</label>
                                <input type="text" name="referencia" class="form-control" autocomplete="off" value="<?php echo $linhaEndereco->getReferencia(); ?>">
                            </div> 
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-6 botaoVoltar">
                    <a href="index.php?pagina=exibirCliente&id=<?php echo $id_cliente ?>" class="btn btn-default btn-danger">Voltar</a>
                    </div>
                    <div class="botaoCadastrar col-sm-4">
                        <input class="hidden" name="id_endereco" value="<?php echo $id_endereco; ?>">
                        <input class="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
<script>
window.onload = function(){
    let tipo = document.getElementById('tipoClienteEdit').value;
    let cnpj = document.getElementById('cnpj');
    let cpf = document.getElementById('cpf');

    if(tipo == '2' || tipo == '3'){
        cpf.classList.add('hidden');
        cnpj.classList.remove('hidden');
    }else{
        cpf.classList.remove('hidden');
        cnpj.classList.add('hidden');
    }
}
</script>