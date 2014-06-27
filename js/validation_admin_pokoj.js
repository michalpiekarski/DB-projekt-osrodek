$().ready(function () {
    if($("#pokoj_osrodek_form")) {
        $("#pokoj_osrodek_form").validate({ // initialize the plugin
            rules: {
                osrodek: "required"
            },
            messages: {
                osrodek: "Popraw"
            }
        });
    }
    if($("#pokoj_form")) {
        $("#pokoj_form").validate({ // initialize the plugin
            rules: {
                typ: "required",
                budynek: "required",
                numer: "required"
            },
            messages: {
                typ: "Popraw",
                budynek: "Popraw",
                numer: "Popraw"
            }
        });
    }
});
