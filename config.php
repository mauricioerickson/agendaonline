<?php

    define('DB_NAME', 'engeuni1_agenda');
    
    define('DB_USER', 'engeuni1_Agenda');
    
    define('DB_PASSWORD', 'AgEnDa2017');
    
    define('DB_HOST', 'localhost');
    
    define('DB_PORT', 3306);
/*
 * 
  
    define('DB_NAME', 'engeuni1_agenda');
    
    define('DB_USER', 'engeuni1_Agenda');
    
    define('DB_PASSWORD', 'AgEnDa2017');
    
    define('DB_HOST', 'conexaobgi.com.br');
    
    define('DB_PORT', 3306);
 */
    
    /** Caminho absoluto para o sistema **/
    define('ABSPATH', dirname(__FILE__). '/');
    
    /** Caminho no server para o sistema **/
    define('BASEURL', '/agendaonline/');
    
    /** Caminho do arquivo de banco de dados **/
    define('DBAPI', ABSPATH. 'dao/database.php');
    
    /** Caminho template **/
    define('HEADER_TEMPLATE', ABSPATH.'template/header.php');
    define('FOOTER_TEMPLATE', ABSPATH.'template/footer.php');
    define('MENU_TEMPLATE', ABSPATH.'template/menu.php');
    define('ADD_TEMPLATE', ABSPATH.'template/add.php');
    define('EDIT_TEMPLATE', ABSPATH.'template/edit.php');
    define('DELETE_TEMPLATE', ABSPATH.'template/modal_delete.php');
    define('VALIDA_COOKIE', ABSPATH.'valida_cookie.php');
    define('PAGINA_INICIAL', ABSPATH.'pagina_inicial.php');
    define('REPORT_HEADER', ABSPATH.'template/report_header.php');
    define('REPORT_FOOTER', ABSPATH.'template/report_footer.php');
    define('VENDA_CADASTRO', ABSPATH.'pages/vendas/venda_cadastro.php');
?>