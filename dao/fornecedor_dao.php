<?php
    require_once ('padrao_dao.php');
    $cidades = null;
    $fornecedores = null;    

    function fornecedores() {
        global $fornecedores;
        $fornecedores = lista_fornecedor();
    }

    function cidades() {
        global $cidades;
        $cidades = lista_cidades();
    }

    function lista_fornecedor() {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join fornecedor f on f.pessoa_id_pessoa = p.id_pessoa";
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
    
    function lista_fornecedores_por_id($id_pessoa = null) {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join fornecedor f on f.pessoa_id_pessoa = p.id_pessoa and p.id_pessoa = $id_pessoa";
            $result = $database->query($sql);

            if ($result->num_rows > 0){
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

    /*
     * add clientes
     */

    function add_fornecedor() {
        if (!empty($_POST['pessoa'])) {
            global $pessoa;
            $data = $_POST['data_nascimento'];

            $data1 = explode('-', $data);
            $dia = $data1[0];
            $mes = $data1[1];
            $ano = $data1[2];

            $data_nascimento = $ano.'-'.$mes.'-'.$dia;

            $_POST['pessoa']['data_nascimento'] = $data_nascimento;
            
            $pessoa = $_POST['pessoa'];

            save('pessoa', $pessoa);

            if ($pessoa) {
                inserir('fornecedor');
            }
//            print "<script>alert('Ação realizada com sucesso!')</script>"; 
            header('location:' . BASEURL . 'pages/lista/fornecedor.php');
        }
    }

    /*
     * Editar clientes
     */

    function edit_fornecedor() {
        if (isset($_GET['id'])) {
            $id_pessoa = $_GET['id'];

            if (isset($_POST['pessoa'])) {
                $data = $_POST['data_nascimento'];

                $data1 = explode('-', $data);
                $dia = $data1[0];
                $mes = $data1[1];
                $ano = $data1[2];

                $data_nascimento = $ano.'-'.$mes.'-'.$dia;

                $_POST['pessoa']['data_nascimento'] = $data_nascimento;
                $pessoa = $_POST['pessoa'];

                update('pessoa', 'id_pessoa', $id_pessoa, $pessoa);
                
                if ($pessoa) {
                    $situacao = $_POST['fornecedor'];
                    update('fornecedor', 'pessoa_id_pessoa', $id_pessoa, $situacao);
                }
                
//                print "<script>alert('Ação realizada com sucesso!')</script>"; 
                header('location:' . BASEURL . 'pages/lista/fornecedor.php');
            } else {
                global $pessoa;
                $pessoa = lista_fornecedores_por_id($id_pessoa);
            }
        } else {
            header('location:' . BASEURL . 'pages/lista/fornecedor.php');
        }
    }

    /*
     * Deletar clientes
     */

    function delete($id = null) {
        global $fornecedor;
        $fornecedor = remove('pessoa', 'id_pessoa', $id);
        
//        print "<script>alert('Ação realizada com sucesso!')</script>"; 
        header('location:' . BASEURL . 'pages/lista/fornecedor.php');
    }
?>