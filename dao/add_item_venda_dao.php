<?php
    require_once ('../config.php');    
    
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
        include 'padrao_dao.php';
        $database = open_database();
     
        $ok = '';
        
        $item_venda = null;
        $item_venda['venda_id_venda'] = $_POST['item_venda'][0];
        $item_venda['produto_id_produto'] = $_POST['item_venda'][1];
        $item_venda['quantidade_total'] = $_POST['item_venda'][2];
        $item_venda['valor_total'] = $_POST['item_venda'][3];        
        
        $idvenda = $item_venda['venda_id_venda'];
        
        
        try {
            if ($item_venda) {
                save('item_venda', $item_venda);
                $ok = 's';
            } else {
                $ok = 'n';
            }
            
            if ($ok == 's') {                
                $sql = "SELECT i.id_item_venda, if (i.quantidade_total>'', i.quantidade_total, '') as quantidade_total, i.valor_total, i.servico_id_servico, i.produto_id_produto, "
                            . "if (i.produto_id_produto>'', p.descricao_produto, '') as descricao_produto, "
                            . "if (i.servico_id_servico>'', s.descricao_servico, '') as descricao_servico "
                        . "FROM item_venda i "
                        . "LEFT JOIN produto p on p.id_produto = i.produto_id_produto "
                        . "LEFT JOIN servico s on s.id_servico = i.servico_id_servico "
                        . "WHERE venda_id_venda = ".$idvenda;
                $result = $database->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $dados[] = $linha;
                    }
                }
                
                echo json_encode($dados);
            }
            
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        
    }
?>