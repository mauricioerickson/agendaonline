<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php');?>


<?php 
    $_SESSION['tipo'] = 'produto';
    
    require_once ('../../dao/produto_dao.php');
    produtos();
?>

<?php include (HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">           
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Produtos</h2>
                    <a class="btn btn-default pull-right" alt="Atualizar" href="produto.php"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-primary pull-right" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_produto.php"><i class="fa fa-plus"></i></a>
                </div>

                <div class="clearfix"></div>

                <div class="box-body">
                    <table id="cliente" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Id</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Situação</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($produtos) {
                                foreach ($produtos as $produto) :
                                    ?>
                                    <tr>
                                        <td><?php echo $produto['id_produto']; ?></td>
                                        <td><?php echo $produto['descricao_produto']; ?></td>
                                        <td>R$ <?php echo number_format($produto['valor'], 2, '.', ','); ?></td>
                                        <td><?php echo $produto['situacao']; ?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASEURL ?>pages/cadastros/edit_produto.php?id=<?php echo $produto['id_produto'] ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Editar</a>
<!--                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_SESSION['tipo']; ?>" data-delete="<?php echo $produto['id_produto']; ?>">
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