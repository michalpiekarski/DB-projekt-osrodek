$().ready(function () {
    if($("#rachunki_otwarte_klient_form")) {
        $("#rachunki_otwarte_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
