$.validator.addMethod(
    "regex",
    function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please check your input."
);

$().ready(function () {

    $("#rejestracja").validate({ // initialize the plugin
        rules: {
            imie: "required",
            nazwisko: "required",
            ulica:  "required",
            mieszkanie: {
                required: false,
                number: true
            },
            kod_pocztowy: {
                required: true,
                regex: /^\d{2}-\d{3}$/
            },
            miasto: "required",
            email: {
                email: true
            }
        },
        messages: {
            imie: "Popraw",
            nazwisko: "Popraw",
            ulica: "Popraw",
            mieszkanie: "Popraw",
            kod_pocztowy: {
                requred: "Popraw",
                regex: "Zły format"
            },
            miasto: "Popraw",
            email: "Popraw"
        }
    });
});
