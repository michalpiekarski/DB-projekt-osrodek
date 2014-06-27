$().ready(function () {
    if($("#form")) {
        $("#form").validate({ // initialize the plugin
            rules: {
                osrodek: "required",
                klient: "required"
            },
            messages: {
                osrodek: "Popraw",
                klient: "Popraw"
            }
        });
    }
});
