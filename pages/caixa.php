<?php require_once ('../config.php'); ?>
<?php require_once ('../valida_cookie.php');?>

<?php
    require_once ('../dao/caixa_dao.php');
    add_caixa();
    profissional_caixa();
    listar_caixa_ativo();

    $caixa_ativo = listar_caixa_ativo();

    $_SESSION['id_caixa'] = $caixa_ativo[0]['id_caixa'];

    $situacao_caixa = $caixa_ativo[0]['situacao'];

    $data_abertura = $caixa_ativo[0]['data_hora_criacao'];
    
    if ($data_abertura != null) {
        $data = explode(" ", $data_abertura);
        $datai = explode("-", $data[0]);

        $dia = $datai[0];
        $mes = $datai[1];
        $ano = $datai[2];    
        
        $data_abertura_caixa = $ano.'-'.$mes.'-'.$dia;
    }    
    

    total_sangria();
    total_reforco();
    total_vale();
    
    //CALCULO DO SALDO ATUAL DO CAIXA
    $saldo_inicial = $caixa_ativo[0]['valor_inicial'];
    $valor_sangria = $sangria[0]['total_retirada'];
    $valor_reforco = $reforco[0]['total_reforco'];
    $valor_vale = $vale[0]['total_vale'];
    
    $saldo_atual_gaveta = ($saldo_inicial - $valor_sangria + $valor_reforco - $valor_vale);
    
