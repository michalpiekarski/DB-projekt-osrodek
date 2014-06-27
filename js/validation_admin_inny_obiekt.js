$().ready(function () {
    if($("#inny_obiekt_osrodek_form")) {
        $("#inny_obiekt_osrodek_form").validate({ // initialize the plugin
            rules: {
                osrodek: "required"
            },
            messages: {
                osrodek: "Popraw"
            }
        });
    }
    if($("#inny_obiekt_form")) {
        $("#inny_obiekt_form").validate({ // initialize the plugin
            rules: {
                typ: "required",
                numer: "required"
            },
            messages: {
                typ: "Popraw",
                numer: "Popraw"
            }
        });
    }
});
