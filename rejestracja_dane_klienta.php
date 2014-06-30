<form action="rejestracja.php" id="rejestracja" method="post" class="basic-grey">
    <h1>Rejestracja</h1>

    <h2>
        <div class="wizard-steps">
            <div class="active-step">
                <a><span>1</span> Dane klienta</a>
            </div>
            <div>
                <a><span>2</span> Podsumowanie</a>
            </div>
        </div>
    </h2>

    <label title="Poje jest wymagane">
        <span>Imię* :</span>
        <input type="text" name="imie" placeholder="Pełne imię" />
    </label>
    <label title="Poje jest wymagane">
        <span>Nazwisko* :</span>
        <input type="text"  name="nazwisko" placeholder="Pełne nazwisko" />
    </label>
    <label title="Poje jest wymagane">
        <span>Ulica* :</span>
        <input type="text" name="ulica" placeholder="Ulica" />
    </label>
    <label>
        <span>Mieszkanie :</span>
        <input type="text" name="mieszkanie" placeholder="Numer mieszkania" />
    </label>
    <label title="Poje jest wymagane">
        <span>Kod pocztowy* :</span>
        <input type="text" name="kod_pocztowy" placeholder="Kod Pocztowy" />
    </label>
    <label title="Poje jest wymagane">
        <span>Miasto* :</span>
        <input type="text" name="miasto" placeholder="Miasto" />
    </label>
    <label>
        <span>Telefon:</span>
        <input type="text" name="telefon" placeholder="Numer telefonu" />
    </label>
    <label>
        <span>Email :</span>
        <input type="email" name="email" placeholder="Poprawny adres email" />
    </label>
    <input type="hidden" name="login" value="<?php echo $_POST['login']; ?>" />
    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" />
    <input type="hidden" name="remember" value="<?php echo $_POST['remember']; ?>" />
    <input type="hidden" name="url" value="<?php echo $_POST['url']; ?>" />
    <label>
        <span>&nbsp;</span>
        <input type="submit" class="button" name="button" value="Dodaj klienta" />
    </label>
</form>
