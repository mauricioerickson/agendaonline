<?php require_once ('../../config.php'); ?> 
<?php
    if (!isset($_SESSION)) {
            session_start();
        }
?>

<?php 
    $_SESSION['tipo'] = 'tipo_servico'; 
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/tipo_servico_dao.php');
    add();
?>
<?php include HEADER_TEMPLATE; ?>

<section class="content-header">
    <h1>Cadastro de <?php
        if ($_SESSION['tipo'] === 'tipo_servico') {
            echo 'tipos de serviços';
        }
        ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo BASEURL; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Cadastros</a></li>
        <li class="active"><?php echo $_SESSION['tipo']; ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!--<div class="col-md-12">-->
        <div class="box box-primary">
            <form action="add_<?php echo $_SESSION['tipo']; ?>.php" method="post">
                <div class="box-body">
                    <div class="form-group col-md-6">
                        <label for="name">Descrição tipo serviço</label>
                        <input type="text" class="form-control" name="tipo_servico['descricao_tipo_servico']" />
                    </div>                                                         
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            <!--</div>-->
        </div>
    </div>
</section>

<?php include FOOTER_TEMPLATE; ?>