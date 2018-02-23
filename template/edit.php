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
            <form action="edit_<?php echo $_SESSION['tipo']; ?>.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" id="form" method="post">
                <div class="box-body">
                    <input type="hidden" name="pessoa['id_pessoa']" value="<?php echo $pessoa['0']['id_pessoa'] ?>" />
                    <input type="hidden" name="<?php echo $_SESSION['tipo']; ?>['pessoa_id_pessoa']" value="<?php echo $pessoa['0']['id_pessoa'] ?>" />

                    <?php if ($_SESSION['tipo'] === 'cliente') { ?>                        
                        <div class="form-group col-md-10">                            
                            <label for="exampleInputFile">Foto</label>                                                                                   
                            <div class="col-sm-2 pull-left">
                                <img class="img-thumbnail" src="<?php echo BASEURL ?>fotos/<?php echo $pessoa['0']['foto'] ?>" />
                            </div>
                            <input type="file" name="foto" id="exampleInputFile">                                                        
                        </div>                        
                    <?php } ?>
                                                            
                    <?php
                    if ($_SESSION['tipo'] === 'fornecedor') {
                    ?>
                        <div class="form-group col-md-10">
                            <div class="form-group col-md-2">
                                <label for="name">Tipo pessoa</label>
                                <select id='tipo' class="form-control" name="pessoa['tipo_pessoa']" onchange="aplicaMascara(this.value);">
                                    <?php if ($pessoa['0']['tipo_pessoa'] === 'J') { ?>
                                        <option value="<?php echo $pessoa['0']['tipo_pessoa']; ?>">JURIDICA</option>
                                    <?php } else { ?>                                
                                            <option value="<?php echo $pessoa['0']['tipo_pessoa']; ?>">FISICA</option>
                                    <?php } ?>
                                    <option value="J">JURIDICA</option>
                                    <option value="F">FISICA</option>
                                </select>
                            </div>
                        </div>                        
                    <?php
                    }
                    ?>
                    
                    <?php if ($_SESSION['tipo'] === 'profissional') { ?>                                                    
                        <div class="form-group col-md-10">    
                            <div class="form-group col-md-2">
                                <label>Cor agenda</label>                                                        
                                <select name="profissional['cor']" id="new_color" class="form-control">
                                    <?php
                                        $cor = $pessoa['0']['cor'];
                                        
                                        switch ($cor) {
                                            case "#FFD700":
                                                echo '<option value="#FFD700" style="color: #FFD700">&#9724; OURO</option>';
                                                break;
                                            case "#0073b7":
                                                echo '<option value="#0073b7" class="text-blue">&#9724; AZUL</option>';
                                                break;
                                            case "#3c8dbc":
                                                echo '<option value="#3c8dbc" class="text-light-blue">&#9724; AZUL CLARO</option>';
                                                break;
                                            case "#8B008B":
                                                echo '<option value="#8B008B" style="color: #8B008B">&#9724; MAGENTA</option>';
                                                break;
                                            case "#FFFF00":
                                                echo '<option value="#FFFF00" style="color: #ffff00">&#9724; AMARELO</option>';
                                                break;
                                            case "#ff851b":
                                                echo '<option value="#ff851b" class="text-orange">&#9724; LARANJA</option>';
                                                break;
                                            case "#00a65a":
                                                echo '<option value="#00a65a" class="text-green">&#9724; VERDE</option>';
                                                break;
                                            case "#01ff70":
                                                echo '<option value="#01ff70" class="text-lime">&#9724; VERDE LIMÃO</option>';
                                                break;
                                            case "#dd4b39":
                                                echo '<option value="#dd4b39" class="text-red">&#9724; VERMELHO</option>';
                                                break;
                                            case "#605ca8":
                                                echo '<option value="#605ca8" class="text-purple">&#9724; ROXO</option>';
                                                break;
                                            case "#f012be":
                                                echo '<option value="#f012be" class="text-fuchsia">&#9724; ROSA</option>';
                                                break;
                                            case "#7a869d":
                                                echo '<option value="#7a869d" class="text-muted">&#9724; CINZA</option>';
                                                break;
                                            case "#001f3f":
                                                echo '<option value="#001f3f" class="text-navy">&#9724; PRETO</option>';
                                                break;
                                            default :
                                                echo '<option value="">Selecione a cor</option>';
                                        }
                                    ?>                                    
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
                        </div>
                    <?php } ?>
                        
                    <div class="form-group col-md-2">
                        <label for="name" id="lbl_situacao">Situação</label>
                        <select id='situacao' class="form-control" name="<?php echo $_SESSION['tipo']; ?>['situacao']" value="<?php echo $pessoa['0']['situacao']; ?>" onchange="altera_situacao(this.value);">
                            <?php if ($pessoa['0']['situacao'] === 'A') { ?>
                                <option value="<?php echo $pessoa['0']['situacao'] ?>">ATIVO</option>
                            <?php } else { ?>                                
                                    <option value="<?php echo $pessoa['0']['situacao'] ?>">INATIVO</option>
                            <?php } ?>
                            <option value="A">ATIVO</option>
                            <option value="I">INATIVO</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label id="lbl_nome" for="name">Nome</label>
                        <input type="text" class="form-control" id="nome" name="pessoa['nome']" value="<?php echo $pessoa['0']['nome']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label id="lbl_apelido" for="name">Nome/Apelido</label>
                        <input type="text" class="form-control" name="pessoa['nome_apelido']" value="<?php echo $pessoa['0']['nome_apelido']; ?>" />
                    </div>
                    
                     <?php
                        if ($pessoa['0']['data_nascimento']) {
                            $aux = explode('-', $pessoa['0']['data_nascimento']);
                            $data = "$aux[2]-$aux[1]-$aux[0]";                            
                        }
                     ?>
                        
                    <div class="form-group col-md-3">
                        <label id="lbl_data" for="name">Data nascimento</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker" name="data_nascimento" value="<?php echo $data; ?>" />
                        </div>
                    </div>                   

                    <div class="form-group col-md-3">
                        <label for="name" id="lbl_cpf_cnpj">CPF</label>
                        <input type="text" id="cpf" class="form-control" onchange="cpf_cnpj();" name="pessoa['cpf_cnpj']" value="<?php echo $pessoa['0']['cpf_cnpj']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name" id="lbl_rg_ie">RG</label>
                        <input type="text" id="rg" class="form-control" name="pessoa['rg_ie']" value="<?php echo $pessoa['0']['rg_ie']; ?>" />
                    </div>
                                                               
                    <div class="form-group col-md-2">                   
                        <label for="name" id="lbl_sexo">Sexo</label>
                        <select id='sexo' class="form-control" name="pessoa['sexo']">
                            <option value="<?php echo $pessoa['0']['sexo'] ?>"><?php echo $pessoa['0']['sexo'] ?></option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMININO</option>
                        </select>                    
                    </div>                    

                    <div class="clearfix"></div>

                    <div class="form-group col-md-4">
                        <label for="name">E-mail</label>
                        <input type="text" class="form-control" id="email" name="pessoa['email']" value="<?php echo $pessoa['0']['email']; ?>" />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="name">Telefone</label>
                        <input type="text" id="telefone" class="form-control" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" name="pessoa['telefone']" value="<?php echo $pessoa['0']['telefone']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Celular</label>
                        <input type="text" id="celular" class="form-control" name="pessoa['celular']" value="<?php echo $pessoa['0']['celular']; ?>" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Celular contato</label>
                        <input type="text" id="celular2" class="form-control" name="pessoa['celular_2']" value="<?php echo $pessoa['0']['celular_2']; ?>" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Endereço</label>
                        <input type="text" class="form-control" name="pessoa['endereco']" value="<?php echo $pessoa['0']['endereco']; ?>" />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="name">Numero</label>
                        <input type="text" class="form-control" name="pessoa['numero']" value="<?php echo $pessoa['0']['numero']; ?>" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Complemento</label>
                        <input type="text" class="form-control" name="pessoa['complemento']" value="<?php echo $pessoa['0']['complemento']; ?>" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Bairro</label>
                        <input type="text" class="form-control" name="pessoa['bairro']" value="<?php echo $pessoa['0']['bairro']; ?>" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">CEP</label>
                        <input type="text" id="cep" class="form-control" name="pessoa['cep']" value="<?php echo $pessoa['0']['cep']; ?>" />
                    </div>

                    <div class="form-group col-md-5">
                        <label for="name">Ponto de referencia</label>
                        <input type="text" class="form-control" name="pessoa['ponto_referencia']" value="<?php echo $pessoa['0']['ponto_referencia']; ?>" />
                    </div>
                    
                    <?php
                        $cidade_pessoa = find('cidade', 'id_cidade', $pessoa['0']['cidade_id_cidade']);
                    ?>

                    <div class="form-group col-md-5">
                        <label for="name">Cidade</label>
                        <select id='cidade' class="form-control" name="pessoa['cidade_id_cidade']">
                            <?php
                                if ($cidade_pessoa) {
                                    foreach ($cidade_pessoa as $cidade) : ?>
                                        <option value="<?php echo $cidade['id_cidade']; ?>"><?php echo $cidade['descricao']; ?></option>
                            <?php   endforeach;
                                }
                            ?>
                            
                            <?php
                                if ($cidades) {
                                    foreach ($cidades as $cidade) : ?>
                                        <option value="<?php echo $cidade['id_cidade']; ?>"><?php echo $cidade['descricao']; ?> - <?php echo $cidade['sigla']; ?></option>
                            <?php   endforeach;
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label>Observação</label>
                        <textarea class="form-control" rows="3" name="pessoa['observacao']"  placeholder="Digite aqui ..."><?php echo $pessoa['0']['observacao']; ?></textarea>
                    </div>





