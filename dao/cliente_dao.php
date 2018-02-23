<?php
    require_once ('padrao_dao.php');

    $cidades = null;
    $clientes = null;
    $data_nascimento = null;
    $cliente = null;

    function clientes() {
        global $clientes;
        $clientes = lista_clientes();
    }

    function cidades() {
        global $cidades;
        $cidades = lista_cidades();
    }


    function lista_clientes() {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join cliente c on c.pessoa_id_pessoa = p.id_pessoa";
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

    function lista_clientes_por_id($id_pessoa = null) {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join cliente c on c.pessoa_id_pessoa = p.id_pessoa and p.id_pessoa = $id_pessoa";
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
    function add() {
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

            if ($pessoa){
                inserir('cliente');
                upload_fotos();
            }

//            print "<script>alert('Ação realizada com sucesso!')</script>";
            header('location:'.BASEURL.'pages/lista/cliente.php');            
        }
    }

    /*
     * Editar clientes
     */
    function edit() {
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
                    $situacao = $_POST['cliente'];
                    update('cliente', 'pessoa_id_pessoa', $id_pessoa, $situacao);
                }
                
                upload_fotos();
                
               
//            print "<script>alert('Ação realizada com sucesso!')</script>";
            header('location:'.BASEURL.'pages/lista/cliente.php');  
                
            } else {
                global $pessoa;
                $pessoa = lista_clientes_por_id($id_pessoa);
            }
        } else {
            header('location:'.BASEURL.'pages/lista/cliente.php');
        }
    }
    /*
     * Deletar clientes
     */
    function delete($id = null) {
        global $cliente;
        $cliente = remove('pessoa', 'id_pessoa', $id);

//        print "<script>alert('Ação realizada com sucesso!')</script>";
        header('location:'.BASEURL.'pages/lista/cliente.php');
    }

    function grava_imagem($nome = null) {
        $database = open_database();
        $found = null;
        $id_pessoa = $_GET['id'];
        
        try {
            $sql = "UPDATE cliente SET foto = '$nome' ";
            
            if ($id_pessoa != null) {
                $sql .= " WHERE id_cliente = $id_pessoa ";
            } else {
                $sql .= " WHERE id_cliente = (SELECT id_pessoa FROM pessoa ORDER BY id_pessoa DESC LIMIT 1)";                    
            }
                
                    
            $result = $database->query($sql);

        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }

    function upload_fotos() {
        $foto = $_FILES['foto'];
        if (!empty($foto)){

            $error = array();
            if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto['type'])) {
                $error[1] = "Isso não é uma imagem!";
            }

            if (count($error) == 0) {
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto['name'], $ext);

                $nome_imagem = md5(uniqid(time())).".".$ext[1];

                $caminho_imagem = ABSPATH."fotos/".$nome_imagem;

                move_uploaded_file($foto['tmp_name'], $caminho_imagem);

                grava_imagem($nome_imagem);

            }


            if (count($error) != 0) {
                foreach ($error as $erro) {
                    $erro ."<br />";
                }
            }
        }
    }
?>