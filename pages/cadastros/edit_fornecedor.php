<?php
    if (!isset($_SESSION)) {
            session_start();
        }
?><?php
    $_SESSION['tipo'] = 'fornecedor';
    
    require_once ('../../config.php');
    require_once ('../../valida_cookie.php');
    require_once ('../../dao/fornecedor_dao.php');
    cidades();
    edit_fornecedor();
?>
<?php include (EDIT_TEMPLATE); ?>


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

