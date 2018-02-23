<?php
    if (!isset($_SESSION)) {
            session_start();
        }
?>
<?php require_once ('../../config.php'); ?> 

<?php 
    $_SESSION['tipo'] = 'produto'; 
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/produto_dao.php');
    edit();
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
            <form action="edit_<?php echo $_SESSION['tipo']; ?>.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="box-body">
                    <div class="form-group col-md-6">
                        <label for="name">Descrição produto</label>
                        <input type="text" class="form-control" name="produto['descricao_produto']" value="<?php echo $produto['0']['descricao_produto']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Preço (R$)</label>
                        <input type="text" class="form-control" id="preco" name="produto['valor']" value="<?php echo $produto['0']['valor']; ?>" />
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="name" id="lbl_situacao">Situação</label>
                        <select id='situacao' class="form-control" name="produto['situacao']" value="<?php echo $produto['0']['situacao']; ?>" onchange="altera_situacao(this.value);">
                            <?php if ($produto['0']['situacao'] === 'A') { ?>
                                <option value="<?php echo $produto['0']['situacao'] ?>">ATIVO</option>
                            <?php } else { ?>                                
                                    <option value="<?php echo $produto['0']['situacao'] ?>">INATIVO</option>
                            <?php } ?>
                            <option value="A">ATIVO</option>
                            <option value="I">INATIVO</option>
                        </select>
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