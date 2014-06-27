$().ready(function () {
    if($("#pracownik_form")) {
        $("#pracownik_form").validate({ // initialize the plugin
            rules: {
                imie: "required",
                nazwisko: "required",
                ulica: "required",
                kod_pocztowy: "required",
                miasto: "required",
                placa: {
                    required: true,
                    number: true
                }
            },
            messages: {
                imie: "Popraw",
                nazwisko: "Popraw",
                ulica: "Popraw",
                kod_pocztowy: "Popraw",
                miasto: "Popraw",
                placa: "Popraw"
            }
        });
    }
});
