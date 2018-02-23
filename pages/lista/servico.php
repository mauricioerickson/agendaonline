<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php');?>


<?php 
    $_SESSION['tipo'] = 'servico';
    
    require_once ('../../dao/servico_dao.php');
    servicos();
?>

<?php include (HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">           
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Serviços</h2>
                    <a class="btn btn-default pull-right" alt="Atualizar" href="servico.php"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-primary pull-right" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_servico.php"><i class="fa fa-plus"></i></a>
                </div>

                <div class="clearfix"></div>

                <div class="box-body">
                    <table id="cliente" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Id</th>
                                <th>Serviço</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Duração</th>                                
                                <th>Situação</th>                                
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($servicos) {
                                foreach ($servicos as $servico) :
                                    ?>
                                    <tr>
                                        <td><?php echo $servico['id_servico']; ?></td>
                                        <td><?php echo $servico['descricao_servico']; ?></td>
                                        <td><?php echo $servico['descricao_tipo_servico']; ?></td>                                                                                                                        
                                        <td>R$ <?php echo $servico['valor_servico']; ?></td>
                                        <td><?php echo $servico['duracao_aproximada']; ?></td>
                                        <td><?php echo $servico['situacao']; ?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASEURL ?>pages/cadastros/edit_servico.php?id=<?php echo $servico['id_servico'] ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Editar</a>
<!--                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_SESSION['tipo']; ?>" data-delete="<?php echo $servico['id_servico']; ?>">
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