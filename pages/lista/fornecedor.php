<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php');?>


<?php
    $_SESSION['tipo'] = 'fornecedor';
    
    require_once ('../../dao/fornecedor_dao.php');
    fornecedores();
?>
<?php include(HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Fornecedores</h2>                
                    <a class="btn btn-default pull-right" alt="Atualizar" href="fornecedor.php"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-primary pull-right" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_fornecedor.php"><i class="fa fa-plus"></i></a>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="box-body">
                    <table id="cliente" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Id</th>
                                <th>Nome</th>
                                <th>Contato</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>Situação</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if ($fornecedores) {
                                    foreach ($fornecedores as $fornecedor) : ?>
                                        <tr>
                                            <td><?php echo $fornecedor['id_pessoa']; ?></td>
                                            <td><?php echo $fornecedor['nome']; ?></td>
                                            <td><?php echo $fornecedor['nome_apelido']; ?></td>
                                            <td><?php echo $fornecedor['email']; ?></td>
                                            <td><?php echo $fornecedor['telefone']; ?></td>
                                            <td><?php echo $fornecedor['celular']; ?></td>
                                            <td><?php echo $fornecedor['situacao']; ?></td>
                                            <td class="actions text-center">
                                                <a href="<?php echo BASEURL ?>pages/cadastros/edit_fornecedor.php?id=<?php echo $fornecedor['id_pessoa'] ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Editar</a>
<!--                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_SESSION['tipo']; ?>" data-delete="<?php echo $fornecedor['id_pessoa']; ?>">
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
<?php include(DELETE_TEMPLATE); ?>
<?php include(FOOTER_TEMPLATE); ?>