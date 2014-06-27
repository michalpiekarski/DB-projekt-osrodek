<?php
    include("login_css.php");
?>

<script type="text/javascript" src="/bazy/js/login.js"></script>

<?php
    include('validation.php');
?>

<script type="text/javascript" src="/bazy/js/validation_login.js"></script>

<div id="login" onclick="LoginDialog('none', 1);">
    <div id="dialog_login" class="dialog">
        <h1>Zaloguj</h1>
        <form id="login_form" action="/bazy/login_verify.php" method="post">
            <label title="Pole jest wymagane">
                <span>Login*: </span>
                <input type="text" name="login" placeholder="Login" autofocus tabindex=1 />
            </label>
            <label title="Pole jest wymagane">
                <span>Hasło*: </span>
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
        <form id="register_form" action="rejestracja.php" method="post">
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
