<?php 
/*
 * ENUM SITUACAO CONTAS A RECEBER
 * A - EM ABERTO
 * F - FECHADA (QUITADA)
 */
    require_once ('../config.php');    
    
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
        include 'padrao_dao.php';
        $database = open_database();
        
        $venda = null;
        $contas_receber = null;
        $vlr_parcela = 0;
        
        $vlrid = $_POST[venda][0];
        $venda['prazo'] = $_POST[venda][1];
        $venda['parcelas'] = $_POST[venda][2];
        $venda['forma_pagamento'] = $_POST[venda][3];
        $venda['valor_total'] = $_POST[venda][4];
        
        
        $contas_receber['venda_id_venda'] = $vlrid;
        $contas_receber['valor_pago'] = $_POST[venda][5];
        $contas_receber['valor_restante'] = $_POST[venda][6];
        $contas_receber['cliente_id_cliente'] = $_POST[venda][7];
        $contas_receber['data_criacao'] = strftime('%Y-%m-%d %H:%M:%S', strtotime('now, GMT +0300'));
                
        
        if ($venda['parcelas'] > 1) {
            $parcelas = $venda['parcelas'];
            $total = $venda['valor_total'];
            $vlr_parcela = ($total/$parcelas);
            
            $contas_receber['valor_pago'] = 0;
            $contas_receber['valor_restante'] = $vlr_parcela;
        }        
        
        if ($contas_receber['valor_restante'] == 0) {
            $venda['situacao'] = 'F';
            $contas_receber['situacao'] = 'F';
        } else {
            $venda['situacao'] = 'F';
            $contas_receber['situacao'] = 'A';
        }

        if ($vlrid){
            update('venda', 'id_venda', $vlrid, $venda);
            
            if ($parcelas == 1 || $parcelas == 0) {
                insert('contas_receber', $contas_receber);
            } else {
                for ($i = 0; $i <= $parcelas; $i++) {
                    insert('contas_receber', $contas_receber);
                }
            }
            
            
            try {
                $sql = 'SELECT situacao FROM venda WHERE id_venda = '.$vlrid;
                $result = $database->query($sql);

                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $venda_dados[] = $linha;
                    }
                }
            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }
            close_database($database);
                      
            $json = json_encode($venda_dados);
            echo $json;         
            return;
        }       
    }
    echo NULL;
?>
