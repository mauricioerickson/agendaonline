<?php    
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!(empty($_SESSION['usuario']))) {
        include_once (ABSPATH.'config.php');

    } else {
        if ($_POST['usuario'] || $_POST['senha'])  {
            print ' <table width="777" border="0" align="center" cellpadding="0" cellspacing="0" class="style1" bgcolor="#FFFFFF">';
            echo "<tr><td align=\"center\">Você não efetuou o login";
            echo utf8_decode("<br /><a href=\"../home.php\">Clique aqui para se logar</a></td></tr></table>");
        } else {
            header('location:'.BASEURL.'home.php');
        }
    }
?>