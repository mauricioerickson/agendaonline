<?php
    if (!isset($_SESSION)) {
            session_start();
        }
?>
<?php
    $_SESSION['tipo'] = 'profissional';

    require_once ('../../config.php');
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/profissional_dao.php');
    cidades();
    add_profissional();
        
?>
<?php include (ADD_TEMPLATE); ?>

<!--Aqui colocar o metodo para gravar o id_pessoa na tabela de cliente.-->
</div>
<div class="box-footer">
    <button type="button" class="btn btn-primary" onclick="valida_campos();">Salvar</button>
</div>
</form>
<!--</div>-->            
</div>
</div>
</section>

<?php include FOOTER_TEMPLATE; ?>