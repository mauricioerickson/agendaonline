<?php require_once ('../../config.php'); ?> 
<?php
    if (!isset($_SESSION)) {
            session_start();
        }
?>

<?php 
    $_SESSION['tipo'] = 'produto'; 
    
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/produto_dao.php');
    add();
?>
<?php include HEADER_TEMPLATE; ?>

<section class="content-header">
    <h1>Cadastro de <?php
        if ($_SESSION['tipo'] === 'produto') {
            echo 'produtos';
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
                        <label for="name">Descrição produto</label>
                        <input type="text" class="form-control" name="produto['descricao_produto']" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Preço (R$)</label>
                        <input type="text" class="form-control" name="produto['valor']" id="preco" />
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