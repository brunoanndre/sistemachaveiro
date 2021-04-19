<?php
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);

    $listaFuncionarios = $usuariodao->buscarConsulta();


?>
<div class="container">
    <div class="jumbotron cadastroComandaArea">
        <h3 class="text-center">Cadastro de Comanda</h3>
        <div class="boxCadastrarComanda">
        <?php if(isset($_GET['sucesso'])) { ?>
            <div class="alert alert-success" role="alert" style="text-align: center;">
                Comanda cadastrada com sucesso.
            </div>
        <?php } ?>
            <form action="cadastrarComanda_controller.php" method="POST">
                <div class="row">
                    <div class="col-sm-10">
                        <label >Cliente:</label><br>
                            <span id="alertComandaSucesso" class="alert-sucess" style="color: greenyellow;"></span>
                            <div class="row">
                                <input id="cliente" name="cliente" autocomplete="off" type="text" class="form-control inline" style="width:90%; margin-left:15px;" onkeyup="mostrarClientes(this.id, this.value)">
                                <button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#modalCliente"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                            <div  class="autocomplete row" id="buscar_cliente"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Data:</label>
                        <input class="form-control" type="date" name="data_abertura" required autocomplete="off" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Tipo do serviço:</label>
                        <select id="servico" name="tipoServico" class="form-control" required onchange="verificaServico(this.id,this.value)">
                            <option value="Automotivo">Automotivo</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <div id="outroTipoServico" class=" hide">
                            <label>Outro:</label>
                            <input type="text" name="tipoServicoOutro" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <label>Prioridade:</label>
                        <select name="prioridade" class="form-control">
                            <option>Baixa</option>
                            <option>Média</option>
                            <option>Alta</option>
                        </select>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Descrição do serviço:</label>
                        <textarea name="descricao" class="form-control textArea" cols="30"
                        rows="3"></textarea>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Funcionário</label><br>
                        <?php if(isset($_GET['usuarioNaoEncontrado'])) { ?>
                            <span class="alert-danger" style="color: red;">Usuário não encontrado</span>
                                
                        <?php } ?>
                        <div style="display: flex;">
                            <select id="funcionario1" name="funcionario1" class="form-control">

                            <?php if($listaFuncionarios == false){
                                echo '<option> Nenhum funcionário cadastrado.</option>';
                            }else{
                                echo '<option selected></option>';
                                foreach($listaFuncionarios as $funcionario){
                                    echo '<option>'.$funcionario->getNome().'</option>';
                                }
                            } ?>
                            </select>
                            <button type="button" onclick="mostraFuncionario2()" class="btn-default btn-small inline" ><span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-5 hide" id="funcionario2" style="margin-top: 25px;">
                        <select  name="funcionario2" class="form-control">
                        <?php if($listaFuncionarios == false){
                                echo '<option> Nenhum funcionário cadastrado.</option>';
                            }else{
                                echo '<option selected></option>';
                                foreach($listaFuncionarios as $funcionario){
                                    echo '<option>'.$funcionario->getNome().'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                            <label>Agendamento:</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" id="teste" onclick="agendamentoPrevisao(this.value)" id="agendamentoTrue" value="true">
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" onclick="agendamentoPrevisao(this.value)" id="agendamentoFalse" value="false">
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>
                    </div>

                </div>
                <div id="inputPrevisao" class="row col-sm-6 hide">
                        <label>Previsão de chegada:</label>
                        <input type="text" placeholder="dd/mm/aaaa hh:mm" name="previsaoChegada" id="previsaoChegada" onkeydown="chegada()" class="form-control" >
                </div>
                <div id="enderecoDiv">
                     <h3>Endereço</h3>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Cidade</label>
                        <input name="cidade" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-sm-5">
                        <label>Bairro</label>
                        <input name="bairro" type="text" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Logradouro</label>
                        <input type="text" class="form-control" name="logradouro" autocomplete="off">
                    </div>
                    <div class="col-sm-5">
                        <label>Número</label>
                        <input type="text" class="form-control" name="numero" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Referência:</label>
                        <input type="text" name="referencia" class="form-control" autocomplete="off">
                    </div> 
                </div>
                <div class="divBotaoCadastro col-sm-10">
                    <button type="submit" class="btn btn-danger">Cadastrar</button>
                </div>
            </form>
        </div>

        <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form name="clienteAjax" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="hidden" id="idCliente" value="">
                            <label>Nome: <span style="color: red;">*</span>
                            <?php if(isset($_GET['erroNome'])){ ?><span class="alert-danger">O nome do cliente deve ser informado!</span><?php } ?>
                            </label>
                            <input id="nomeCliente" type="text" name="nome" class="form-control" autocomplete="off">
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
                            <input id="cpfCliente" type="text" name="cpf" class="form-control" onchange="verificaCpf(this.value)" autocomplete="off">
                            <span id="erroCpf" class="alertErro hide">CPF inválido.</span>
                        </div>
                        <div id="cnpj" class="col-sm-12 hidden">
                            <label>CNPJ:</label>
                            <input id="cnpjCliente" type="text" name="cnpj" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Telefone:</label>
                            <input id="telefoneCliente" type="text" name="telefone" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-sm-6">
                            <label>E-mail:</label>
                            <input type="email" id="emailCliente" name="email" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div id="endereco" class="hidden">
                        <h3>Endereço</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Cidade:</label>
                                <input type="text" id="cidade" name="cidade" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Bairro</label>
                                <input type="text" id="bairro" name="bairro" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Logradouro</label>
                                <input type="text" id="logradouro" class="form-control" name="logradouro" >
                            </div>
                            <div class="col-sm-6">
                                <label>Número</label>
                                <input type="text" id="numero" class="form-control" name="numero" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Referência:</label>
                                <input type="text" id="referencia" name="referencia" class="form-control" autocomplete="off">
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="botaoCadastrar col-sm-12">
                            <button type="button" class="btn btn-success" onclick="cadastrarClienteModal()">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#cpfCliente").mask("000.000.000-00")
    $("#cnpjCliente").mask("00.000.000/0000-00")
    $("#telefoneCliente").mask("(00) 00000-0000")
})
</script>