let profissoes = ['Médico', 'Motorista de aplicativo', 'Pescador'];

let items = document.getElementsByClassName("dropdown-item");


function mascaraTelefone(event) {
    let tecla = event.key;
    let telefone = event.target.value.replace(/\D+/g, "");

    if (/^[0-9]$/i.test(tecla)) {
        telefone = telefone + tecla;
        var tamanho = telefone.length;

        if (tamanho >= 12) {
            return false;
        }

        if (tamanho > 10) {
            telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (tamanho > 5) {
            telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (tamanho > 2) {
            telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            telefone = telefone.replace(/^(\d*)/, "($1");
        }

        event.target.value = telefone;
    }

    if (!["Backspace", "Delete"].includes(tecla)) {
        return false;
    }
}



function populaDrop() {
    let contents = []

    $.ajax({
        url: './api/getProfissoes',
        type: "POST",
        dataType: "json",
        success: function (res) {

            $(res).each(function (i, v) {
                contents.push('<input type="button" class="dropdown-item" type="button" profissao_id= "' + v.id + '" value="' + v.profissao_nome + '"/>')

            });
            $('#menuItems').append(contents.join(""))

            $('#vazio').hide()
        },
        error: function (err) {

            /*Se Erro -- Código aqui*/

        }
    });


}

function filtrar(palavra) {
    let tamanho = items.length;
    let esconde = 0;
    var item_lista = '';
    for (let i = 0; i < tamanho; i++) {
        item_lista = removeAcentos(items[i].value);
        if (item_lista.toLowerCase().match(palavra)) {
            $(items[i]).show()
        }
        else {
            $(items[i]).hide()
            esconde++
        }
    }

    if (esconde === tamanho) {
        $('#vazio').show()
    }
    else {
        $('#vazio').hide()
    }
}
var profissao_id = 0;
$(document).on("click", '.dropdown-item', function () {

    profissao_id = $(this).attr('profissao_id');
});

$(document).on('click', '#cadastrar', function (event) {
    // event.preventDefault();
    // $('#sucesso').modal('toggle');

    var d = {};
    d.nome = $("#nome_sobrenome").val().toUpperCase();
    d.email = $("#email").val();
    d.telefone = $("#telefone").val();
    d.profissao_id = profissao_id;

    if (d.nome.length == '' || d.email == '' || d.telefone == '' || d.profissao_id < 1) {
        $('#erro').modal('toggle');
        return;
    }

    $.ajax({
        url: './api/checkin',
        type: "POST",
        dataType: "json",
        data: d,
        success: function (res) {
            $('#sucesso').modal('toggle');
            $("#qrcode").attr('src', 'data:image/png;base64,' + res.imagem.qr_code)


        },
        error: function (err) {

            /*Se Erro -- Código aqui*/

        }
    });
});

$(document).on("click", '#sair', function () {

    location.reload();


});

$(document).ready(function () {
    populaDrop();



    $('#menuItems').on('click', '.dropdown-item', function () {
        $('#dropdown_profissoes').text($(this)[0].value)
        $("#dropdown_profissoes").dropdown('toggle');
    });

    $(document).on("input", '#pesquisa_profissao', function () {

        let pesquisa = $('#pesquisa_profissao').val();
        filtrar(pesquisa.toLowerCase())

    });

});

var _mapRemoverAcentos = { "â": "a", "Â": "A", "à": "a", "À": "A", "á": "a", "Á": "A", "ã": "a", "Ã": "A", "ê": "e", "Ê": "E", "è": "e", "È": "E", "é": "e", "É": "E", "î": "i", "Î": "I", "ì": "i", "Ì": "I", "í": "i", "Í": "I", "õ": "o", "Õ": "O", "ô": "o", "Ô": "O", "ò": "o", "Ò": "O", "ó": "o", "Ó": "O", "ü": "u", "Ü": "U", "û": "u", "Û": "U", "ú": "u", "Ú": "U", "ù": "u", "Ù": "U", "ç": "c", "Ç": "C" };

function removeAcentos(s) {
    return s.replace(/[\W\[\] ]/g, function (a) {
        return _mapRemoverAcentos[a] || a
    })
};
