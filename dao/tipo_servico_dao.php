<?php

    require_once ('padrao_dao.php');

    $tipo_servicos = null;

    function tipo_servico() {
        global $tipo_servicos;
        $tipo_servicos = find_all('tipo_servico');
    }

    function add() {
        $database = open_database();

        if (!empty($_POST['tipo_servico'])) {
            global $tipo_servico;
            $tipo_servico = $_POST['tipo_servico'];

            save('tipo_servico', $tipo_servico);

//            print '<script>alert("Ação realizada com sucesso!");</script>';
            header('location:' . BASEURL . 'pages/lista/tipo_servico.php');
        }
    }   

    function delete($id = null) {
        global $tipo_servico;
        $tipo_servico = remove('tipo_servico', 'id_tipo_servico', $id);

        header('location:' . BASEURL . 'pages/lista/tipo_servico.php');
    }
?>