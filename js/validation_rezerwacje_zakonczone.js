$().ready(function () {
    if($("#rezerwacje_zakonczone_klient_form")) {
        $("#rezerwacje_zakonczone_klient_form").validate({ // initialize the plugin
            rules: {
                klient: "required"
            },
            messages: {
                klient: "Popraw"
            }
        });
    }
});
