/*
 * toUpperCase or toLowerCase
 */
$(document).ready(function () {
    $(".form-control").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });
});

$(document).ready(function () {
    $("#email").keyup(function () {
        $(this).val($(this).val().toLowerCase());
    });
});
/*
 * Listagem
 */
$(document).ready(function () {
    $('#cliente').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});

$(document).ready(function () {
    $('#legenda_profissional').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});

$(document).ready(function () {
    $('#extrato_caixa').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});

$(document).ready(function () {
    $('#encerra_venda').DataTable({
        'paging': false,
        'lengthChange': true,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});

$(document).ready(function () {
    $('#item_venda').DataTable({
        'paging': false,
        'lengthChange': true,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});

/*
 * Data
 */

$(function () {
    var now = new Date();       
    $('#start').datetimepicker({
        locale: 'pt-br',
        defaultDate: now,        
        icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
    });
});

$(function () { 
    var now = new Date();
    $('#end').datetimepicker({
        locale: 'pt-br',
        defaultDate: now,        
        icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
    });
});

$(function () {
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        language: 'pt-BR',
        autoclose: true
    });           
    $('#datepicker').mask('99-99-9999');
});

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        language: "pt-Br"
    });
    
    $('#select10').select2({
        maximumSelectionLength: 1
    });
    
    $('#servico').select2({
        maximumSelectionLength: 1
    });
});

$('#delete-modal-item-venda').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var item = button.data('delete');
    console.log(item);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + item);
    modal.find('#confirm').attr('href', '../vendas/delete_item_venda.php?id=' + item);
});

$('#delete-modal-cliente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var pessoa = button.data('delete');
    console.log(pessoa);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + pessoa);
    modal.find('#confirm').attr('href', '../cadastros/delete_cliente.php?id=' + pessoa);
});

$('#delete-modal-fornecedor').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var pessoa = button.data('delete');
    console.log(pessoa);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + pessoa);
    modal.find('#confirm').attr('href', '../cadastros/delete_fornecedor.php?id=' + pessoa);
});

$('#delete-modal-profissional').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var pessoa = button.data('delete');
    console.log(pessoa);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + pessoa);
    modal.find('#confirm').attr('href', '../cadastros/delete_profissional.php?id=' + pessoa);
});

$('#delete-modal-produto').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var produto = button.data('delete');
    console.log(produto);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + produto);
    modal.find('#confirm').attr('href', '../cadastros/delete_produto.php?id=' + produto);
});

$('#delete-modal-tipo_servico').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var tipo_servico = button.data('delete');
    console.log(tipo_servico);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + tipo_servico);
    modal.find('#confirm').attr('href', '../cadastros/delete_tipo_servico.php?id=' + tipo_servico);
});

$('#delete-modal-servico').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var servico = button.data('delete');
    console.log(servico);
    var modal = $(this);
    modal.find('.modal-title').text('Excluir registro #' + servico);
    modal.find('#confirm').attr('href', '../cadastros/delete_servico.php?id=' + servico);
});

$("#preco").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ""
});

$("#tempo").maskMoney({
    showSymbol: true,
    decimal: "."
});

$("#valor_servico").maskMoney({
    showSymbol: true,
    symbol: "R$",
    precision: 2,
    decimal: ".",
    thousand: ""
});

$("#valor_total").maskMoney({
    showSymbol: true,
    symbol: "R$",
    precision: 2,
    decimal: ".",
    thousand: ""
});

$("#valor_inicial_caixa").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ''
});

$("#valor_fechamento").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ''
});

$("#valor_reforco").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ''
});

$("#valor_sangria").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ''
});

$("#valor_vale").maskMoney({
    showSymbol: true,
    symbol: "R$",
    decimal: ".",
    thousand: ''
});

function aplicaMascara(opcao) {
    if (opcao == 'F') {        
        $('#lbl_cpf_cnpj').html('CPF');
        $('#lbl_rg_ie').html('RG');
        $('#lbl_nome').html('Nome');
        $('#lbl_apelido').html('Nome/Apelido');
        $('#lbl_data').html('Data nascimento');
        $('#lbl_sexo').html('Sexo');        
        document.getElementById("sexo").removeAttribute("disabled");
        document.getElementById("cpf").setAttribute("onfocus", "mascaraCPF_RG()");
    } else if (opcao == 'J') {        
        $('#lbl_cpf_cnpj').html('CNPJ');
        $('#lbl_rg_ie').html('Insc. Estadual');
        $('#lbl_nome').html('Razão Social');
        $('#lbl_apelido').html('Nome Fantasia');
        $('#lbl_data').html('Data fundação');
        document.getElementById("sexo").setAttribute("disabled", true);
        document.getElementById("cpf").setAttribute("onfocus", "mascaraCNPJ_IE()");
        document.getElementById("rg").setAttribute("onfocus", "mascaraCNPJ_IE()");
    }
}

