<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php'); ?>
<?php require_once (HEADER_TEMPLATE); ?>
<?php
    require_once ('../../dao/venda_dao.php');        

    if ($_POST['id_agenda']) {        
        $_SESSION['id_agenda'] = $_POST['id_agenda'];
    }
    
    if ($_POST['id_agenda']) {
        $agenda_venda = $_POST['id_agenda'];    
    } else {
        $agenda_venda = $_SESSION['id_agenda'];    
    }    
    
    fechar_agenda($agenda_venda);    
    lista_produto();
    lista_servico();    
    
    if ($_POST['id_agenda'] || $_SESSION['id_agenda']) {
        checar_venda_nova($agenda_venda);        
        $id_venda = $checar_venda_nova[0]['id_venda'];
        if ($id_venda) {
            update_abrir_venda();
        }        
    }    

?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="col-xs-offset-5">Venda</h3>            
                </div>
            </div>
        </div>                
        
        <div class="col-md-12">
            <div class="box box-primary">
                <form method="POST" action="venda_cadastro.php">
                    <div class="box-header">
                        <h4 class="box-title">Lançamento da venda</h4>
                        <hr />
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-3">
                            <label for='venda'>Nº da Venda - </label>  
                            <label class="control-label"><?php echo $fechar_agenda[0]['id_venda']; ?></label>
                            
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        <div class="form-group col-md-5">
                            <label for="cliente">Cliente</label>
                            <input type="hidden" name="venda['cliente_id_cliente']" value="<?php echo $agenda_venda ?>" />
                            <input type="text" class="form-control" id="cliente_venda" name="nome_cliente" value="<?php echo $fechar_agenda[0]['nome']; ?>" disabled />
                        </div>                       

                        <div class="form-group col-md-6">
                            <label>Atendido por:</label>
                            <select id="profissional_id_profissional" name="venda['profissional_id_profissional']" class="form-control">
                                <option value="<?php echo $fechar_agenda[0]['id_profissional']; ?>"><?php echo $fechar_agenda[0]['profissionalNome']; ?></option>                        
                            </select>
                        </div>
                        
                        <div class="clearfix"></div>
                        <br />

                        <div id="itens_servicos" class="form-group col-md-6">
                            <label>Itens/Serviços</label>
                            <?php 
                                item_venda(); 
                            ?>
                            <table class="table table-hover row-border cell-border">
                                <thead>
                                    <tr>
                                        <td>Item</td>
                                        <td>Desc. Produto</td>
                                        <td>Desc. Serviço</td>
                                        <td>Quantidade</td>
                                        <td>Valor Total</td>
                                        <td width="15%"></td>                                        
                                    </tr>
                                </thead>
                                <tbody id="itens_venda">
                                    <?php
                                        if ($item_venda) {
                                            foreach ($item_venda as $itens) :
                                    ?>
                                                <tr>
                                                    <td><?php echo $itens['id_item_venda']; ?></td>
                                                    <td><?php echo ($itens['descricao_produto'] == null) ? ' ' : $itens['descricao_produto']; ?></td>                                                                                                       
                                                    <td><?php echo ($itens['descricao_servico'] == null) ? ' ' : $itens['descricao_servico']; ?></td>
                                                    <td><?php echo ($itens['quantidade_total'] == null) ? ' ' : $itens['quantidade_total']; ?></td>
                                                    <td><?php echo $itens['valor_total']; ?></td>
                                                    <?php if ($fechar_agenda[0]['situacao'] == 'A') { ?>
                                                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-item-venda" data-delete="<?php echo $itens['id_item_venda']; ?>"><i class="fa fa-trash"></i></a></td>                                                    
                                                    <?php } ?>
                                                </tr>
                                                
                                    <?php
                                            endforeach;
                                        } else {                                            
                                    ?>
                                            <tr>
                                                <td colspan="4">Nenhum registro encontrado!</td>
                                            </tr>
                                    <?php
                                        }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>
                        <?php if ($fechar_agenda[0]['situacao'] == 'A') { ?>
                            <button type="button" class="btn btn-primary" id="btn_produto" data-toggle="modal" data-target="#modal-cad-produtos" ><i class="fa fa-plus"> Produtos</i></button><br/><br/>
                            <button type="button" class="btn btn-primary" id="btn_servico" data-toggle="modal" data-target="#modal-cad-servicos" ><i class="fa fa-plus"> Serviços</i></button>
                        <?php } ?>
                        
                        <div class="clearfix"></div>
                        <?php 
                            $valor_total = $fechar_agenda[0]['valor_servico'];
                        ?>
                        <div class="form-group col-md-3 pull-right" id="valor"> 
                            
                        </div>                        

                    </div> 
                    <div class="box-footer">
                        <a href="../agenda.php" class="btn btn-default">Cancelar</a> 
                        <?php if ($fechar_agenda[0]['situacao'] == 'A') { ?>
                            <button type="button" id="btn_recebimento" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-cad-venda" >Receber</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</section>

<!-- MODAL DE INSERÇÃO DE PRODUTOS -->
<div class="modal fade" id="modal-cad-produtos">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="venda_cadastro.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Produtos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-6">
                        <label for="tipo" id="lbl_produto_servico">Produto</label>                    
                        <select id="produto_servico" class="form-control" name="item_venda['produto_id_produto']">
                            <option value="Selecione">Selecione...</option>
                        <?php
                            if ($lista_produtos) {
                                foreach ($lista_produtos as $produto_encerramento) : ?>
                                    <option value="<?php echo $produto_encerramento['id_produto']; ?>"><?php echo $produto_encerramento['descricao_produto']; ?></option>                                
                        <?php   endforeach; ?>
                        <?php } ?>
                        </select>                    
                    </div>
                    <div class="form-group col-md-3">
                        <label>Valor Unitário</label> 
                        <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" disabled />
                    </div> 
                    <div class="form-group col-md-3">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="item_venda['quantidade_total']" onblur="somaProduto();" />
                    </div>

                    <div class="clearfix"></div>
                    
                    <div class="form-group col-md-3 pull-right">
                        <label>Subtotal</label> 
                        <input type="text" class="form-control" id="valor_total" name="item_venda['valor_total']" />
                    </div> 
                    
                    <input type="hidden" id="venda_id_venda" class="form-control" value="<?php echo $fechar_agenda[0]['id_venda']; ?>" name="item_venda['venda_id_venda']" />
                    
                    <div class="clearfix"></div>                                        

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="button" id="gravar_produto" class="btn btn-primary">Gravar</button>
                </div>
            </form>
        </div>        
    </div>    
</div>

<!-- MODAL DE INSERÇÃO DE SERVIÇOS -->
<div class="modal fade" id="modal-cad-servicos">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="venda_cadastro.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Serviços</h4>
                </div>
                <div class="modal-body">                                

                    <div class="form-group col-md-6">
                        <label for="tipo" id="lbl_servico">Serviço</label>                    
                        <select id="servico_venda" class="form-control" name="item_venda['servico_id_servico']">
                            <option value="Selecione">Selecione...</option>
                        <?php
                            if ($lista_servicos) {
                                foreach ($lista_servicos as $servico_venda) : ?>
                                    <option value="<?php echo $servico_venda['id_servico']; ?>"><?php echo $servico_venda['descricao_servico']; ?></option>                                
                        <?php   endforeach; ?>
                        <?php } ?>
                        </select>                    
                    </div>

                    <div class="form-group col-md-3">
                        <label>Valor</label>                     
                        <input type="text" class="form-control" id="valor_servico" name="item_venda['valor_total']" />                       
                    </div> 

                    <div class="form-group col-md-3">
                        <label>Tempo estimado</label>
                        <input type="text" class="form-control" id="tempo_estimado" name="tempo_estimado" />
                    </div>               
                    
                    <input type="hidden" id="venda_id_venda" class="form-control" value="<?php echo $fechar_agenda[0]['id_venda']; ?>" name="item_venda['venda_id_venda']" />

                    <div class="clearfix"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="button" id="gravar_servico" class="btn btn-primary">Gravar</button>
                </div>
            </form>
        </div>        
    </div>    
</div>

<!--  MODAL DELETE -->
<div class="modal fade" id="delete-modal-item-venda" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
            </div>
            <div class="modal-body">
                Deseja realmente excluir este item?
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-primary" href="#">Sim</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">Não</a>
            </div>
        </div>
    </div>
</div>

<!-- FECHAMENTO VENDA -->
<div class="modal fade" id="modal-cad-venda">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="venda_cadastro.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Recebimento</h4>
                </div>
                <div class="modal-body">                    
                    <div class="form-group col-md-4">
                        <label for="tipo">Forma de pagamento</label>                    
                        <select id="forma_pagamento" class="form-control" name="forma_pagamento" onchange="forma(this.value);">
                            <option value="D">Dinheiro</option>
                            <option value="C">Cheque</option>
                            <option value="CC">Cartão Crédito</option>
                            <option value="CD">Cartão Débito</option>
                        </select>                    
                    </div>

                    <div class="form-group col-md-4">
                        <label for="tipo">Condição</label>                    
                        <select id="prazo" class="form-control" name="prazo" onblur="condicao_pagamento(this.value);" >
                            <option value="V">À vista</option>
                            <option value="P">Prazo</option>
                        </select>                    
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tipo" id="lbl_parcelas">Parcelas</label>                    
                        <select id="parcelas" class="form-control" name="parcelas" disabled onchange="calcula_parcela();">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>                        
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>                    
                    </div>

                    <div class="clearfix"></div>                                

                    <div class="form-group col-md-3">
                        <label>Valor Pago</label>
                        <input type="text" class="form-control" id='valor_pago' name="valor_pago" onblur="calcula_parcela();" onfocus="if((this.value == document.getElementById('total_venda_receber').value) && (document.getElementById('prazo').value == 'P')) {this.value = '';}" />
                    </div>

                    <div class="form-group col-md-3">
                        <label>Restante</label>
                        <input type="text" class="form-control" id='valor_restante' name="valor_restante" disabled />
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label id="lbl_valor_parcela"></label>
                        <label id="valor_parcela"></label>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-md-3 pull-right">
                        <label>Total a receber</label>
                        <input type="text" class="form-control" id='total_venda_receber' name="total_venda_receber" />
                    </div>                

                    <div class="clearfix"></div>
                    <input type="hidden" id="id_cliente" name="cliente_id_cliente" value="<?php echo $fechar_agenda[0]['id_cliente']; ?>" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="button" id='fechamento_venda' class="btn btn-primary" >Gravar</button>
                </div>
            </form>
        </div>        
    </div>    
</div>
<?php require_once (FOOTER_TEMPLATE); ?>

<script>
    atualizar_valor_total();
    var total_venda_receber = document.getElementById("total_venda_receber").value;
    document.getElementById("valor_pago").value = total_venda_receber;
</script>

<script>                        
    $(document).ready(function () {
        $('#produto_servico').change(function(e) {
           $('#valor_unitario').empty();
           var id = $(this).val();
           $.post('../../dao/carrega_preco_venda_dao.php', {vlrid:id}, function(data) {
              var inp =  '<option value="">Valor produto</option>';
              $.each(data, function(index, value) {
                  inp = value.valor;
                  document.getElementById('valor_unitario').value = inp;
              });
              $('#valor_unitario').html(inp); 
           }, 'json');
        });
    });
</script>

<script>                        
    $(document).ready(function () {
        $('#servico_venda').change(function(e) {
           $('#valor_servico').empty();
           $('#tempo_estimado').empty();
           var id = $(this).val();
           $.post('../../dao/carrega_preco_servico_dao_.php', {idser:id}, function(data) {
              var inp =  '<option value="">Valor serviço</option>';
              var tem =  '<input type="text" class="form-control" id="tempo_estimado" name="tempo_estimado" />';
              $.each(data, function(index, value) {
                  inp = value.valor_servico;
                  tem = value.duracao_aproximada;         
                  document.getElementById('valor_servico').value = inp;
                  document.getElementById('tempo_estimado').value = tem;
              });
              $('#valor_servico').html(inp);
              $('#tempo_estimado').html(tem);
           }, 'json');
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#gravar_produto').on('click',function(e) {
            $('#itens_venda').empty();
            item_venda = [];
            item_venda[0] = document.getElementById('venda_id_venda').value;
            item_venda[1] = document.getElementById('produto_servico').value;            
            item_venda[2] = document.getElementById('quantidade').value;            
            item_venda[3] = document.getElementById('valor_total').value;            
            
            var id = document.getElementById('venda_id_venda').value;
            $.post('../../dao/add_item_venda_dao.php', {item_venda:item_venda}, function(dados){
                var total = 0;
                console.log(dados);
                for(var i=0;dados.length>i;i++){
                    //Adicionando registros retornados na tabela
                    $('#itens_venda').append('<tr><td>'+dados[i].id_item_venda+'</td><td>'+dados[i].descricao_produto+'</td><td>'+dados[i].descricao_servico+'</td><td>'+dados[i].quantidade_total+'</td><td>'+dados[i].valor_total+'</td><td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-item-venda" data-delete="<?php echo $itens['id_item_venda']; ?>"><i class="fa fa-trash"></i></a></td></tr>');
                    var totalVenda = (total + dados[i].valor_total);
                    console.log(totalVenda);
                };
                atualizar_valor_total();
            }, 'json');
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#gravar_servico').on('click',function(e) {
            $('#itens_venda').empty();
            item_venda = [];
            item_venda[0] = document.getElementById('venda_id_venda').value;                                    
            item_venda[1] = document.getElementById('valor_servico').value;
            item_venda[2] = document.getElementById('servico_venda').value;
            
            console.log(item_venda);
            
            var id = document.getElementById('venda_id_venda').value;
            $.post('../../dao/add_item_venda_servico_dao.php', {item_venda:item_venda}, function(dados){                
                console.log(dados);
                for(var i=0;dados.length>i;i++){
                    //Adicionando registros retornados na tabela
                    $('#itens_venda').append('<tr><td>'+dados[i].id_item_venda+'</td><td>'+dados[i].descricao_produto+'</td><td>'+dados[i].descricao_servico+'</td><td>'+dados[i].quantidade_total+'</td><td>'+dados[i].valor_total+'</td><td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-item-venda" data-delete="<?php echo $itens['id_item_venda']; ?>"><i class="fa fa-trash"></i></a></td></tr>');                                       
                };
                atualizar_valor_total();
            }, 'json');
        });
    });       
</script>

<script>
$(document).ready(function () {
    var situacao = '';
    $('#fechamento_venda').on('click',function(e) {
        venda = [];
        venda[0] = document.getElementById('venda_id_venda').value;
        venda[1] = document.getElementById('prazo').value;
        venda[2] = document.getElementById('parcelas').value;;
        venda[3] = document.getElementById('forma_pagamento').value;;
        venda[4] = document.getElementById('total_venda_receber').value;
        venda[5] = document.getElementById('valor_pago').value;
        venda[6] = document.getElementById('valor_restante').value;
        venda[7] = document.getElementById('id_cliente').value;

        $.post('../../dao/fechamento_venda_dao.php', {venda:venda}, function(venda_dados) {
            //SETAR disabled="true" PARA BOTÃO DE RECEBER - PRODUTOS - SERVIÇOS, CASO A VENDA SEJA SITUAÇÃO = F;
            console.log(venda_dados);

            alert('Venda finalizada com sucesso!!!');
            $('#modal-cad-venda').modal('hide');
            document.getElementById("btn_recebimento").setAttribute("disabled", true);
            document.getElementById("btn_produto").setAttribute("disabled", true);
            document.getElementById("btn_servico").setAttribute("disabled", true);
        });
    });
});
</script>