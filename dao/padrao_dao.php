<?php
    require_once (ABSPATH.'config.php');
    include DBAPI;

    /*
     * PESQUISA POR ID
     */

    function find($table = null, $campo = null, $id = null) {
        $database = open_database();
        $found = null;

        try {
            if ($id) {
                $sql = "SELECT * FROM " . $table . " WHERE " . $campo . " = " . $id;
                $result = $database->query($sql);

                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $found[] = $linha;
                    }
                }
            } else {
                $sql = "SELECT * FROM " . $table;
                $result = $database->query($sql);

                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $found[] = $linha;
                    }
                }
            }
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }

        close_database($database);

        return $found;
    }

    function listar($tabela = null, $campo = null, $filtro = null, $ordem = null, $limite = null) {
        $database = open_database();
        $found = null;

        $sql = "SELECT * FROM " . $tabela;

        if (!is_null($campo) && !is_null($filtro)) {
            $sql .= " WHERE $campo IN ('$filtro')";
        }

        if (!is_null($ordem)) {
            $sql .= " ORDER BY $ordem";
        }

        if (!is_null($limite)) {
            $sql .= " LIMIT $limite";
        }

        try {
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

    function find_all($table) {
        return find($table);
    }

    function lista_cidades() {
        $database = open_database();
        $found = null;

        try {
            $sql = "select c.id_cidade, c.descricao, e.sigla from cidade c join estado e on e.id_estado = c.estado_id_estado";
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
     * Salvar cadastro
     */

    function save($table = null, $data = null) {
        $database = open_database();

        $columns = null;
        $values = null;
        $total_colunas = count($data);
        $cont = 0;

        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
            
            $cont++;
            
            if ($cont > $total_colunas) {
                break;
            }
        }

        //remove a última virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');

        $sql = "INSERT INTO " . $table . " ($columns)" . " VALUES " . "($values);";

        try {
            $database->query($sql);
                        
        } catch (Exception $ex) {
            $_SESSION['message'] = 'Não foi possivel realizar a operação!';
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }

    /*
     * Inserir informação nas tabelas CLIENTE | PROFISSIONAL | FORNECEDOR
     */

    function inserir($table = null) {
        $database = open_database();
        $found = null;

        try {
            if ($table == 'cliente') {
                $sql = "INSERT INTO " . $table . " SELECT id_pessoa, id_pessoa, null, 'A' from pessoa order by id_pessoa desc limit 1";
            } elseif ($table == 'profissional') {
                $sql = "INSERT INTO " . $table . " SELECT id_pessoa, id_pessoa, null, 'A' from pessoa order by id_pessoa desc limit 1";
            } else {
                $sql = "INSERT INTO " . $table . " SELECT id_pessoa, id_pessoa, 'A' from pessoa order by id_pessoa desc limit 1";
            }                
            $result = $database->query($sql);

            $_SESSION['message'] = 'Registro cadastrado com sucesso!';
            $_SESSION['type'] = 'success';
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }

    /*
     * Update de informação no cadastro de PESSOA
     */

    function update($table = null, $campo = null, $id = 0, $data = null) {
        $database = open_database();

        $itens = null;
        foreach ($data as $key => $value) {
            $itens .= trim($key, "'") . "='$value',";
        }
        //remove a última virgula
        $itens = rtrim($itens, ',');

        $sql = "UPDATE " . $table;
        $sql .= " SET $itens";
        $sql .= " WHERE $campo =" . $id . ";";

        try {
            $database->query($sql);

            $_SESSION['message'] = 'Registro atualizado com sucesso!';
            $_SESSION['type'] = 'success';
        } catch (Exception $ex) {
            $_SESSION['message'] = 'Não foi possivel realizar a operação!';
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }

    /*
     * Apagar cadastro PESSOA
     */

    function remove($table = null, $campo = null, $id = null) {
        $database = open_database();

        try {
            if ($id) {
                $sql = "DELETE FROM " . $table . " WHERE $campo = " . $id;
                $result = $database->query($sql);

                if ($result = $database->query($sql)) {
                    $_SESSION['message'] = 'Registro excluido com sucesso';
                    $_SESSION['type'] = 'success';
                }
            }
        } catch (Exception $ex) {
            $_SESSION['message'] = $ex->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
    
    function insert($table = null, $dados = null) {
        $database = open_database();
        
        $sql = "INSERT INTO " . $table . " (";
        
       $totalCampos = count($dados);
       
       $cont = 0;
       
       foreach ($dados as $campo => $valor) {
           $campos .= "$campo";
           $valores .= "'$valor'";
           
           $cont++;
           if ($cont != $totalCampos) {
               $campos .= ",";
               $valores .= ",";
           }
       }
       
       $sql .= $campos .") VALUES (" .$valores. ")";
       
       try {
           $database->query($sql);
           
       } catch (Exception $ex) {
           $_SESSION['message'] = 'Não foi possivel realizar a operação!';
           $_SESSION['type'] = 'danger';
       }
       close_database($database);
    }

?>