function produtoServico(escolha) {
    if (escolha == 'P') {        
        $('#lbl_produto_servico').html('Produto');
        document.getElementById("quantidade").removeAttribute("disabled");
    } else if (escolha == 'S') {        
        $('#lbl_produto_servico').html('Serviço');
        document.getElementById("quantidade").setAttribute("disabled", true);
        document.getElementById("quantidade").value = '';        
    }
}

jQuery(function ($) {    
    var opcao = "F";
    
    $('#telefone').mask('(00)0000-00009');
    $('#celular').mask('(00)00000-0000');
    $('#celular2').mask('(00)00000-0000');

    $('#cep').mask('00000-000');
    
    if (!document.getElementById('tipo')) {
        aplicaMascara(opcao);
    } else {
        var opcao = document.getElementById('tipo').value;
        aplicaMascara(opcao);
    }
    

});

function mascaraCPF_RG() {
    $('#cpf').mask('999.999.999-99');
}

function mascaraCNPJ_IE() {
    $('#cpf').mask('99.999.999/9999-99');
    $('#rg').mask('999.999.999.999');
}

function valida_cpf(cpf) {
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    cpf = $('#cpf').val().replace(/[.-]/gi, "");
    
    digitos_iguais = 1;
    console.log("CPF" +"-"+cpf);
    
    if (cpf.length < 11)
        return false;

    for (i = 0; i < cpf.length-1; i++){
        console.log("I e cpf.length - "+i +"-"+cpf.length-1);
        if (cpf.charAt(i) != cpf.charAt(i+1)) {
            digitos_iguais = 0;
            break;
        }
        console.log("Digitos iguais "+digitos_iguais);
    }

    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;

        for (i = 10; i > 1; i--){
            soma += numeros.charAt(10 - i) * i;
            console.log("Soma "+soma);
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        
        console.log("Numeros "+numeros);
        console.log("Digitos "+digitos);
        console.log("Resultado "+resultado);

        if (resultado != digitos.charAt(0))
            return false;

        return true;
    } else
        return false;
}

function valida_cpf_2(cpf) {
    var soma;
    var resto;
    soma = 0;
    
    cpf = $('#cpf').val().replace(/[.-]/gi, "");
    console.log("CPF" +"-"+cpf);
    
    if (cpf.length < 11) return false;
    
    for (i=1; i<=9; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i);    
    
    resto = (soma * 10) % 11;    
    if ((resto == 10) || (resto == 11)) resto = 0;    
    
    if (resto != parseInt(cpf.substring(9,10))) return false;
    
    soma = 0;                
    for (i = 1; i <= 10; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
  
    
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;   
    
    if (resto != parseInt(cpf.substring(10,11))) return false;   
    
    return true;
}


function valida_cnpj(cnpj) {    
    var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    cnpj = $('#cpf').val().replace(/[^\d]+/g, "");
    
    digitos_iguais = 1;
    if (cnpj.length != 14)
        return false;

    for (i = 0; cnpj.length - 1; i++)
        if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
            digitos_iguais = 0;
            break;
        }

    if (!digitos_iguais) {
        tamanho = cnpj.length - 2;
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;

        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);       
        soma = 0;
        pos = tamanho - 7;

        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        return true;
    } else
        return false;
}

function cpf_cnpj() {      
    if (!document.getElementById("tipo")) {
        if (valida_cpf_2(document.getElementById("cpf").value) == false) {
            alert("CPF inválido!!");
            document.getElementById("cpf").focus();            
        } 
    } else {
        if (document.getElementById("tipo").value == "J" && valida_cnpj(document.getElementById("cpf").value) == false) {           
            alert("CNPJ inválido aqui!!");
            document.getElementById("cpf").focus();            
        } else if (document.getElementById("tipo").value == "F" && valida_cpf_2(document.getElementById("cpf").value) == false) {            
            alert("CPF inválido!!");
            document.getElementById("cpf").focus();            
        }
    }
}

function valida_campos() {
    var validado = 'n';
        
    
    if (!document.getElementById("cpf").value) {
        alert("Digite o número do documento!!");
        document.getElementById("cpf").focus();        
    } else if (!document.getElementById("nome").value) {
        alert("Digite o nome!!");
        document.getElementById("nome").focus();
    } else if (!document.getElementById("celular").value) {
        alert("Informe o número do celular");
        document.getElementById("celular").focus();
    } else if (!document.getElementById("cidade").value) {
        alert("Informe uma cidade, para concluir o cadastro");
        document.getElementById("celular").focus();
    } else if (document.getElementById("tipo")){
        if (document.getElementById("tipo").value == "J" && valida_cnpj(document.getElementById("cpf").value) == false) {           
            alert("CNPJ inválido aqui!!");
            document.getElementById("cpf").focus();            
        } else if (document.getElementById("tipo").value == "F" && valida_cpf_2(document.getElementById("cpf").value) == false) {            
            alert("CPF inválido!!");
            document.getElementById("cpf").focus();            
        } else {
            validado = 's';
        }
    } else {
        validado = 's';
    }
    
    if (validado == 's') {
        var formulario = document.getElementById("form");
        formulario.submit();
    }
}

