
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="#" class="img-circle" />
            </div>
            <div class="pull-left info">
                <!--<p class="username"></p>-->
                <i class="glyphicon glyphicon-user"> - <label><?php echo $_SESSION['usuario']; ?></label></i>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU DE NAVEGAÇÃO</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Usuarios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-user"></i> Usuario</a></li>
                    <li><a href="#"><i class="fa fa-suitcase"></i> Perfil</a></li>
                    <li><a href="#"><i class="fa fa-hand-scissors-o"></i> Controle de acesso</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Cadastros</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo BASEURL ?>pages/lista/cliente.php"><i class="fa fa-user"></i> Cliente</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/fornecedor.php"><i class="fa fa-suitcase"></i> Fornecedor</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/profissional.php"><i class="fa fa-address-card"></i> Profissional</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/produto.php"><i class="fa fa-product-hunt"></i> Produtos</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-money"></i> Serviços
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo BASEURL ?>pages/lista/tipo_servico.php"><i class="fa fa-circle-o"></i> Tipo serviço</a></li>
                            <li><a href="<?php echo BASEURL ?>pages/lista/servico.php"><i class="fa fa-circle"></i> Serviços</a></li>
                        </ul>
                    </li>
                </ul>
            </li>         
            <li>
                <a href="<?php echo BASEURL ?>pages/agenda.php">
                    <i class="fa fa-calendar"></i> <span>Agenda</span>
                    <span class="pull-right-container">
<!--                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>-->
                    </span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Vendas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">                    
                    <li><a href="#"><i class="fa fa-usd"></i> Consultar Vendas</a></li>
<!--                    <li><a href="<?php echo BASEURL ?>pages/lista/fornecedor.php"><i class="fa fa-suitcase"></i> Fornecedor</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/profissional.php"><i class="fa fa-address-card"></i> Profissional</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/produto.php"><i class="fa fa-product-hunt"></i> Produtos</a></li>-->
                    
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cc"></i> <span>Caixa</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">                    
                    <li><a href="<?php echo BASEURL ?>pages/caixa.php"><i class="fa fa-money"></i> Gaveta</a></li>
<!--                    <li><a href="<?php echo BASEURL ?>pages/lista/fornecedor.php"><i class="fa fa-suitcase"></i> Fornecedor</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/profissional.php"><i class="fa fa-address-card"></i> Profissional</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/produto.php"><i class="fa fa-product-hunt"></i> Produtos</a></li>-->
                    
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Financeiro</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-money"></i> Caixa<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Gaveta</a></li>
                            <!--<li><a href="<?php echo BASEURL ?>pages/lista/servico.php"><i class="fa fa-circle"></i> Serviços</a></li>-->
                        </ul>
                    </li>
<!--                    <li><a href="<?php echo BASEURL ?>pages/lista/cliente.php"><i class="fa fa-user"></i> Cliente</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/fornecedor.php"><i class="fa fa-suitcase"></i> Fornecedor</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/profissional.php"><i class="fa fa-address-card"></i> Profissional</a></li>
                    <li><a href="<?php echo BASEURL ?>pages/lista/produto.php"><i class="fa fa-product-hunt"></i> Produtos</a></li>-->
                    
                </ul>
            </li>
            
            <li>
                <a href="<?php echo BASEURL ?>destroy.php">
                    <i class="fa fa-calendar"></i> <span>Sair</span>
                    <span class="pull-right-container">
<!--                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>-->
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>