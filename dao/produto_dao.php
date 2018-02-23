<?php
    require_once ('padrao_dao.php');
    
    $produtos = null;
    
    function produtos() {
        global $produtos;
        $produtos = find_all('produto');
    }
    
    function add() {
        $database = open_database();
        
        if (!empty($_POST['produto'])) {
            global $produto;
            $produto = $_POST['produto'];
            
            save('produto', $produto);
            
//            print '<script>alert("Ação realizada com sucesso!");</script>';
            header('location:'.BASEURL.'pages/lista/produto.php');
        }
    }    
    
    function edit() {
        if (isset($_GET['id'])) {
            $id_produto = $_GET['id'];
            
            if (isset($_POST['produto'])) {
                $produto = $_POST['produto'];
                
                update('produto', 'id_produto', $id_produto, $produto);
                
//                print '<script>alert("Ação realizada com sucesso!");</script>';                
                header('location:'.BASEURL.'pages/lista/produto.php');
            } else {
                global $produto;
                $produto = find('produto', 'id_produto', $id_produto);
            }
        } else {            
            header('location:'.BASEURL.'pages/lista/produto.php');
        }                
    }
    
    function delete($id = null) {
        global $produto;
        $produto = remove('produto', 'id_produto', $id);
        
        header('location:' . BASEURL . 'pages/lista/produto.php');
    }
    
?>