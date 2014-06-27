$().ready(function () {
    if($("#zamowienia_zakonczone_klient_form")) {
        $("#zamowienia_zakonczone_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
