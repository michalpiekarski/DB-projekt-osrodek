$().ready(function () {
    if($("#domek_osrodek_form")) {
        $("#domek_osrodek_form").validate({ // initialize the plugin
            rules: {
                osrodek: "required"
            },
            messages: {
                osrodek: "Popraw"
            }
        });
    }
    if($("#domek_form")) {
        $("#domek_form").validate({ // initialize the plugin
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
