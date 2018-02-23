<?php require_once ('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AgendaOnLine</title>
        <!--Tell the browser to be responsive to screen width-->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="all" />
        <meta http-equiv="content-type" content="text/html" />

        <link rel="shortcut icon" href="<?php echo BASEURL ?>favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo BASEURL ?>favicon.ico" type="image/x-icon">
        <!--Bootstrap 3.3.7-->
        <link rel="stylesheet" href="<?php echo BASEURL ?>bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <!--Font Awesome-->
        <link rel="stylesheet" href="<?php echo BASEURL ?>bower_components/font-awesome/css/font-awesome.min.css" />
        <!--Ionicons-->
        <link rel="stylesheet" href="<?php echo BASEURL ?>bower_components/Ionicons/css/ionicons.min.css" />
        <!--Theme style-->
        <link rel="stylesheet" href="<?php echo BASEURL ?>css/AdminLTE.min.css" />
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo BASEURL ?>plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="index.php"><b>Agenda</b>OnLine</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Informe o usuário e senha para iniciar a sessão</p>
                <form action="pages/login.php" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuário">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="senha" class="form-control" placeholder="Senha">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">                            
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Acessar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="<?php echo BASEURL ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo BASEURL ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo BASEURL ?>plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#usuario").keyup(function () {
                    $(this).val($(this).val().toUpperCase());
                });
            });
        </script>
    </body>
</html>