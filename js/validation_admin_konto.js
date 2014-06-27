$().ready(function () {
    if($("#konto_form")) {
        $("#konto_form").validate({ // initialize the plugin
            rules: {
                login: "required",
                password: "required",
                typ: "required"
            },
            messages: {
                login: "Popraw",
                password: "Popraw",
                typ: "Popraw"
            }
        });
    }
});
