<?php
    require_once ('../config.php');
    include 'padrao_dao.php';        

    if (!empty($_POST['caixa_id_caixa']) || !empty($_POST['valor_vale'])) {
        $dados['caixa_id_caixa'] = $_POST['caixa_id_caixa'];
        $dados['tipo_vale'] = $_POST['tipo_vale'];
        $dados['profissional_id_profissional'] = $_POST['profissional_id_profissional'];
        $dados['valor_vale'] = $_POST['valor_vale'];
        $dados['observacao_vale'] = $_POST['observacao_vale'];
        $dados['data_inclusao_vale'] = $_POST['data_inclusao_vale'];

        insert('caixa_vale', $dados);        
        header('location:'.BASEURL.'pages/caixa.php');      
    }
?>