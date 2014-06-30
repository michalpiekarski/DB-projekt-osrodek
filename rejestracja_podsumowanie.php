<form action="login_verify.php" method="post" class="basic-grey">
    <h1>Dodano klienta</h1>

    <h2>
        <div class="wizard-steps">
            <div class="completed-step">
                <a><span>1</span> Dane klienta</a>
            </div>
            <div class="active-step">
                <a><span>2</span> Podsumowanie</a>
            </div>
        </div>
    </h2>

    <p>Twoje konto zostało utowrzone, naciśnij przycisk poniżej, aby się zalogować i przejść do strony głównej.</p>

    <input type="hidden" name="login" value="<?php echo $login; ?>" />
    <input type="hidden" name="password" value="<?php echo $haslo; ?>" />
    <input type="hidden" name="remember" value="<?php echo $remember; ?>" />
    <input type="hidden" name="url" value="<?php echo $url; ?>" />
    <input type="submit" class="button" name="register" value="Przejdź do strony głównej" />
</form>
