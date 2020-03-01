$(function () {

    console.info('CEP carregado...');

    $('#postal_code').on('blur', function (e) {
        e.preventDefault();
        var postal_code = $(this).val().replace(/\D/g, '');
        var form = $(this).closest("form");

        if (postal_code != "") {
            block();
            //$('.postal_code-input + .fa').show();
            $.getJSON("//viacep.com.br/ws/" + postal_code + "/json/?callback=?", function (dados) {
                if (!("erro" in dados)) {
                    $(form).find("input[name='address']").val(dados.logradouro);
                    $(form).find("input[name='complement']").val(dados.complemento);
                    $(form).find("input[name='neighborhood']").val(dados.bairro);
                    $(form).find("input[name='city']").val(dados.localidade);
                    $(form).find("input[name='state']").val(dados.uf);
                    var newOption = new Option((dados.localidade + " - " + dados.uf), dados.ibge, false, false);
                    $('#city_id').append(newOption).trigger('change');

                    $('#city_id').val(dados.ibge);
                    $('#city_id').trigger('change');
                    console.info(dados);
                }
            }).always(function () {

                $.unblockUI();
                $('#number').focus();
            });
        }
    });
});