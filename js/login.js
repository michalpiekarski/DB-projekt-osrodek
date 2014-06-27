document.getElementsByTagName("head")[0].appendChild(loginStyle);

function LoginDialog(displayStyle, parent) {
    if(parent == 1) {
        if(event.target.id == "login") {
            document.getElementById('login').style.display = displayStyle;
        }
    }
    else {
        document.getElementById('login').style.display = displayStyle;
    }
}
function ChangeMode(mode) {
    if(mode == "register") {
        document.getElementById('dialog_login').style.display = "none";
        document.getElementById('dialog_register').style.display = "block";
    }
    else {
        document.getElementById('dialog_login').style.display = "block";
        document.getElementById('dialog_register').style.display = "none";
    }
}
