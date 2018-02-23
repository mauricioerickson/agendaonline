<?php
    require_once ('../config.php');
    include 'padrao_dao.php';
    
    
    $database = open_database();
        
    if (isset($_POST['Agenda'][0]) && isset($_POST['Agenda'][1]) && isset($_POST['Agenda'][2])) {
        $id_agenda = $_POST['Agenda'][0];
        $data_inicial = $_POST['Agenda'][1];
        $data_final = $_POST['Agenda'][2];                

        try {
            $sql = "UPDATE agenda SET data_hora_inicio = '$data_inicial', data_hora_fim = '$data_final' WHERE id_agenda = $id_agenda ";
            $result = $database->query($sql);
            die('OK');
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
?>