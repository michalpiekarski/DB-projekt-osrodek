$().ready(function () {
    if($("#reservation")) {
        $("#reservation").validate({ // initialize the plugin
            rules: {
                obiekt: "required",
                data_od: {
                    required: true,
                    date: true
                },
                data_do: {
                    required: true,
                    date: true
                },
                ilosc_os: {
                    required: true,
                    number: true
                }
            },
            messages: {
                obiekt: "Popraw",
                data_od: "Popraw",
                data_od: "Popraw",
                ilosc_os: "Popraw"
            }
        });
    }
});
