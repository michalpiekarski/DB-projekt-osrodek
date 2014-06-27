$().ready(function () {
    if($("#uslugi_klient_form")) {
        $("#uslugi_klient_form").validate({ // initialize the plugin
            rules: {
                selection: "required"
            },
            messages: {
                selection: "Popraw"
            }
        });
    }
    if($("#uslugi_form")) {
        $("#uslugi_form").validate({ // initialize the plugin
            rules: {
                usluga: "required",
                usluga_ilosc: {
                    required: true,
                    number: true
                },
                usluga_data: {
                    required: true,
                    date: true
                }
            },
            messages: {
                usluga: "Popraw",
                usluga_ilosc: "Popraw",
                usluga_data: "Popraw"
            }
        });
    }
});
