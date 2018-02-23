<?php
/*
 * SITUAÇÕES DA VENDA
 * A - EM ABERTO
 * F - FECHADA
 * C - CANCELADA
 */
    require_once ('padrao_dao.php');
    
    $fechar_agenda = null;
    $lista_produtos = null;
    
    function lista_produto() {
        global $lista_produtos;
        $lista_produtos = listar('produto', 'situacao', 'A');
    }
    
    function lista_servico() {
        global $lista_servicos;
        $lista_servicos = listar('servico', 'situacao', 'A');
    }
    
    function fechar_agenda($id) {
        global $fechar_agenda;
        $fechar_agenda = fechar_venda($id);
    }
    
    function listar_venda_por_id($id_agenda) {
        global $lista_venda_agenda;
        $lista_venda_agenda = lista_venda_por_id_agenda($id_agenda);
    }
    
    function checar_venda_nova($id) {
        global $checar_venda_nova;
        $checar_venda_nova = checar_vendas($id);
    }
    
    function item_venda() {
        global $item_venda;
        $item_venda = lista_item_venda();
    }
    
    function soma_valor_total($id) {
        global $valor_total_venda;
        $valor_total_venda = somar_venda($id);
    }
    
    function fechar_venda($id = null) {
        $database = open_database();
        
        try {
            
            $sql = "select a.*, v.*, p.nome, c.id_cliente, s.id_servico, "
                . "        profissional.profissional as profissionalNome, profissional.id_profissional, s.descricao_servico, s.valor_servico "
                . "from agenda a "
                . "join cliente c on c.id_cliente = a.cliente_id_cliente "
                . "join pessoa p on p.id_pessoa = c.pessoa_id_pessoa "
                . "join (select pe.nome as profissional, pr.id_profissional, pr.cor from profissional pr join pessoa pe on pr.pessoa_id_pessoa = pe.id_pessoa) "
                . "as profissional on profissional.cor = a.cor "
                . "left join servico s on s.id_servico = a.servico_id_servico "
                . "left join venda v on v.id_agenda_venda = a.id_agenda "
                . "where a.situacao = 'A' and a.id_agenda = ".$id. " order by a.data_hora_inicio";
            
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
        close_database($database);        
        return $found;
    }

    function lista_venda_por_id_agenda($id_agenda = null) {
        $database = open_database();
        $id_agenda_venda = $_POST['id_agenda'];

        try {
            $sql = "SELECT id_venda FROM venda WHERE id_agenda_venda = ".$id_agenda;

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {
                    $sale[] = $linha;
                }
            }
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
  
        return $sale;

    }
    
    function lista_item_venda() {
        $database = open_database();
        
        if ($_SESSION['id_agenda']) {
            $id_agenda_venda = $_SESSION['id_agenda'];
        } else {
            $id_agenda_venda = $_POST['id_agenda'];
        }        
        
        try {
            $sql = "SELECT i.*, p.descricao_produto, s.descricao_servico "
                    . "FROM item_venda i "
                    . "LEFT JOIN produto p on p.id_produto = i.produto_id_produto "
                    . "LEFT JOIN servico s on s.id_servico = i.servico_id_servico "
                    . "WHERE venda_id_venda = (SELECT id_venda FROM venda WHERE id_agenda_venda = ".$id_agenda_venda.")";
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
        close_database($database);
        
        if (!empty($found)) {
            return $found;
        }
    }    

    function checar_vendas($id) {
        $database = open_database();
        
        try {
            $sql = "select id_venda from venda where situacao = 'A' and profissional_id_profissional is null and cliente_id_cliente = '0' and id_agenda_venda =".$id;
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
        close_database($database);
        if (!empty($found)) {
            return $found;  
        }
    }
        
    function update_abrir_venda() {
        $database = open_database();
        
        if (isset($_POST['id_agenda'])) {
            $id_agenda = $_POST['id_agenda'];
            $venda = fechar_venda($id_agenda);
            $id_cliente = $venda[0]['id_cliente'];
            $id_profissional = $venda[0]['id_profissional'];
            $id_servico = $venda[0]['id_servico'];
            $valor_servico = $venda[0]['valor_servico'];
            echo $id_agenda;
            echo $venda;
echo $id_cliente; echo $id_profissional;
                    
            try {
                $sql = "UPDATE venda SET cliente_id_cliente = ".$id_cliente.", profissional_id_profissional = ".$id_profissional." WHERE id_agenda_venda = ".$id_agenda;
                echo $sql;
                $result = $database->query($sql);
                $_SESSION['type'] = 'success';
                
                if ($_SESSION['type'] == 'success') {
                    $id_venda = "SELECT id_venda FROM venda WHERE id_agenda_venda = ".$id_agenda;
                    $obj_venda = $database->query($id_venda);
                    
                    if ($obj_venda->num_rows > 0) {
                        while ($linha = $obj_venda->fetch_assoc()) {
                            $dados[] = $linha;
                        }
                    }
                    
                    $reg_venda = $dados[0]['id_venda'];
                    
                    $itens['venda_id_venda'] = $reg_venda;
                    $itens['servico_id_servico'] = $id_servico;
                    $itens['valor_total'] = $valor_servico; 
                    
                    save('item_venda', $itens);
                }
                
            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }                    
        }
    }
    
    function delete($id = null) {
        global $itens;
        $itens = remove('item_venda', 'id_item_venda', $id);
        header('location:'.BASEURL.'pages/vendas/venda_cadastro.php');                
    }
    
    function somar_venda($id = null) {
        $database = open_database();
        
        try {
            $sql = 'select sum(valor_total) from item_venda where venda_id_venda = '.$id. 'group by venda_id_venda';
            
            $return = $database->query($sql);
            
            if ($return->num_rows > 0) {
                while ($linha = $return->fetch_assoc()) {
                    $found[] = $linha;
                }
            }
            
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        
        close_database($database);
        return $found;
    }
?>
