<?php

    ini_set('display_errors', 1);    
    
    function open_database() {    
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT) or die('Não foi possivel conectar com o server');

            return $conn;
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return null;
        }
    }

    function close_database($conn){
        try{
            mysqli_close($conn);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
?>