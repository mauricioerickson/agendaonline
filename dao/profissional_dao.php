<?php
    require_once ('padrao_dao.php');
    $cidades = null;
    $profissionais = null;    

    function profissionais() {
        global $profissionais;
        $profissionais = lista_profissional();
    }

    function cidades() {
        global $cidades;
        $cidades = lista_cidades();
    }

    function lista_profissional() {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join profissional pr on pr.pessoa_id_pessoa = p.id_pessoa";
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
    
    function lista_profissionais_por_id($id_pessoa = null) {
        $database = open_database();

        try {
            $sql = "select * from pessoa p join profissional pr on pr.pessoa_id_pessoa = p.id_pessoa and p.id_pessoa = $id_pessoa";
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
    
    function profissional_id() {
        $database = open_database();
        
        try {
            $sql = "select pessoa_id_pessoa from profissional order by pessoa_id_pessoa desc limit 1";
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

    /*
     * add clientes
     */

    function add_profissional() {
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
                inserir('profissional');
                $profissional = profissional_id();
                $id_profissional = $profissional['0']['pessoa_id_pessoa'];
                $cor = $_POST['profissional'];
                                                
                update('profissional', 'id_profissional', $id_profissional, $cor);
            }
            
//            print "<script>alert('Ação realizada com sucesso!')</script>"; 
            header('location:' . BASEURL . 'pages/lista/profissional.php');
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
                    $situacao = $_POST['profissional'];
                    update('profissional', 'pessoa_id_pessoa', $id_pessoa, $situacao);
                }
                
//                print "<script>alert('Ação realizada com sucesso!')</script>"; 
                header('location:' . BASEURL . 'pages/lista/profissional.php');
            } else {
                global $pessoa;
                $pessoa = lista_profissionais_por_id($id_pessoa);
            }
        } else {
            header('location:' . BASEURL . 'pages/lista/profissional.php');
        }
    }

    /*
     * Deletar clientes
     */

    function delete($id = null) {
        global $profissional;
        $profissional = remove('pessoa', 'id_pessoa', $id);
        
//        print "<script>alert('Ação realizada com sucesso!')</script>"; 
        header('location:' . BASEURL . 'pages/lista/profissional.php');
    }
?>