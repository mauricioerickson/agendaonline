<?php 
    require_once ('../config.php');
    require_once ('../dao/padrao_dao.php');
    
    $database = open_database();
    
    try {
        $sql = "SELECT * FROM usuario WHERE usuario = '".$_POST['usuario']."'";
        $result = $database->query($sql);
        
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                $dados[] = $linha;
            }
        }        
    } catch (Exception $ex) {
        $_SESSION['message'] = $ex->getMessage();
        $_SESSION['type'] = 'danger';
    }    
    
    if ($dados[0]['usuario'] != $_POST['usuario']) {
        print ("<script>alert('Usuário ou Senha não conferem!');</script><script>window.location='../home.php'</script>");
    } else {
        if ($dados[0]['senha'] != $_POST['senha']) {
            print ("<script>alert('Usuário ou Senha não conferem!');</script><script>window.location='../home.php'</script>");print utf8_encode("<script>alert('Usuário ou Senha não conferem!');</script><script>window.location='../home.php'</script>");

        } else {
            ini_set('session.cache_expire', 15);
            session_start();
            $_SESSION['usuario'] = $dados[0]['usuario'];
            header('location:'.BASEURL.'pagina_inicial.php');
        }
    }
    
    
    
?>



