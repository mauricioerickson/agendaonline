<?php
    require_once ('../config.php');
    include 'padrao_dao.php';
    
    $database = open_database();
    
    if (isset($_POST['caixa_id_caixa']) && isset($_POST['data_fechamento_caixa']) && isset($_POST['valor_fechamento'])) {
        $id_caixa = $_POST['caixa_id_caixa'];
        $data_fechamento_caixa = $_POST['data_fechamento_caixa'];
        $valor_fechamento = $_POST['valor_fechamento'];
        
        try {
            $sql = "UPDATE caixa SET situacao = 'F', data_fechamento_caixa = '$data_fechamento_caixa', valor_fechamento = '$valor_fechamento' WHERE id_caixa = $id_caixa";
            $result = $database->query($sql);
            header('location:'.BASEURL.'pages/caixa.php');
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
?>
