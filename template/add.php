<?php require_once (ABSPATH.'config.php'); ?>

<?php include HEADER_TEMPLATE; ?>

<section class="content-header">
    <h1>Cadastro de <?php 
                        if ($_SESSION['tipo'] === 'cliente') {
                            echo 'clientes';
                        } elseif ($_SESSION['tipo'] === 'fornecedor') {
                            echo 'fornecedores';                        
                        } elseif ($_SESSION['tipo'] === 'profissional') {
                            echo 'profissionais';
                        }
                    ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo BASEURL; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Cadastros</a></li>
        <li class="active"><?php echo $_SESSION['tipo']; ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!--<div class="col-md-12">-->
        <div class="box box-primary">
            <form action="add_<?php echo $_SESSION['tipo']; ?>.php" method="post" enctype="multipart/form-data" id="form" name="form-<?php echo $_SESSION['tipo']; ?>">
                <div class="box-body">                    
                    <input type="hidden" name="pessoa['data_cadastro']" value="<?php echo strftime( '%Y-%m-%d %H:%M:%S', strtotime('now') ); ?>" />
                    
                    <?php
                        if ($_SESSION['tipo'] === 'fornecedor') {
                    ?>                              
                            <div class="form-group col-md-2">
                                    <label for="name">Tipo pessoa</label>
                                    <select id='tipo' class="form-control" name="pessoa['tipo_pessoa']" onchange="aplicaMascara(this.value);">                                        
                                        <option value="Selecione">Selecione...</option>
                                        <option value="J">JURIDICA</option>
                                        <option value="F">FISICA</option>
                                    </select>
                                    <label id="lbl_tipo_pessoa" for="name"></label>
                           </div>
                           <div class="col-md-12">
                               
                           </div>                    
                    <?php
                        }
                    ?>
                    
                    <?php if ($_SESSION['tipo'] === 'cliente') { ?>
                        <div class="form-group col-md-12">
                            <label for="exampleInputFile">Foto</label>
                            <div id="visualizar" class="col-md-2 pull-left image">                                
                            </div>
                            <input type="file" name="foto" id="exampleInputFile">                            
                        </div>                                                    
                    <?php } ?>
                    
                    <?php if ($_SESSION['tipo'] === 'profissional') { ?>                                                    
                        <div class="form-group col-md-2">
                            <label>Cor agenda</label>                                                        
                            <select name="profissional['cor']" id="new_color" class="form-control">
                                <option value="">Selecione a cor</option>
                                <option value="#FFD700" style="color: #FFD700">&#9724; OURO</option>
                                <option value="#0073b7" class="text-blue">&#9724; AZUL</option>
                                <option value="#3c8dbc" class="text-light-blue">&#9724; AZUL CLARO</option>
                                <option value="#8B008B" style="color: #8B008B">&#9724; MAGENTA</option>
                                <option value="#FFFF00" style="color: #ffff00">&#9724; AMARELO</option>
                                <option value="#ff851b" class="text-orange">&#9724; LARANJA</option>
                                <option value="#00a65a" class="text-green">&#9724; VERDE</option>
                                <option value="#01ff70" class="text-lime">&#9724; VERDE LIMÃO</option>
                                <option value="#dd4b39" class="text-red">&#9724; VERMELHO</option>
                                <option value="#605ca8" class="text-purple">&#9724; ROXO</option>
                                <option value="#f012be" class="text-fuchsia">&#9724; ROSA</option>
                                <option value="#7a869d" class="text-muted">&#9724; CINZA</option>
                                <option value="#001f3f" class="text-navy">&#9724; PRETO</option>
                            </select>                                                            
                        </div>
                        <div class="form-group col-md-11"></div>
                    <?php } ?>
                    
                    <div class="form-group col-md-6">
                        <label id="lbl_nome" for="name">Nome</label>
                        <input type="text" class="form-control" id="nome" name="pessoa['nome']" />
                    </div>

                    <div class="form-group col-md-3">
                        <label id="lbl_apelido" for="name">Nome/Apelido</label>
                        <input type="text" class="form-control" name="pessoa['nome_apelido']" />
                    </div>

                    <div class="form-group col-md-3">
                        <label id="lbl_data" for="name">Data nascimento</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker" name="data_nascimento" />
                        </div>
                    </div>                                      
                    
                    <div class="form-group col-md-3">
                        <label for="name" id="lbl_cpf_cnpj">CPF</label>                        
                        <input type="text" id="cpf" class="form-control" onchange="cpf_cnpj();" name="pessoa['cpf_cnpj']" />
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="name" id="lbl_rg_ie">RG</label>
                        <input type="text" id="rg" class="form-control" name="pessoa['rg_ie']" />
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="name" id="lbl_sexo">Sexo</label>
                        <select id='sexo' class="form-control" name="pessoa['sexo']">
                            <option value="">Escolha o sexo...</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMININO</option>
                        </select>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="form-group col-md-4">
                        <label for="name">E-mail</label>
                        <input type="text" class="form-control" id="email" name="pessoa['email']" />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="name">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="pessoa['telefone']" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Celular</label>
                        <input type="text" id="celular" class="form-control" name="pessoa['celular']" />
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="name">Celular contato</label>
                        <input type="text" id="celular2" class="form-control" name="pessoa['celular_2']" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Endereço</label>
                        <input type="text" class="form-control" name="pessoa['endereco']" />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="name">Numero</label>
                        <input type="text" class="form-control" name="pessoa['numero']" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Complemento</label>
                        <input type="text" class="form-control" name="pessoa['complemento']" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Bairro</label>
                        <input type="text" class="form-control" name="pessoa['bairro']" />
                    </div>
                    
                    <div class="form-group col-md-5">
                        <label for="name">CEP</label>
                        <input type="text" id="cep" class="form-control" name="pessoa['cep']" />
                    </div>
                    
                    <div class="form-group col-md-5">
                        <label for="name">Ponto de referencia</label>
                        <input type="text" class="form-control" name="pessoa['ponto_referencia']" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Cidade</label>
                        <select id='cidade' class="form-control" name="pessoa['cidade_id_cidade']">
                            <option value="SELECIONE A CIDADE">SELECIONE A CIDADE...</option>
                            <?php
                                if ($cidades) {
                                    foreach ($cidades as $cidade) : ?>
                                        <option value="<?php echo $cidade['id_cidade']; ?>"><?php echo $cidade['descricao']; ?> - <?php echo $cidade['sigla']; ?></option>
                            <?php   endforeach;
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-7">
                        <label>Observação</label>
                        <textarea class="form-control" rows="3" name="pessoa['observacao']" placeholder="Digite aqui ..."></textarea>
                    </div>                                        

                    
                    



