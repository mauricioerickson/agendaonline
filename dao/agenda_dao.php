<?php
    require_once ('padrao_dao.php');

    $agendas = null;
    $clientes_agenda = null;
    $servicos_agenda = null;
    $lista_profissionais = null;
    $servico_gravado = null;
    $agenda_encerramento = null;

    function listagem() {
        global $agendas;
        $agendas = lista_agenda();
    }

    function lista_clientes_agenda() {
        global $clientes_agenda;
        $clientes_agenda = busca_cliente();
    }

    function servico_agenda() {
        global $servico_agenda_id;
        $servico_agenda_id = busca_servico_gravado();
    }

    function lista_servicos_agenda() {
        global $servicos_agenda;
        $servicos_agenda = busca_servicos();
    }

    function lista_profissionais() {
        global $lista_profissionais;
        $lista_profissionais = busca_profissional();
    }

    function lista_encerramento_agenda() {
        global $agenda_encerramento;
        $agenda_encerramento = lista_agendas_encerrar();
    }

    function lista_agendas_encerrar() {
        $database = open_database();

        try {
            $sql = "select date_format(a.data_hora_inicio, '%d/%m %H:%i') as data_hora, "
                 . "       p.nome, a.id_agenda, c.id_cliente "
                 . "from agenda a "
                 . "join cliente c on c.id_cliente = a.cliente_id_cliente "
                 . "join pessoa p on p.id_pessoa = c.pessoa_id_pessoa "
                 . "where a.situacao = 'A' and date(data_hora_fim) = current_date()"
                 . " order by a.data_hora_inicio";

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

    function lista_agenda() {
        $database = open_database();

        try {
            $sql = "SELECT "
                    . " a.*, c.id_cliente, p.nome AS cliente, s.descricao_servico, s.duracao_aproximada "
                    . " FROM "
                    . " agenda a "
                    . " JOIN cliente c ON c.id_cliente = a.cliente_id_cliente "
                    . " JOIN pessoa p ON p.id_pessoa = c.pessoa_id_pessoa "
                    . " LEFT JOIN servico s ON s.id_servico = a.servico_id_servico "
                    . " LEFT JOIN profissional pr on pr.cor = a.cor "
                    . " WHERE a.situacao = 'A'";

            $result = $database->query($sql);

            if ($result-> num_rows > 0) {
                while($linha = $result->fetch_assoc()) {
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

    function busca_cliente() {
        $database = open_database();

        try {
            $sql = "select c.*, p.nome from cliente c join pessoa p on p.id_pessoa = c.pessoa_id_pessoa where c.situacao = 'A'";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                while($linha = $result->fetch_assoc()) {
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

    function busca_servicos() {
        $database = open_database();

        try {
            $sql = "select * from servico where situacao = 'A'";

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

    function busca_servico_gravado() {
        $database = open_database();

        $id_agenda = $_GET['id_agenda'];

        try {
            $sql = "select * from servico where situacao = 'A' and id_servico in (select servico_id_servico from agenda where id_agenda = $id_agenda)";

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

    function busca_profissional() {
        $database = open_database();

        try {
            $sql = "select p.*, pe.nome, pe.nome_apelido from profissional p join pessoa pe on pe.id_pessoa = p.pessoa_id_pessoa where p.situacao = 'A' ";

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

    function agenda_id() {
        $database = open_database();

        try {
            $sql = "select id_agenda from agenda order by id_agenda desc limit 1";
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

    function add_agenda() {
        if (!empty($_POST['agenda'])) {
            global $agenda;

            $data_inicio = $_POST['data_hora_inicio'];
            $data = explode(" ", $data_inicio);
            $datai = explode("/", $data[0]);

            $dia = $datai[0];
            $mes = $datai[1];
            $ano = $datai[2];

            $data_hora_inicio = $ano.'-'.$mes.'-'.$dia.' '.$data[1];

            $data_fim = $_POST['data_hora_fim'];
            $data2 = explode(" ", $data_fim);
            $dataf = explode("/", $data2[0]);

            $diaf = $dataf[0];
            $mesf = $dataf[1];
            $anof = $dataf[2];

            $data_hora_fim = $anof.'-'.$mesf.'-'.$diaf.' '.$data2[1];

            $_POST['agenda']['data_hora_inicio'] = $data_hora_inicio;
            $_POST['agenda']['data_hora_fim'] = $data_hora_fim;

            $agenda = $_POST['agenda'];

            save('agenda', $agenda);

            if ($agenda) {
                $database = open_database();
                $id_agenda = agenda_id();
                $id_agenda_venda = $id_agenda['0']['id_agenda'];
                //save('venda', $id_agenda_venda);
                $sql = "INSERT INTO venda (id_agenda_venda)VALUES (".$id_agenda_venda.")";
                $result = $database->query($sql);
		header('location:'.BASEURL.'pages/agenda.php');
            }            
        }
    }

    function edit_delete() {
        $database = open_database();

        if (isset($_POST['delete']) && isset($_POST['id_agenda'])) {
            $id_agenda = $_POST['id_agenda'];

            try {
                $checar_situacao_agenda = "SELECT id_agenda_venda FROM venda WHERE situacao = 'F' AND id_agenda_venda = ".$id_agenda;
                $situacao_venda_agenda = $database->query($checar_situacao_agenda);

                if ($situacao_venda_agenda->num_rows == 0) {
                    $sql = "UPDATE agenda SET situacao = 'I' WHERE id_agenda = $id_agenda";
                    $result = $database->query($sql);
                    header('location:'.BASEURL.'pages/agenda.php');
                } else {
                    print "<script>alert('Agenda não pode ser cancelada, pois já tem venda finalizada!!!')</script>";
                }

            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }
        } elseif (isset($_POST['id_agenda']) || isset($_POST['servico_id_servico'])) {
            $id_agenda = $_POST['id_agenda'];

            if (empty($_POST['servico_id_servico'])) {
                $id_servico = '0';
            } else {
                $id_servico = $_POST['servico_id_servico'];
            }

            if (empty($_POST['cor'])) {
                $cor = null;
            } else {
                $cor = $_POST['cor'];
            }

            if (empty($_POST['duracao'])) {
                $duracao = '0';
            } else {
                $duracao = $_POST['duracao'];
            }

            try {
                $sql = "UPDATE agenda SET cor = '$cor', servico_id_servico = $id_servico, duracao = $duracao WHERE id_agenda = $id_agenda ";
                $result = $database->query($sql);
                header('location:'.BASEURL.'pages/agenda.php');
            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }
        }
    }

    function atualizar_data_hora() {
        $database = open_database();

        if (isset($_POST['Agenda'][0]) && isset($_POST['Agenda'][1]) && isset($_POST['Agenda'][2])) {
            $id_agenda = $_POST['Agenda'][0];
            $data_inicial = $_POST['Agenda'][1];
            $data_final = $_POST['Agenda'][2];

            try {
                $sql = "UPDATE agenda SET data_hora_inicio = '$data_inicial', data_hora_final = '$data_final WHERE id_agenda = $id_agenda ";
                $result = $database->query($sql);
                header('location:'.BASEURL.'pages/agenda.php');
            } catch (Exception $ex) {
                $_SESSION['message'] = $ex->getMessage();
                $_SESSION['type'] = 'danger';
            }
        }
    }
?>