?>
 <?php include HEADER_TEMPLATE; ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body pad table-responsive">
                <?php if (!isset($situacao_caixa)) { ?>
                        <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#modal-default">Abrir Caixa</button>
                        <button type="button" class="btn btn-block btn-danger btn-lg" data-toggle="modal" data-target="#modal-close" disabled="true">Fechar Caixa</button>
                <?php } elseif (isset($situacao_caixa) && $situacao_caixa === 'A') { ?>
                        <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#modal-default" disabled="true">Abrir Caixa</button>
                        <button type="button" class="btn btn-block btn-danger btn-lg" data-toggle="modal" data-target="#modal-close">Fechar Caixa</button>
                <?php } ?>
            </div>
          </div>
        </div>

        <!--MODAL ABRIR CAIXA-->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="caixa.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Abrir caixa</h4>
                        </div>
                        <div class="modal-body">
                            <label for="caixa">Informe o valor inicial da gaveta (R$)</label>
                            <input type="text" name="caixa['valor_inicial']" class="form-control input_number" id="valor_inicial_caixa" />
                            <input type="hidden" name="caixa['data_hora_criacao']" value="<?php echo strftime('%Y-%m-%d %H:%M:%S', strtotime('now, GMT +0300')); ?>" />
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--MODAL FECHAR CAIXA-->
        <div class="modal fade" id="modal-close">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="../dao/fechamento_caixa_dao.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Fechar caixa aberto em <?php echo $data_abertura_caixa; ?></h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="caixa_id_caixa" value="<?php echo $caixa_ativo[0]['id_caixa']; ?>" />
                            <input type="hidden" name="data_fechamento_caixa" value="<?php echo strftime('%Y-%m-%d %H:%M:%S', strtotime('now, GMT +0300')); ?>" />
                            <input type="hidden" id="valor_fechamento" name="valor_fechamento" value="<?php echo $saldo_atual_gaveta; ?>" />
                            <h5>Saldo no momento do fechamento é de R$ <?php echo number_format($saldo_atual_gaveta, 2, ',', '.'); ?></h5>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if ($caixa_ativo != null) { ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body pad table-responsive">
                            <h5 class="label-primary col-sm-offset-9">Gaveta aberta em <?php echo $data_abertura_caixa; ?> - Saldo inicial: R$ <?php echo $caixa_ativo[0]['valor_inicial']; ?></h5> 
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#sangria" data-toggle="tab">Sangria</a></li>
                                    <li><a href="#reforco" data-toggle="tab">Reforço</a></li>
                                    <li><a href="#vale" data-toggle="tab">Vale</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!--SANGRIA -->
                                    <div class="active tab-pane" id="sangria">
                                        <h4 class="col-sm-offset-0 control-label">Sangria/Retirada</h4>
                                        <form class="form-horizontal" method="POST" action="../dao/caixa_sangria_dao.php">
                                            <input type="hidden" class="form-control" name="caixa_id_caixa" value="<?php echo $caixa_ativo[0]['id_caixa']; ?>" /> 
                                            <input type="hidden" name="data_inclusao_sangria" value="<?php echo strftime( '%Y-%m-%d %H:%M:%S', strtotime('now') ); ?>" />
                                            <div class="form-group">
                                                <label for="tipo" class="col-sm-1 control-label">Tipo</label>
                                                <div class="col-sm-3">
                                                    <select id="tipo_sangria" class="form-control" name="tipo_sangria">
                                                        <option value="D">Dinheiro</option>
                                                        <option value="C">Cheque</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valor" class="col-sm-1 control-label">Valor (R$)</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="valor_sangria" id="valor_sangria" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="observacao" class="col-sm-1 control-label">Observação</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" rows="3" name="observacao_sangria" placeholder="Digite aqui ..."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-1 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                </div>
                                            </div>
                                        </form>

                                        <h3>Total sangria/retirada: R$ <?php echo number_format($sangria[0]['total_retirada'], 2, ',', '.');  ?> </h3>
                                    </div>

                                    <!--REFORÇO -->
                                    <div class="tab-pane" id="reforco">
                                        <h4 class="col-sm-offset-0 control-label">Reforço/Depósito</h4>
                                        <form class="form-horizontal" method="POST" action="../dao/caixa_reforco_dao.php">
                                            <input type="hidden" class="form-control" name="caixa_id_caixa" value="<?php echo $caixa_ativo[0]['id_caixa']; ?>" /> 
                                            <input type="hidden" name="data_inclusao_reforco" value="<?php echo strftime( '%Y-%m-%d %H:%M:%S', strtotime('now') ); ?>" />
                                            <div class="form-group">
                                                <label for="valor_reforco" class="col-sm-1 control-label">Valor (R$)</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="valor_reforco" id="valor_reforco" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="observacao" class="col-sm-1 control-label">Observação</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" rows="3" name="observacao_reforco" placeholder="Digite aqui ..."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-1 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                </div>
                                            </div>
                                        </form>

                                        <h3>Total reforço/depósito: R$ <?php echo number_format($reforco[0]['total_reforco'], 2, ',', '.');  ?></h3>
                                    </div>

                                    <!--VALE -->
                                    <div class="tab-pane" id="vale">
                                        <h4 class="col-sm-offset-0 control-label">Vale/Adiantamento</h4>
                                        <form class="form-horizontal" method="POST" action="../dao/caixa_vale_dao.php">                                    
                                            <input type="hidden" class="form-control" name="caixa_id_caixa" value="<?php echo $caixa_ativo[0]['id_caixa']; ?>" /> 
                                            <input type="hidden" class="form-control" name="data_inclusao_vale" value="<?php echo strftime( '%Y-%m-%d %H:%M:%S', strtotime('now') ); ?>" />

                                            <div class="form-group">
                                                <label for="tipo" class="col-sm-1 control-label">Tipo</label>
                                                <div class="col-sm-3">
                                                    <select id="tipo_sangria" class="form-control" name="tipo_vale">
                                                        <option value="D">Dinheiro</option>
                                                        <option value="C">Cheque</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="profissional" class="col-sm-1 control-label">Profissional</label>
                                                <div class="col-sm-3">
                                                    <select id="profissional" class="form-control" name="profissional_id_profissional">
                                                        <option value="">Selecione...</option>
                                                        <?php
                                                            if ($profissionais) {
                                                                foreach ($profissionais as $profissional_caixa) : ?>
                                                                    <option value="<?php echo $profissional_caixa['id_profissional'] ?>"><?php echo $profissional_caixa['nome'] ?></option>
                                                        <?php   endforeach;
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valor" class="col-sm-1 control-label">Valor (R$)</label>
                                                <div class="col-sm-2">
                                                    <input type="text" id="valor_vale" class="form-control" name="valor_vale" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="observacao" class="col-sm-1 control-label">Observação</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" rows="3" name="observacao_vale" placeholder="Digite aqui ..."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-1 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                </div>
                                            </div>
                                        </form>

                                        <h3>Total vale/adiantamento: R$ <?php echo number_format($vale[0]['total_vale'], 2, ',', '.');  ?></h3>
                                    </div>
                                </div>                                               
                            </div>                    
                            <h4 class="pull-right hidden-xs"><b><a target="_blank" href="relatorios/extrato_caixa.php">Extrato caixa atual</a></b></h4>
                        </div>                
                    </div>
                    <h3 class="label-default col-sm-offset-10">Saldo: R$ <?php echo number_format($saldo_atual_gaveta, 2, ',', '.'); ?></h3> 
                </div>
        <?php } ?>
    </div>
</section>
<?php include FOOTER_TEMPLATE; ?>
