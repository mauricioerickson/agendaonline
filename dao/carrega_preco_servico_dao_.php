<?php       
    require_once ('../config.php');    
    
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
        include 'padrao_dao.php';
        $database = open_database();
        
        $idser = filter_input(INPUT_POST, 'idser', FILTER_SANITIZE_NUMBER_INT);
        if ($idser){
            try {
                $sql = "select id_servico, valor_servico, duracao_aproximada from servico where situacao = 'A' and id_servico = ".$idser;

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