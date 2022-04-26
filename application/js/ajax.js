$(function(){
    listar();
    executarAcao();
});

let limparAlerta = () => {
    $('#alerta').html('');
}

// Desbloquear o botão de salvar
var desbloquearBotao = () => {
    $('#btn_salvar').removeAttr('disabled');
}

let alerta = (opcao, resposta) =>{
    let menssagem = "";

    switch (opcao) {
        case "inserir":
           menssagem = "Filme inserido com sucesso."; 
            break;
        case "editar":
            menssagem = "Filme editado com sucesso.";
            break;
        case "remover":
            menssagem = "Filme removido com sucesso.";
            break;
    }


    switch (resposta) {
        case "SALVO":
            $('#alerta').html('<div class="alert alert-success text-center" ><strong>CONCLUIDO! </strong>' + menssagem + '</div>');
            break;
        case "ERROR":
            $('#alerta').html('<div class="alert alert-danger text-center" ><strong>ERRO! </strong>Solicitação não processada.</div>');
            break;
        case "DADOS IGUAIS":
            $('#alerta').html('<div class="alert alert-info text-center" ><strong>ERRO! </strong>Você está enviando os mesmos dados.</div>');
            break;
        case "VAZIO":
            $('#alerta').html('<div class="alert alert-danger text-center" ><strong>ERRO! </strong>Não pode enviar dados vazios.</div>');
            break;
    }
}

let executarAcao = ()=> {
    // Quando clickar no botão salvar faz tudo que está abaixo.
    $('#btn_salvar').on('click', function() {
        // Recebe os dados do modal.
        let opcao = $('#opcao').val();
        let id = $('#id').val();
        let nome = $('#txt_nome').val();
        let genero = $('#txt_genero').val();
        let classificacao = $('#txt_classificacao').val();
        $.ajax({
            beforeSend: function() {    // Antes de enviar mostra um gif de carregamento.
                $('#gif').toggleClass('d-none');
            },
            url: "controllers/controlaAcoes.php",
            method: "POST",
            data: {
                opcao: opcao,
                id: id,
                nome: nome,
                genero: genero,
                classificacao: classificacao
            },
        })
        .done(function(data) {
            $('#gif').toggleClass('d-none'); // tirar essa parte.
            alerta(opcao, data);
            listar('');
            if (opcao == 'remover' && data == 'SALVO') {
                $('#btn_salvar').attr('disabled', true);    // Coloca um atributo inválido no botão de salvar, não permitindo mais clicks.
            }
            if (opcao == "inserir" && data == "SALVO") {
                $('#id').val('');
                $('#txt_nome').val('');
                $('#txt_genero').val('');
                $('#txt_classificacao').val('');
            }
        });        
    });

}

// Função que prepara os dados para o CRUD.
let preparaDados =()=>{
    let values = [];

    // Captura os dados do botão editar e mostra no modal.
    $('#table .editar').on('click', function(){
        values = ciclo($(this));
        $('#opcao').val('editar');
        $('#id').val(values[0]);
        $('#txt_nome').val(values[1]).removeAttr('disabled');   // Remove os atributos de inválido caso tenha colocado em um evento antes.
        $('#txt_genero').val(values[2]).removeAttr('disabled');
        $('#txt_classificacao').val(values[3]).removeAttr('disabled');
        trocarTitulo('Editar Filme');   // Chama função que troca o titulo do modal.
        limparAlerta(); // Chama a função que limpa a div alerta caso já tenha aparecido algo.
        desbloquearBotao(); // Chama a função que desbloqueia o botão de salvar caso em algum momento tenha sido bloquado.
    });
    // Captura os dados do botão remover e mostra no modal.
    $('#table .remover').on('click', function() {
        values = ciclo($(this));
        $('#opcao').val('remover');
        $('#id').val(values[0]);
        $('#txt_nome').val(values[1]).attr('disabled', true);   // Coloca um atributo inválido nas caixa de texto não permitindo mais edições.
        $('#txt_genero').val(values[2]).attr('disabled', true);
        $('#txt_classificacao').val(values[3]).attr('disabled', true);
        trocarTitulo('Remover Filme');   // Chama função que troca o titulo do modal.
        limparAlerta(); // Chama a função que limpa a div alerta caso já tenha aparecido algo.
        desbloquearBotao(); // Chama a função que desbloqueia o botão de salvar caso em algum momento tenha sido bloquado.
    });
    // Remove todos os dados para uma nova inserção e mostra no modal.
    $('#btn_inserir').on('click', function() {
        $('#opcao').val('inserir');
        $('#id').val('');
        $('#txt_nome').val('').removeAttr('disabled');   // Remove os atributos de inválido caso tenha colocado em um evento antes.
        $('#txt_genero').val('').removeAttr('disabled');
        $('#txt_classificacao').val('').removeAttr('disabled');
        trocarTitulo('Cadastrar Filme');   // Chama função que troca o titulo do modal.
        limparAlerta(); // Chama a função que limpa a div alerta caso já tenha aparecido algo.
        desbloquearBotao(); // Chama a função que desbloqueia o botão de salvar caso em algum momento tenha sido bloquado.
    });
}

let ciclo = (seletor) =>{
    let dados = [];
    $(seletor).parents('tr').find('td').each(function(i){
        if(i < 4){ //se não tirar o duracao é5
            dados[i]=$(this).text();   // Captura todos os dados do filme selecionado.
        }
        else{
            return false;
        }
    });
    return dados;
}

let trocarTitulo = (titulo) =>{
    $('.modal-header .modal-title').text(titulo);
}

let listar =()=>{
    $.ajax({
        url: 'controllers/controlaLista.php',
        method: 'POST',
    }).done(function(data) {
        $('#div_tabela').html(data);
        preparaDados();
    });
}
