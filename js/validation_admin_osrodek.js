$().ready(function () {
    if($("#osrodek_form")) {
        $("#osrodek_form").validate({ // initialize the plugin
            rules: {
                nazwa: "required",
                ulica: "required",
                kod_pocztowy: "required",
                miasto: "required",
                otwarty: "required"
            },
            messages: {
                nazwa: "Popraw",
                ulica: "Popraw",
                kod_pocztowy: "Popraw",
                miasto: "Popraw",
                otwarty: "Popraw"
            }
        });
    }
});
