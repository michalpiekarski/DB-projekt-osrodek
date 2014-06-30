<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?php
            include 'head_css.php';
            include 'validation.php';
        ?>

        <script type="text/javascript" src="/bazy/js/validation_rejestracja.php"></script>
    </head>
    <body>

        <?php
            $page = "register";
            include 'nav.php';

            include 'db_connect.php';
            if(!$con) {
                header('Refresh: 0; url=error.php?error_type=connect');
            }
            if(!isset($_POST['button']) and isset($_POST['register'])) {
                include 'rejestracja_dane_klienta.php';
            }
            else {
                $login = $_POST['login'];
                $haslo = $_POST['password'];
                $remember = $_POST['remember'];
                $url = $_POST['url'];

                $konto = oci_parse($con, "INSERT INTO DANE_LOGOWANIA (LOGIN, HASLO, TYP) VALUES ('$login', '$haslo', 'klient')");
                if(!oci_execute($konto)) {
                    header('Refresh: 0; url=error.php?error_type=execute');
                }
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $ulica = $_POST['ulica'];
                $mieszkanie = $_POST['mieszkanie'];
                $kod_pocztowy = $_POST['kod_pocztowy'];
                $miasto = $_POST['miasto'];
                $telefon = $_POST['telefon'];
                $email = $_POST['email'];

                $klient = oci_parse($con, "INSERT INTO KLIENCI (IMIE, NAZWISKO, ULICA, MIESZKANIE, KOD_POCZTOWY, MIASTO, TELEFON, EMAIL) VALUES ('$imie','$nazwisko','$ulica', '$mieszkanie', '$kod_pocztowy', '$miasto', '$telefon','$email')");
                if(!oci_execute($klient)) {
                    header('Refresh: 0; url=error.php?error_type=execute');
                }
                include 'rejestracja_podsumowanie.php';
            }
            oci_close($con);
        ?>

    </body>
</html>
