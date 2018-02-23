<?php
    require_once ('../config.php');
    include 'padrao_dao.php'; 
        
    if (!empty($_POST['valor_reforco']) || !empty($_POST['caixa_id_caixa'])) {            
        $dados['caixa_id_caixa'] = $_POST['caixa_id_caixa'];            
        $dados['valor_reforco'] = $_POST['valor_reforco'];
        $dados['observacao_reforco'] = $_POST['observacao_reforco'];
        $dados['data_inclusao_reforco'] = $_POST['data_inclusao_reforco'];

        insert('caixa_reforco', $dados);        
        header('location:'.BASEURL.'pages/caixa.php'); 
    }
?>