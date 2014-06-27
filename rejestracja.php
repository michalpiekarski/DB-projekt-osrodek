<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?php
            include('head_css.php');
            include('validation.php');
        ?>

        <script type="text/javascript" src="/bazy/js/validation_rejestracja.php"></script>
    </head>
    <body>

        <?php
            $page = "register";
            include ('nav.php');

            include('db_connect.php');
            if(isset($_POST['register']) and !isset($_POST['button'])) {
        ?>

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

        <?php
            }
            if (isset($_POST['button'])) {

                $login = $_POST['login'];
                $haslo = $_POST['password'];
                $remember = $_POST['remember'];
                $url = $_POST['url'];

                $konto = oci_parse($con, "INSERT INTO DANE_LOGOWANIA (LOGIN, HASLO, TYP) VALUES ('$login', '$haslo', 'klient')");
                oci_execute($konto);

                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $ulica = $_POST['ulica'];
                $mieszkanie = $_POST['mieszkanie'];
                $kod_pocztowy = $_POST['kod_pocztowy'];
                $miasto = $_POST['miasto'];
                $telefon = $_POST['telefon'];
                $email = $_POST['email'];

                $klient = oci_parse($con, "INSERT INTO KLIENCI (IMIE, NAZWISKO, ULICA, MIESZKANIE, KOD_POCZTOWY, MIASTO, TELEFON, EMAIL) VALUES ('$imie','$nazwisko','$ulica', '$mieszkanie', '$kod_pocztowy', '$miasto', '$telefon','$email')");
                oci_execute($klient);

                oci_close($con);
        ?>

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

        <?php
            }
        ?>

    </body>
</html>
