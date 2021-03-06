<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">

    	<?php
    		include('../head_css.php');
            include('../validation.php');
    	?>

        <script type="text/javascript" src="/bazy/js/validation_admin_pracownik.js"></script>
    </head>
    <body>

        <?php
            $page = "pracownicy";
            include('nav.php');

            if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
                include('../db_connect.php');

                if(!isset($_POST['button'])) {
                    $osrodki = oci_parse($con, "SELECT * FROM OSRODKI");
                    oci_execute($osrodki);
                    $stanowiska = oci_parse($con, "SELECT * FROM STANOWISKA");
                    oci_execute($stanowiska);
                    $sql_maxid = oci_parse($con, "SELECT MAX(ID)+1 MAXID FROM PRACOWNICY");
                    oci_execute($sql_maxid);
                    $maxid = oci_fetch_array($sql_maxid);
        ?>

        <form id="pracownik_form" action="pracownik.php" method="post" class="basic-grey">
            <h1>Dodaj pracownika</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="active-step">
                        <a><span>1</span> Pracownik</a>
                    </div>
                    <div>
                        <a><span>2</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <?php
                echo"<input type='hidden' name='id' value='".$maxid['MAXID']."' />";
            ?>

            <label title="Pole jest wymagane">
                <span>Imię* :</span>
                <input type="text" name="imie" placeholder="Imię" />
            </label>
            <label title="Pole jest wymagane">
                <span>Nazwisko* :</span>
                <input type="text" name="nazwisko" placeholder="Nazwisko" />
            </label>
            <label title="Pole jest wymagane">
                <span>Ulica* :</span>
                <input type="text" name="ulica" placeholder="Ulica" />
            </label>
            <label>
                <span>Mieszkanie :</span>
                <input type="text" name="mieszkanie" placeholder="Mieszkanie" />
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
            <label>
                <span>Stanowisko :</span>
                <select name="stanowisko">
                    <option value='' selected></option>

                    <?php
                        while($row = oci_fetch_array($stanowiska)) {
                            echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                        }
                    ?>

                </select>
            </label>
            <label title="Pole jest wymagane">
                <span>Płaca* :</span>
                <input type="number" name="placa" placeholder="Płaca" step="0.01" />
            </label>
            <label>
                <span>Ośrodek :</span>
                <select name="osrodek">
                    <option value='' selected></option>

                    <?php
                        while($row = oci_fetch_array($osrodki)) {
                            echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                        }
                    ?>

                </select>
            </label>
            <label>
                <span>&nbsp;</span>
                <input type="submit" class="button" name="button" value="Dodaj pracownika" />
            </label>
        </form>

        <?php
            }
            else {
                $id = $_POST['id'];
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $ulica = $_POST['ulica'];
                $mieszkanie = null;
                if(isset($_POST['mieszkanie'])) {
                    $mieszkanie = $_POST['mieszkanie'];
                }
                $kod_pocztowy = $_POST['kod_pocztowy'];
                $miasto = $_POST['miasto'];
                $telefon = null;
                if(isset($_POST['telefon'])) {
                    $telefon = $_POST['telefon'];
                }
                $email = null;
                if(isset($_POST['email'])) {
                    $email = $_POST['email'];
                }
                $stanowisko = $_POST['stanowisko'];
                $placa = $_POST['placa'];
                $osrodek = $_POST['osrodek'];

                $sql = "INSERT INTO PRACOWNICY (ID, IMIE, NAZWISKO, ULICA, MIESZKANIE, KOD_POCZTOWY, MIASTO, TELEFON, EMAIL, STANOWISKO, PLACA, OSRODEK) VALUES ($id, '$imie', '$nazwisko', '$ulica', '$mieszkanie', '$kod_pocztowy', '$miasto', '$telefon', '$email', '$stanowisko', $placa, '$osrodek')";
                $sql_parsed = oci_parse($con, $sql);
                oci_execute($sql_parsed);
        ?>

            <div class="basic-grey">
                <h1>Powodzenie</h1>

                <h2>
                    <div class="wizard-steps">
                        <div class="completed-step hoverable">
                            <a href="pracownik.php"><span>1</span> Pracownik</a>
                        </div>
                        <div class="active-step">
                            <a><span>2</span> Podsumowanie</a>
                        </div>
                    </div>
                </h2>

                <h3>Dodano pracownika</h3>
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
