<?php  
    require_once ('./config.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    require_once (HEADER_TEMPLATE);
   
    require_once (FOOTER_TEMPLATE);
?>