<?php 
    require_once ('../../config.php'); 

    if (!isset($_SESSION)) {
            session_start();
        }

    $_SESSION['tipo'] = 'servico'; 
?>
<?php
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/servico_dao.php');
    edit();
    lista_tipo_servicos();    
?>
<?php include HEADER_TEMPLATE; ?>

<section class="content-header">
    <h1>Cadastro de <?php
        if ($_SESSION['tipo'] === 'servico') {
            echo 'serviços';
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
                        <label for="name">Descrição serviço</label>
                        <input type="text" class="form-control" name="servico['descricao_servico']" value="<?php echo $servico['0']['descricao_servico']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Duração aproximada</label>
                        <input type="text" id="tempo" class="form-control" name="servico['duracao_aproximada']" placeholder="Informe em minutos 00.00" value="<?php echo $servico['0']['duracao_aproximada']; ?>" />
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="name" id="lbl_situacao">Situação</label>
                        <select id='situacao' class="form-control" name="servico['situacao']" value="<?php echo $servico['0']['situacao']; ?>" onchange="altera_situacao(this.value);">
                            <?php if ($servico['0']['situacao'] === 'A') { ?>
                                <option value="<?php echo $servico['0']['situacao'] ?>">ATIVO</option>
                            <?php } else { ?>                                
                                    <option value="<?php echo $servico['0']['situacao'] ?>">INATIVO</option>
                            <?php } ?>
                            <option value="A">ATIVO</option>
                            <option value="I">INATIVO</option>
                        </select>
                    </div>

                    <div class="clearfix"></div>
                    
                    <div class="form-group col-md-3">
                        <label for="name">Valor serviço R$</label>
                        <input type="text" id="valor_servico" class="form-control" name="servico['valor_servico']" value="<?php echo $servico['0']['valor_servico']; ?>" />
                    </div>
                    
                    <?php
                        $tipo_servico_id_servico = find('tipo_servico', 'id_tipo_servico', $servico['0']['tipo_servico_id_tipo_servico']);
                    ?>

                    <div class="form-group col-md-5">
                        <label for="name">Tipo serviço</label>
                        <div class="input-group">
                            <select id='tipo_servico' class="form-control" name="servico['tipo_servico_id_tipo_servico']" >
                                <?php
                                if ($tipo_servico_id_servico) {
                                    foreach ($tipo_servico_id_servico as $tipo_servico_edit) : ?>
                                        <option value="<?php echo $tipo_servico_edit['id_tipo_servico']; ?>"><?php echo $tipo_servico_edit['descricao_tipo_servico']; ?></option>
                                <?php   endforeach;
                                    }
                                ?>
                                <?php
                                if ($tipo_servicos) {
                                    foreach ($tipo_servicos as $tipo_servico) :
                                        ?>
                                        <option value="<?php echo $tipo_servico['id_tipo_servico']; ?>"><?php echo $tipo_servico['descricao_tipo_servico']; ?></option>
                                    <?php
                                    endforeach;
                                }
                                ?>
                            </select>
                            <div class="input-group-btn">
                                <a class="btn btn-primary" alt="Adicionar" href="<?php echo BASEURL ?>pages/cadastros/add_tipo_servico.php"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
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