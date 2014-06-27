$().ready(function () {
    if($("#zamowienia_aktualne_klient_form")) {
        $("#zamowienia_aktualne_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
