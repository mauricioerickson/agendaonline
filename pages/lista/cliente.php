<?php require_once ('../../config.php'); ?>
<?php require_once ('../../valida_cookie.php');?>

<?php
    $_SESSION['tipo'] = 'cliente';

    require_once ('../../dao/cliente_dao.php');
    clientes();
?>
<?php include(HEADER_TEMPLATE); ?>

<section class="content">
    <div class="row">           
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Clientes</h2>
                    <a class="btn btn-default pull-right" alt="Atualizar" href="cliente.php"><i class="fa fa-refresh"></i></a>
                    <a class="btn btn-primary pull-right" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_cliente.php"><i class="fa fa-plus"></i></a>
                </div>

                <div class="clearfix"></div>

                <div class="box-body">
                    <table id="cliente" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="8%">Id</th>
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>Situação</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($clientes) {
                                foreach ($clientes as $cliente) :
                                    ?>
                                    <tr>
                                        <td><?php echo $cliente['id_pessoa']; ?></td>
                                        <td><?php echo $cliente['nome']; ?></td>
                                        <td><?php echo $cliente['nome_apelido']; ?></td>
                                        <td><?php echo $cliente['email']; ?></td>
                                        <td><?php echo $cliente['telefone']; ?></td>
                                        <td><?php echo $cliente['celular']; ?></td>
                                        <td><?php echo $cliente['situacao']; ?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASEURL ?>pages/cadastros/edit_cliente.php?id=<?php echo $cliente['id_pessoa'] ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Editar</a>
<!--                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo $_SESSION['tipo']; ?>" data-delete="<?php echo $cliente['id_pessoa']; ?>">
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