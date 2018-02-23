<?php
    require_once ('../config.php');
    require_once ('padrao_dao.php');
    require_once ('venda_dao.php');            
    update_venda();    
    
    function update_venda() {
       if (isset($_POST['id_agenda'])) {
           $id_venda_agenda = $_POST['id_agenda'];   
           global $venda_agenda;
           fechar_agenda($id_venda_agenda);
           
           if (isset($venda_agenda)) {
               $venda = $venda_agenda;

               update('venda', 'id_agenda_venda', $id_venda_agenda, $venda);
               header('location:'.BASEURL.'pages/vendas/venda_cadastro.php');
           } else {
               global $venda;
               $venda = lista_venda_por_id_agenda();
           }
       } else {
           header('location:'.BASEURL.'pages/vendas/venda_cadastro.php');
       }                
    }
    
    
    
?>