$(document).ready(function() {
    $('#exampleInputFile').on('change',function(){
        var visualizar = $('#visualizar');
        visualizar.empty();
        
        var reader = new FileReader();
        reader.onload = function(e) {
            $("<img />", {
                "src": e.target.result,
                "class": "img-thumbnail"
            }).appendTo(visualizar);
        }
        visualizar.show();
        reader.readAsDataURL($(this)[0].files[0]);
    });
});

function altera_situacao(situacao) {
    if (document.getElementById("situacao").value == 'I') {
        alert ('Este cadastro não poderá ser utilizado, enquanto permanecer inativo');
    }        
};

function somaProduto() {
    var valor_unitario = document.getElementById('valor_unitario').value;
    var quantidade = document.getElementById('quantidade').value;
    
    var total = valor_unitario * quantidade;
    
    document.getElementById('valor_total').value = total;    
};

function atualizar_valor_total() {
    var id = document.getElementById('venda_id_venda').value;
    var inp = '';
    $.post('../../dao/valor_venda_dao.php', {vlrid:id}, function(valor) {
        $.each(valor, function(index, value) {           
           inp = value.valor_total;
           document.getElementById('total_venda_receber').value = inp;
        });
        $('#valor').html('<h3>Total venda R$ <label>'+inp+'</label></h3>');                
        $('#total_venda_receber').html(inp);
        document.getElementById("valor_pago").value = inp;
    }, 'json');
};

function forma(forma) {        
    if (forma == 'D') { //DINHEIRO
        $("#prazo option[value='V']").remove();$("#prazo option[value='P']").remove();
        $('#prazo').append('<option value="V">À vista</option><option value="P">Prazo</option>'); 
        document.getElementById("parcelas").setAttribute("disabled", true);
        document.getElementById("valor_pago").removeAttribute("disabled");
        document.getElementById("valor_restante").removeAttribute("disabled");
        
    } else if (forma == 'C') { //CHEQUE
        $("#prazo option[value='V']").remove();$("#prazo option[value='P']").remove();
        $('#prazo').append('<option value="P">Prazo</option>');
        document.getElementById("parcelas").removeAttribute("disabled");
        $("#lbl_parcelas").html("Parcelas cheque");
        document.getElementById("valor_pago").setAttribute("disabled", true);
        document.getElementById("valor_restante").setAttribute("disabled", true);
        
    } else if (forma == 'CC') { //CARTÃO DE CREDITO
        $("#prazo option[value='V']").remove();$("#prazo option[value='P']").remove();
        $('#prazo').append('<option value="P">Prazo</option>');
        document.getElementById("parcelas").removeAttribute("disabled");
        $("#lbl_parcelas").html("Parcelas cartão");       
        document.getElementById("valor_pago").setAttribute("disabled", true);
        document.getElementById("valor_restante").setAttribute("disabled", true);
        
    } else if (forma == 'CD') { //CARTÃO DE DEBITO
        $("#prazo option[value='V']").remove();$("#prazo option[value='P']").remove();    
        $('#prazo').append('<option value="V">À vista</option>');
        document.getElementById("parcelas").setAttribute("disabled", true);
        document.getElementById("valor_pago").removeAttribute("disabled");
        document.getElementById("valor_restante").removeAttribute("disabled");
    }
    
    
};

function condicao_pagamento(prazo) {       
    console.log("Prazo "+prazo);
    if (prazo == 'V') {
        var total_venda_receber = 0;
        document.getElementById("valor_restante").value = '';
        document.getElementById("valor_restante").setAttribute("disabled", true);
        
        total_venda_receber = document.getElementById("total_venda_receber").value;
        document.getElementById("valor_pago").value = total_venda_receber;
    } else if (prazo == 'P'){     
        document.getElementById("valor_restante").removeAttribute("disabled");
        $("#valor_pago").focus();
    } 
};

function calcula_parcela() {
    var vlr_pago = 0;
    var vlr_restante = 0;
    var total = 0;
    var vlr_parcela = 0;
    var parcelas = 0;
    
    parcelas = document.getElementById("parcelas").value;
    vlr_pago = document.getElementById("valor_pago").value;
    total = document.getElementById("total_venda_receber").value;

    document.getElementById("valor_pago").value = vlr_pago;
    
    vlr_restante = (total-vlr_pago);           
    document.getElementById("valor_restante").value = vlr_restante.toFixed(2);
    
    vlr_parcela = (total/parcelas);
    
    if (parcelas > 0) {
        $('#lbl_valor_parcela').html('Valor parcela');
        $('#valor_parcela').html('R$ '+vlr_parcela);
    } else {
        $('#lbl_valor_parcela').html('');
        $('#valor_parcela').html('');
    }
    
    
    console.log("Total "+total);
    console.log("Valor pago "+vlr_pago);
    console.log("Valor pago "+vlr_parcela);
    console.log("Valor restante "+vlr_restante);
};
