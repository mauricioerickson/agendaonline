<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php');?>


<?php 
    $_SESSION['tipo'] = 'tipo_servico';
    
    require_once ('../../dao/tipo_servico_dao.php');
    tipo_servico();
?>

<?php include (HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">           
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Tipos de Serviços</h2>
                    <a class="btn btn-default pull-right" alt="Atualizar" href="tipo_servico.php"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-primary pull-right" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_tipo_servico.php"><i class="fa fa-plus"></i></a>
                </div>

                <div class="clearfix"></div>

                <div class="box-body">
                    <table id="cliente" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Id</th>
                                <th>Tipo Serviço</th>                                
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($tipo_servicos) {
                                foreach ($tipo_servicos as $tipo_servico) :
                                    ?>
                                    <tr>
                                        <td><?php echo $tipo_servico['id_tipo_servico']; ?></td>
                                        <td><?php echo $tipo_servico['descricao_tipo_servico']; ?></td>                                                                              
                                        <td class="actions text-center">                                            
<!--                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_SESSION['tipo']; ?>" data-delete="<?php echo $tipo_servico['id_tipo_servico']; ?>">
                                                <i class="fa fa-trash"></i> Excluir
                                            </a>-->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="2">Nenhum registro encontrado!</td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include (DELETE_TEMPLATE); ?>
<?php include (FOOTER_TEMPLATE); ?>