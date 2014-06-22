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
    #login #dialog{
        width: 200px;
        height: 200px;
        margin: 100px auto 0px;
        background-color: #EBE8E4;
        padding: 2em;
        border-radius: 10px;
        border: solid 5px lightgrey;
    }
    #login #dialog label {
        display: block;
    }
    #login #dialog #remember {
        font-size: 0.85em;
        float: right;
    }
    #login #dialog #buttons {
        margin-top: 2em;
        text-align: right;
    }
    #login #dialog #buttons input {
        font-size: 2em;
    }
</style>

<script type="text/javascript">
    function LoginDialog(displayStyle) {
        document.getElementById('login').style.display = displayStyle;
    }
</script>

<div id="login">
    <div id="dialog">
        <h1>Zaloguj</h1>
        <form action="login_verify.php" method="post">
            <label>
                <span>Login: </span>
                <input type="text" name="login" placeholder="Login" />
            </label>
            <label>
                <span>Hasło: </span>
                <input type="password" name="password" placeholder="Hasło" />
            </label>
            <label id="remember" title="Zapamiętaj login i hasło na tym komputerze przez 30 dni">
                <span>Zapamiętaj mnie: </span>
                <input type="checkbox" name="remember" value="remember" />
            </label>
            <input type="hidden" name="url" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
            <div id="buttons">
                <input type="button" name="cancel" value="Anuluj" onclick="LoginDialog('none');" />
                <input type="submit" name="button" value="Zaloguj" />
            </div>
        </form>
    </div>
</div>
