<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">

        <?php
            include('../head_css.php');
            include('validation.php');
        ?>

        <script type="text/javascript" src="/bazy/js/validation_admin_osrodek.js"></script>
    </head>
    <body>
        <?php
            $page = "osrodki";
            include('nav.php');

            if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
                include('../db_connect.php');

                if(!isset($_POST['button'])) {
        ?>

        <form id="osrodek_form" action="osrodek.php" method="post" class="basic-grey">
            <h1>Dodaj ośrodek</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="active-step">
                        <a><span>1</span> Ośrodek</a>
                    </div>
                    <div>
                        <a><span>2</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <label title="Pole jest wymagane">
                <span>Nazwa* :</span>
                <input type="text" name="nazwa" placeholder="Nazwa ośrodka" />
            </label>
            <label title="Pole jest wymagane">
                <span>Ulica* :</span>
                <input type="text" name="ulica" placeholder="Ulica" />
            </label>
            <label title="Pole jest wymagane">
                <span>Kod pocztowy* :</span>
                <input type="text" name="kod_pocztowy" placeholder="Kod pocztowy" />
            </label>
            <label title="Pole jest wymagane">
                <span>Miasto* :</span>
                <input type="text" name="miasto" placeholder="Miasto" />
            </label>
            <label>
                <span>Telefon :</span>
                <input type="text" name="telefon" placeholder="Telefon" />
            </label>
            <label>
                <span>E-mail :</span>
                <input type="text" name="email" placeholder="E-mail" />
            </label>
            <label title="Pole jest wymagane">
                <span>Otwarty* :</span>
                <input type="checkbox" name="otwarty"/>
            </label>
            <label>
                <span>&nbsp;</span>
                <input type="submit" class="button" name="button" value="Dodaj ośrodek" />
            </label>
        </form>

        <?php
            }
            else {
                $nazwa = $_POST['nazwa'];
                $ulica = $_POST['ulica'];
                $kod_pocztowy = $_POST['kod_pocztowy'];
                $miasto = $_POST['miasto'];
                $telefon = null;
                if(isset($_POST['telefon']))
                {
                    $telefon = $_POST['telefon'];
                }
                $email = null;
                if(isset($_POST['email']))
                {
                    $email = $_POST['email'];
                }
                $otwarty = 0;
                if(isset($_POST['otwarty']))
                {
                    $otwarty = 1;
                }

                $sql = "INSERT INTO OSRODKI (NAZWA, ULICA, KOD_POCZTOWY, MIASTO, TELEFON, EMAIL, OTWARTY) VALUES ('$nazwa', '$ulica', '$kod_pocztowy', '$miasto', '$telefon', '$email', $otwarty)";
                $sql_parsed = oci_parse($con, $sql);
                oci_execute($sql_parsed);
        ?>

        <div class="basic-grey">
            <h1>Podsumowanie</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="completed-step hoverable">
                        <a href="osrodek.php"><span>1</span> Ośrodek</a>
                    </div>
                    <div class="active-step">
                        <a><span>2</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <h3>Dodano ośrodek</h3>
        </div>

        <?php
                }
                oci_close($con);
            }
            else {
                include('../login_error.php');
            }
        ?>

    </body>
</html>
