<?php
    require_once ('../../config.php');
    require_once ('../../valida_cookie.php');
    include_once ('../../dao/caixa_dao.php');

    extrato_caixa();

    include(REPORT_HEADER);


?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Extrato caixa</h2>
                    </div>

                    <div class="clearfix"></div>

                    <div class="box-body">
                        <table id="extrato_caixa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Data/hora abertura</th>
                                    <th>Valor inicial</th>
                                    <th>Tipo Sangria</th>
                                    <th>Total Sangria</th>
                                    <th>Tipo Vale</th>
                                    <th>Total Vale</th>
                                    <th>Total Reforco</th>
                                </tr>
                            </thead>
                            <tboby>
                                <?php if ($extrato_caixa) {
                                    foreach ($extrato_caixa as $extrato) :
                                ?>
                                        <tr>
                                            <td><?php echo $extrato['usuario']; ?></td>
                                            <td><?php echo $extrato['abertura_caixa']; ?></td>
                                            <td><?php echo $extrato['valor_inicial']; ?></td>
                                            <td><?php echo $extrato['tipo_sangria']; ?></td>
                                            <td><?php echo $extrato['total_sangria']; ?></td>
                                            <td><?php echo $extrato['tipo_vale']; ?></td>
                                            <td><?php echo $extrato['total_vale']; ?></td>
                                            <td><?php echo $extrato['total_reforco']; ?></td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="2">Nenhum registro encontrado!</td>
                                    </tr>
                                <?php
                                } ?>
                            </tboby>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include(REPORT_FOOTER); ?>