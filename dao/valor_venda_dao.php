<?php       
    require_once ('../config.php');    
    
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
        include 'padrao_dao.php';
        $database = open_database();
        
        $vlrid = filter_input(INPUT_POST, 'vlrid', FILTER_SANITIZE_NUMBER_INT);
        if ($vlrid){
            try {
                $sql = 'select sum(valor_total) as valor_total from item_venda where venda_id_venda = '.$vlrid. ' group by venda_id_venda';

                $result = $database->query($sql);

                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $found[] = $linha;
                    }
                }
            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }
            
            $json = json_encode($found);
            echo $json;         
            return;
        }       
    }
    echo NULL;
?>