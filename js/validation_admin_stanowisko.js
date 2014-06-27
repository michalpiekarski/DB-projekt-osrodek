$().ready(function () {
    if($("#stanowisko_form")) {
        $("#stanowisko_form").validate({ // initialize the plugin
            rules: {
                nazwa: "required",
                placa_od: {
                    required: true,
                    number: true
                },
                placa_do: {
                    required: true,
                    number: true
                }
            },
            messages: {
                nazwa: "Popraw",
                placa_od: "Popraw",
                placa_do: "Popraw"
            }
        });
    }
});
