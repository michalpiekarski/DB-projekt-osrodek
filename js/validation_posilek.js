$().ready(function () {
    if($("#posilek_klient_form")) {
        $("#posilek_klient_form").validate({ // initialize the plugin
            rules: {
                selection: "required"
            },
            messages: {
                selection: "Popraw"
            }
        });
    }
    if($("#posilek")) {
        $("#posilek").validate({ // initialize the plugin
            rules: {
                posilki: "required",
                posilek_ilosc: {
                    required: true,
                    number: true
                },
                posilek_data: {
                    required: true,
                    date: true
                }
            },
            messages: {
                posilki: "Popraw",
                posilek_ilosc: "Popraw",
                posilek_data: "Popraw"
            }
        });
    }
});
