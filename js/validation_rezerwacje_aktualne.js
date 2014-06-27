$().ready(function () {
    if($("#rezerwacje_aktualne_klient_form")) {
        $("#rezerwacje_aktualne_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
