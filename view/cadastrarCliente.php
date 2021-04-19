<?php
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
            Cliente cadastrado com sucesso.
        </div>
    <?php } ?>
    <?php if(isset($_GET['erroBD'])) { ?>
        <div class="alert alert-success" role="alert">
            Erro ao cadastrar o cliente, contate o administrador.
        </div>
    <?php } ?>
            <form method="POST" action="cadastrarCliente_controller.php">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Nome: <span style="color: red;">*</span>
                        <?php if(isset($_GET['erroNome'])){ ?><span class="alert-danger">O nome do cliente deve ser informado!</span><?php } ?>
                        </label>
                        <input type="text" name="nome" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <label>Tipo de Cliente:<span style="color: red;">*</span></label>
                        <select id="tipoCliente" name="tipo" class="form-control" onchange="mostrarEndereco(), verificaTipo(this.value)">
                            <option selected>Pessoa Física</option>
                            <option>Condomínio</option>
                            <option>Empresa</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div id="cpf" class="col-sm-12">
                        <label>CPF:</label>
                        <input id="cpfInput" type="text" name="cpf" class="form-control" onchange="verificaCpf(this.value)">
                        <span id="erroCpf" class="alertErro hide">CPF inválido.</span>
                    </div>
                    <div id="cnpj" class="col-sm-12 hidden">
                        <label>CNPJ:</label>
                        <input id="cnpjInput" type="text" name="cnpj" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Telefone:</label>
                        <input id="telefone" type="text" name="telefone" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" name="email" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div id="endereco" class="hidden">
                    <h3>Endereço</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Cidade:</label>
                            <input type="text" name="cidade" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Logradouro</label>
                            <input type="text" class="form-control" name="logradouro" >
                        </div>
                        <div class="col-sm-6">
                            <label>Número</label>
                            <input type="text" class="form-control" name="numero" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Referência:</label>
                            <input type="text" name="referencia" class="form-control" autocomplete="off">
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="botaoCadastrar col-sm-12">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
