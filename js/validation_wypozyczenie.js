$().ready(function () {
    if($("#wypozyczenie_klient_form")) {
        $("#wypozyczenie_klient_form").validate({ // initialize the plugin
            rules: {
                selection: "required"
            },
            messages: {
                selection: "Popraw"
            }
        });
    }
    if($("#wypozyczenie_form")) {
        $("#wypozyczenie_form").validate({ // initialize the plugin
            rules: {
                wypozyczenia: "required",
                wypozyczenia_ilosc: {
                    required: true,
                    number: true
                },
                wypozyczenia_data_od: {
                    required: true,
                    date: true
                },
                wypozyczenia_data_do: {
                    required: true,
                    date: true
                }
            },
            messages: {
                wypozyczenia: "Popraw",
                wypozyczenia_ilosc: "Popraw",
                wypozyczenia_data_od: "Popraw",
                wypozyczenia_data_do: "Popraw"
            }
        });
    }
});
