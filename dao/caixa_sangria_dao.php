<?php
    require_once ('../config.php');
    include 'padrao_dao.php'; 
    
    if (!empty($_POST['valor_sangria']) || !empty($_POST['caixa_id_caixa'])) {
        $dados['tipo_sangria'] = $_POST['tipo_sangria'];
        $dados['caixa_id_caixa'] = $_POST['caixa_id_caixa'];
        $dados['valor_sangria'] = $_POST['valor_sangria'];
        $dados['observacao_sangria'] = $_POST['observacao_sangria'];
        $dados['data_inclusao_sangria'] = $_POST['data_inclusao_sangria'];

        insert('caixa_sangria', $dados);        
        header('location:'.BASEURL.'pages/caixa.php'); 
    }                
?>