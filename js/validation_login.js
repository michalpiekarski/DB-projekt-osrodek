$().ready(function () {
    if($("#login_form").css("display") == "block") {
        $("#login_form").validate({ // initialize the plugin
            rules: {
                login: "required",
                password: "required"
            },
            messages: {
                login: "Popraw",
                password: "Popraw"
            }
        });
    }
    if($("#register_form").css("display") == "block") {
        $("#register_form").validate({ // initialize the plugin
            rules: {
                login: "required",
                password: "required"
            },
            messages: {
                login: "Popraw",
                password: "Popraw"
            }
        });
    }

});
