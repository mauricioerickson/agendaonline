<?php require_once ('../config.php'); ?>
<?php require_once ('../valida_cookie.php');?>
<?php
    require_once ('../dao/agenda_dao.php');
    listagem();
    lista_clientes_agenda();
    lista_servicos_agenda();
    lista_profissionais();
    add_agenda();
    edit_delete();
    atualizar_data_hora();
?>

<?php include(HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title">Legenda</h4>                    
                    <hr />
                </div>
                <div class="box-body">
                    <table id="legenda_profissional" class="table table-hover cell-border">
                        <thead>
                            <tr>
                                <th>Cor</th>
                                <th>Profissional</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($lista_profissionais) {
                                foreach ($lista_profissionais as $lista_profissional) : ?>
                                    <tr>
                                        <td style="font-size: 14px;"><a style="color: <?php echo $lista_profissional['cor']; ?>" href="#"><i class="fa fa-square fa-2x"></i></a></td>
                                        <td style="font-size: 12px;"><?php echo $lista_profissional['nome']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } else { ?>
                                    <tr>
                                        <td colspan="2">Nenhum registro encontrado!</td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br/>
                    <br/>                                             
                </div>                
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="agenda.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Adicionar agenda</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-9">
                                <label for="cliente">Cliente</label>
                                <select class="form-control select2 select2-selection" name="agenda['cliente_id_cliente']"  multiple="multiple" id="select10" style="width: 100%;">
                                    <option value="">Escolha o cliente...</option>
                                <?php
                                    if ($clientes_agenda) {
                                        foreach ($clientes_agenda as $cliente) : ?>
                                            <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['id_cliente']; ?> - <?php echo $cliente['nome']; ?></option>
                                <?php   endforeach;
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="servico">Serviço</label>
                                <select name="agenda['servico_id_servico']" class="form-control select2" multiple="multiple" data-placeholder="Escolha o serviço" id="servico" style="width: 100%;">
                                    <option value="null">Escolha...</option>
                                    <?php
                                        if ($servicos_agenda) {
                                            foreach ($servicos_agenda as $servico) : ?>
                                                <option value="<?php echo $servico['id_servico']; ?>"><?php echo $servico['descricao_servico']; ?> - Duração: <?php echo $servico['duracao_aproximada']; ?></option>
                                    <?php   endforeach;
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-4">
                                <label for="duracao">Duração</label>
                                <input type="text" name="agenda['duracao']" class="form-control" id="duracao" value="<?php echo $servico['duracao_aproximada']; ?>" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>Cor agenda</label>
                                <select name="agenda['cor']" id="new_color" class="form-control">
                                    <option value="">Selecione a cor</option>
                                    <?php if ($lista_profissionais) {
                                            foreach ($lista_profissionais as $profissional1) : ?>                                                
                                                <option value="<?php echo $profissional1['cor']; ?>" style="color: <?php echo $profissional1['cor']; ?>">&#9724; <?php echo $profissional1['nome']; ?></option>
                                    <?php endforeach;
                                         }
                                    ?>
                                </select>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-9">
                                <label>Data/Hora Inicio - Fim</label>
                            </div>

                            <div class="form-group col-md-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="start" name="data_hora_inicio" />
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ate" class="control-label col-sm-2">Até</label>
                            </div>
                            <div class="form-group col-md-5">                              
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="end" name="data_hora_fim" />
                                </div>
                            </div> 

                            <div class="clearfix"></div>                                                       
                        </div>

                        <div class="clearfix"></div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- EDIÇÃO DE CADASTRO DA AGENDA -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="agenda.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar agenda</h4>
                        </div>                        
                        <div class="modal-body">
                            <div class="form-group col-md-9">
                                <label for="cliente">Cliente - Serviço</label>
                                <input type="text" class="form-control" id="cliente_agenda" name="cliente_id_cliente" disabled />
                            </div>                            

                            <div class="form-group col-md-9">
                                <label for="servico">Serviço</label>
                                <select name="servico_id_servico" class="form-control select2 select2-selection" multiple="multiple" data-placeholder="Escolha o serviço" id="servico" style="width: 100%;">
                                    <option value="null">Escolha...</option>
                                    <?php
                                        if ($servicos_agenda) {
                                            foreach ($servicos_agenda as $servico) : ?>
                                                <option value="<?php echo $servico['id_servico']; ?>"><?php echo $servico['descricao_servico']; ?></option>
                                    <?php   endforeach;
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-4">
                                <label for="duracao">Duração</label>
                                <input type="text" name="duracao" class="form-control" id="duracao" />&nbsp;&nbsp;
                            </div>

                            <div class="form-group col-md-8">
                                <label>Cor agenda</label>
                                <select name="cor" id="new_color" class="form-control">
                                    <option value="">Selecione a cor</option>
                                    <?php if ($lista_profissionais) {
                                            foreach ($lista_profissionais as $profissional1) : ?>
                                                <option value="<?php echo $profissional1['cor']; ?>" style="color: <?php echo $profissional1['cor']; ?>">&#9724; <?php echo $profissional1['nome']; ?></option>
                                    <?php endforeach;
                                         }
                                    ?>
                                </select>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-9">
                                <label>Data/Hora Inicio - Fim</label>
                            </div>

                            <div class="form-group col-md-5">                               
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="start" name="data_hora_inicio" />
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ate" class="control-label col-sm-2">Até</label>
                            </div>
                            <div class="form-group col-md-5">                              
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="end" name="data_hora_fim" />
                                </div>
                            </div> 

                            <div class="clearfix"></div>

                            <div class="form-group col-md-5">                              
                                <label class="text-danger">                                           
                                    <input type="checkbox" class="icheckbox_flat checkbox-inline" name="delete" />
                                    Cancelar Agenda
                                </label>                          
                            </div>

                            <div class="clearfix"></div>                           

                            <input type="hidden" name="id_agenda" class="form-control" id="id_agenda" />                                                                                 

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form> 
                    <div class="modal-footer">
                       <form class="form-horizontal" method="POST" action="vendas/venda_cadastro.php">
                            <input type="hidden" name="id_agenda" class="form-control" id="id_agenda" /> 
                            <button type="submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-usd"> Abrir venda</i></button>                        
                        </form>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</section>
</div>

<?php include(FOOTER_TEMPLATE); ?>

<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev, next, today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultView: 'agendaWeek',
            editable: true,
            eventLimit: true,
            selectable: true,
            selectHelper: true,
            select: function (start, end) {                
                $('#modalAdd #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
                $('#modalAdd #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
                $('#modalAdd').modal('show');
            },
            eventRender: function (agenda, element) {
                element.bind('dblclick', function () {                                                            
                    $('#modalEdit #id_agenda').val(agenda.id);                    
                    $('#modalEdit #cliente_agenda').val(agenda.title);                      
                    $('#modalEdit #new_color').val(agenda.color);
                    $('#modalEdit #start').val(moment(agenda.start).format('DD/MM/YYYY HH:mm:ss'));
                    $('#modalEdit #end').val(moment(agenda.end).format('DD/MM/YYYY HH:mm:ss'));
                    $('#modalEdit').modal('show');                       
                });
            },
            eventDrop: function (agenda, delta, revertFunc) {
                edit(agenda);
            },
            eventResize: function (agenda, dayDelta, minuteDelta, revertFunc) {                
                edit(agenda);
            },            
            events: [
            <?php
                if ($agendas) {
                    foreach ($agendas as $agenda) :                        
            ?>
                        {
                            id: '<?php echo $agenda['id_agenda']; ?>',
                            title: '<?php echo ($agenda['cliente']." - ".$agenda['descricao_servico']); ?>',
                            start: '<?php echo $agenda['data_hora_inicio']; ?>',
                            end: '<?php echo $agenda['data_hora_fim']; ?>',                            
                            color: '<?php echo $agenda['cor']; ?>',
                        },
            <?php
                    endforeach;
                }

            ?>
            ]
        });                

        function edit(agenda) {
            start = agenda.start.format('YYYY-MM-DD HH:mm:ss');
            if (agenda.end) {
                end = agenda.end.format('YYYY-MM-DD HH:mm:ss');
            } else {
                end = start;
            }

            id = agenda.id;            

            Agenda = [];
            Agenda[0] = id;
            Agenda[1] = start;
            Agenda[2] = end;

            $.ajax({
                url: '../dao/atualizar_data_hora_dao.php',
                type: 'POST',                
                data: {Agenda:Agenda},
                success: function(rep) {
                    if (rep == 'OK') {
                        alert('Agenda alterada!!!');
                    } else {
                        alert('Agenda não pôde ser alterada. Tente novamente');
                        console.log(rep);
                    }
                }
            });
        }
    });
</script>
