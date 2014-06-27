$().ready(function () {
    if($("#typ_obiektu_form")) {
        $("#typ_obiektu_form").validate({ // initialize the plugin
            rules: {
                nazwa: "required",
                kategoria: "required",
                cena: {
                    required: true,
                    number: true
                }
            },
            messages: {
                nazwa: "Popraw",
                kategoria: "Popraw",
                cena: "Popraw"
            }
        });
    }
});
