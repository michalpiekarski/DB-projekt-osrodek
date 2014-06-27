$().ready(function () {

    $("#posilek").validate({ // initialize the plugin
        rules: {

            nazwa: "required",
            cena: {
                required: true,
                number: true
            }
        },
        messages: {
            nazwa: "Popraw",
            cena: "Popraw"
        }
    });
});
