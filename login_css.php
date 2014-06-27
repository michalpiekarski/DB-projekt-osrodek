<style type="text/css">
    #login {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
    }
    #login .dialog{
        width: 250px;
        <?php
            $url = parse_url($_SERVER['PHP_SELF']);
            if(!strpos($url['path'], "admin")) {
                echo "height: 270px;";
            }
            else {
                echo "height: 180px;";
            }
        ?>
        margin: 100px auto 0px;
        border-radius: 10px;
        background: #EEE;
        padding: 20px 30px 20px 30px;
        font: 12px Georgia, "Times New Roman", Times, serif;
        color: #888;
        text-shadow: 1px 1px 1px #FFF;
        border:1px solid #DADADA;
    }
    #login .dialog h1 {
        font: 25px Georgia, "Times New Roman", Times, serif;
        padding: 0px 0px 10px 40px;
        display: block;
        border-bottom: 1px solid #DADADA;
        margin: -10px -30px 30px -30px;
        color: #888;
    }
    #login .dialog label {
        display: block;
        margin: 0px 0px 5px;
    }
    #login .dialog label>span {
        text-align: left;
        width: 90px;
        text-align: right;
        padding-right: 10px;
        margin-top: 5px;
        color: #888;
    }
    #login .dialog hr {
        margin-top: 2.5em;
    }
    #login .dialog .button {
        background: #E48F8F;
        border: none;
        padding: 0.8em 1.5em;
        color: #FFF;
    }
    #login .dialog .main_button {
        font-weight: bold;
    }
    #login .dialog .button:hover {
        background: #CF7A7A
    }
    #login .dialog .remember {
        font-size: 0.85em;
        text-align: right;
        padding-right: 1em;
    }
    #login .dialog .buttons {
        margin-top: 1em;
        text-align: center;
    }
    #login .dialog .mode {
        text-align: center;
    }
    #login .dialog .mode .button {
        padding: 1.2em 4em;
    }
    #login .display label input {
        border: 1px solid #DADADA;
        color: #888;
        height: 24px;
        margin-bottom: 16px;
        margin-right: 6px;
        margin-top: 2px;
        outline: 0 none;
        padding: 3px 3px 3px 5px;
        width: 70%;
        font: normal 12px/12px Georgia, "Times New Roman", Times, serif;
    }
    #login #dialog_login {
        display: block;
    }
    #login #dialog_register {
        display: none;
    }
</style>
