$().ready(function () {
    if($("#rachunki_zamkniete_klient_form")) {
        $("#rachunki_zamkniete_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
