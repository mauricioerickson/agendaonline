<?php
    require_once ('padrao_dao.php');
    
    $servicos = null;
    
    function servicos() {
        global $servicos;
        $servicos = lista_servicos();
    }
    
    function lista_tipo_servicos() {
        global $tipo_servicos;
        $tipo_servicos = find_all('tipo_servico');
    }
    
    function lista_produtos() {
        global $produtos;
        $produtos = find_all('produto');
    }
    
    function lista_servicos() {
        $database = open_database();
        $found = null;

        try {
            $sql = "SELECT "
                    . "s.*, ts.descricao_tipo_servico, p.descricao_produto "
                    . " FROM "
                    . " servico s "
                    . " JOIN tipo_servico ts ON ts.id_tipo_servico = s.tipo_servico_id_tipo_servico "
                    . " LEFT JOIN servico_produto sp on sp.servico_id_servico = s.id_servico "
                    . " LEFT JOIN produto p ON p.id_produto = sp.produto_id_produto";
            
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
    
    function add() {
        $database = open_database();
        
        if (!empty($_POST['servico'])) {
            global $servico;
            $servico = $_POST['servico'];
            
            save('servico', $servico);
//            if ($servico) {
//                inserir_servico_produto($id_servico, $id_produto);
//            }
//            
//            print '<script>alert("Ação realizada com sucesso!");</script>';
            header('location:'.BASEURL.'pages/lista/servico.php');
        }
    }

    function inserir_servico_produto($id_servico = null, $id_produto = null){
        $database = open_database();
        $found = null;                                
        
        try{            
            $sql = "INSERT INTO servico_produto (servico_id_servico, produto_id_produto) VALUES ($id_servico, $id_produto);" ;
            $result = $database->query($sql);
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }
    
    function edit() {
        if (isset($_GET['id'])) {
            $id_servico = $_GET['id'];
            
            if (isset($_POST['servico'])) {
                $servico = $_POST['servico'];
                
                update('servico', 'id_servico', $id_servico, $servico);
                
//                print '<script>alert("Ação realizada com sucesso!");</script>';                
                header('location:'.BASEURL.'pages/lista/servico.php');
            } else {
                global $servico;
                $servico = find('servico', 'id_servico', $id_servico);
            }
        } else {            
            header('location:'.BASEURL.'pages/lista/servico.php');
        }                
    }
    
    function delete($id = null) {
        global $servico;
        $servico = remove('servico', 'id_servico', $id);
        
        header('location:' . BASEURL . 'pages/lista/servico.php');
    }
    
?>