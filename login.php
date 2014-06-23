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

<script type="text/javascript">
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
</script>

<div id="login" onclick="LoginDialog('none', 1);">
    <div id="dialog_login" class="dialog">
        <h1>Zaloguj</h1>
        <form action="/bazy/login_verify.php" method="post">
            <label>
                <span>Login: </span>
                <input type="text" name="login" placeholder="Login" autofocus tabindex=1 />
            </label>
            <label>
                <span>Hasło: </span>
                <input type="password" name="password" placeholder="Hasło" tabindex=2 />
            </label>
            <label class="remember" title="Zapamiętaj login i hasło na tym komputerze przez 30 dni">
                <span>Zapamiętaj mnie: </span>
                <input type="checkbox" name="remember" value="remember" tabindex=3 />
            </label>
            <input type="hidden" name="url" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
            <div class="buttons">
                <input type="button" class="button" name="cancel" value="Anuluj" onclick="LoginDialog('none', 0);" tabindex=5 />
                <input type="submit" class="button main_button" name="confirm" value="Zaloguj" tabindex=4 />
            </div>
        </form>

        <?php
            $url = parse_url($_SERVER['PHP_SELF']);
            if(!strpos($url['path'], "admin")) {
        ?>

        <hr />
        <div class="mode">
            <input type="button" class="button" name="mode" value="Zarejestruj..." onclick="ChangeMode('register');" tabindex=6 />
        </div>

        <?php
            }
        ?>

    </div>
    <div id="dialog_register" class="dialog">
        <h1>Zarejestruj</h1>
        <form action="register.php" method="post">
            <label>
                <span>Login: </span>
                <input type="text" name="login" placeholder="Login" autofocus tabindex=1 />
            </label>
            <label>
                <span>Hasło: </span>
                <input type="password" name="password" placeholder="Hasło" tabindex=2 />
            </label>
            <label class="remember" title="Zapamiętaj login i hasło na tym komputerze przez 30 dni">
                <span>Zapamiętaj mnie: </span>
                <input type="checkbox" name="remember" value="remember" tabindex=3 />
            </label>
            <input type="hidden" name="url" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
            <div class="buttons">
                <input type="button" class="button" name="cancel" value="Anuluj" onclick="LoginDialog('none', 0);" tabindex=5 />
                <input type="submit" class="button main_button" name="register" value="Zarejestruj" title="Zarejestruj i automatycznie zaloguj" tabindex=4 />
            </div>
        </form>
        <hr />
        <div class="mode">
            <input type="button" class="button" name="mode" value="Zaloguj..." onclick="ChangeMode('login');" tabindex=6 />
        </div>
    </div>
</div>
