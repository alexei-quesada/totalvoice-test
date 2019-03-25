$(document).ready(function () {
    //Se endpoint bina estiver selecionado, mostrar input
    if ($("#apiCalls").val() == "bina") {
        $("#cellNumber").removeClass("sr-only");
    }
});

//mostrar input quando seleciona a opção bina, esconde input em outro caso
$("#apiCalls").on("change", function () {
    if (this.value != "bina") {
        $("#cellNumber").addClass("sr-only");
    } else {
        $("#cellNumber").removeClass("sr-only");
    }
});

$("button.btn-info").on("click", function () {

    //obter os valores de accessToken e Endpoint
    accessToken = $('#accessToken').val().trim();
    selectedEndpoint = $('#apiCalls').val();

    //validar accessToken
    if (accessToken == '' || accessToken == undefined) {
        bootbox.alert({
            message: "O token de acesso é obrigatório",
            size: 'small'
        });
    }
    else {
        //validar Endpoint seja selecionado
        switch (selectedEndpoint) {
            case "-1":
                bootbox.alert({
                    message: "Deve selecionar um Endpoint",
                    size: 'small'
                });
                break;
            case "bina":
                //caso Endpoint seja bina obter e validar o telefone
                telefone = $('#cellNumber').val().trim();

                // telefone deve ter um valor
                if (telefone == '' || telefone == undefined) {
                    bootbox.alert({
                        message: "O telefone celular é obrigatório",
                        size: 'small'
                    });
                 // telefone deve ter só números
                } else if (!telefone.match('^[0-9]*$')) {
                    bootbox.alert({
                        message: "O telefone celular está errado",
                        size: 'small'
                    });
                } else {
                    // fazer petiçao ao back-end
                    makeRequest({ endpoint: selectedEndpoint, accessToken: accessToken, telefone: telefone });
                }
                break;
                //fazer petiçao ao back-end
            default: makeRequest({ endpoint: selectedEndpoint, accessToken: accessToken });
        }
    }
});

//limpar textarea
$("button.btn-danger").on("click", function () {
    $('#textResult').val('');
});

//função para fazer petiçao para o back-end
function makeRequest(postData) {
    $.ajax({
        type: "POST",
        url: "app.php",
        data: postData,
        success: function (result) {
            var jsonPretty = JSON.stringify(JSON.parse(result), null, 2);
            $('#textResult').val(jsonPretty);
        }
    });
}
