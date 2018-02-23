<?php
    require_once ('padrao_dao.php');

    /**
     *
     * @global type $caixa
     *
     * Situações do caixa:
     * A - ABERTO
     * F - FECHADO
     */
    $caixas = null;
    $profissionais = null;
    $sangria = null;
    $reforco = null;
    $vale = null;
    $extrato_caixa = null;

    function extrato_caixa() {
        global $extrato_caixa;
        $extrato_caixa = lista_extrato_caixa();
    }

    function total_sangria() {
        global $sangria;
        $sangria = lista_sangria_total();
    }
    
    function total_reforco() {
        global $reforco;
        $reforco = lista_reforco_total();
    }
    
    function total_vale() {
        global $vale;
        $vale = lista_vale_total();
    }

    function caixas_em_aberto() {
        global $caixas;
        $caixas = listar_caixa_ativo();
    }

    function profissional_caixa() {
        global $profissionais;
        $profissionais = lista_profissional();
    }

    function listar_caixa_ativo() {
        $database = open_database();

        try {
            $sql = "select * from caixa where situacao = 'A' order by id_caixa desc limit 1";
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

        if (!empty($found)) {
            return $found;
        }
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
    
    function lista_sangria_total() {
        $database = open_database();
        
        $id_caixa = $_SESSION['id_caixa'];
        
        try {
            $sql = "SELECT SUM(valor_sangria) AS total_retirada FROM caixa_sangria WHERE caixa_id_caixa = $id_caixa GROUP BY caixa_id_caixa";
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
    
    function lista_reforco_total() {
        $database = open_database();
        
        $id_caixa = $_SESSION['id_caixa'];
        
        try {
            $sql = "SELECT SUM(valor_reforco) AS total_reforco FROM caixa_reforco WHERE caixa_id_caixa = $id_caixa GROUP BY caixa_id_caixa";
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
    
    function lista_vale_total() {
        $database = open_database();
        
        $id_caixa = $_SESSION['id_caixa'];
        
        try {
            $sql = "SELECT SUM(valor_vale) AS total_vale FROM caixa_vale WHERE caixa_id_caixa = $id_caixa GROUP BY caixa_id_caixa";
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

    function lista_extrato_caixa() {
        $database = open_database();

        try {
            $sql =  " select date_format(c.data_hora_criacao, '%d/%m/%Y %H:%i:%s') as abertura_caixa, "
                   ."      c.valor_inicial, "
                   ."      u.usuario, "
                   ."      if (s.tipo_sangria='D', 'Dinheiro',if(s.tipo_sangria='C','Cheque','')) as tipo_sangria, "
                   ."      sum(s.valor_sangria) as total_sangria, "
                   ."      if (v.tipo_vale='D', 'Dinheiro', if(v.tipo_vale='C','Cheque','')) as tipo_vale, "
                   ."      sum(v.valor_vale) as total_vale, "
                   ."      sum(r.valor_reforco) as total_reforco "
                   ." from caixa c "
                   ." inner join usuario u on u.id_usuario = c.id_usuario "
                   ." left join caixa_sangria s on s.caixa_id_caixa = c.id_caixa "
                   ." left join caixa_vale v on v.caixa_id_caixa = c.id_caixa"
                   ." left join caixa_reforco r on r.caixa_id_caixa = c.id_caixa"
                   ." where c.situacao = 'A'"
                   ." group by c.data_hora_criacao, c.id_usuario, s.tipo_sangria, v.tipo_vale";

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

    function add_caixa() {
        if (!empty($_POST['caixa'])) {
            global $caixa;
            $caixa = $_POST['caixa'];
            save('caixa', $caixa);
            print "<script>alert('Ação realizada com sucesso!')</script>";
            header('location:'.BASEURL.'pages/caixa.php');
        }
    }
?>