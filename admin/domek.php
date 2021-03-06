<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">

    	<?php
    		include('../head_css.php');
            include('../validation.php');
    	?>

        <script type="text/javascript" src="/bazy/js/validation_admin_domek.js"></script>
    </head>
    <body>
        <?php
            $page = "obiekty";
            include('nav.php');

            if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
                include('../db_connect.php');

                if(!isset($_POST['button']) and !isset($_POST['button2'])) {
                    $osrodki = oci_parse($con, "SELECT * FROM OSRODKI");
                    oci_execute($osrodki);
        ?>

        <form id="domek_osrodek_form" action="domek.php" method="post" class="basic-grey">
            <h1>Dodaj domek</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="active-step">
                        <a><span>1</span> Ośrodek</a>
                    </div>
                    <div>
                        <a><span>2</span> Domek</a>
                    </div>
                    <div>
                        <a><span>3</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <label title="Pole jest wymagane">
                <span>Ośrodek* :</span>
                <select name="osrodek">
                    <option value='' selected></option>

                    <?php
                        while($row = oci_fetch_array($osrodki)) {
                            echo "<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                        }
                    ?>

                </select>
            </label>
            <label>
                <span>&nbsp;</span>
                <input type="submit" class="button" name="button" value="Wybierz ośrodek" />
            </label>
        </form>

        <?php
            }
            else if(isset($_POST['button']) and !isset($_POST['button2'])) {
                $osrodek = $_POST['osrodek'];
                $typy_domkow = oci_parse($con, "SELECT * FROM TYPY_OBIEKTOW WHERE NAZWA LIKE '%domek' OR NAZWA LIKE 'Domek%'");
                oci_execute($typy_domkow);

        ?>

        <form id="domek_form" action="domek.php" method="post" class="basic-grey">
            <h1>Dodaj domek</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="completed-step hoverable">
                        <a href="domek.php"><span>1</span> Ośrodek</a>
                    </div>
                    <div class="active-step">
                        <a><span>2</span> Domek</a>
                    </div>
                    <div>
                        <a><span>3</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <?php
                echo"<input type='hidden' name='osrodek' value='$osrodek' />";

            ?>

            <label title="Pole jest wymagane">
                <span>Typ obiektu* :</span>
                <select name="typ">
                    <option value='' selected></option>

                    <?php
                        while($row = oci_fetch_array($typy_domkow)) {
                            echo "<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                        }
                    ?>

                </select>
            </label>
            <!-- Do zmiany na sekwencję SQL czy coś -->
            <label title="Pole jest wymagane">
                <span>Numer* :</span>
                <input type="text" name="numer" placeholder="Numer domku" />
            </label>
            <label>
                <span>&nbsp;</span>
                <input type="submit" class="button" name="button2" value="Dodaj domek" />
            </label>
        </form>

        <?php
            }
            else {
                $osrodek = $_POST['osrodek'];
                $numer = $_POST['numer'];
                $typ = $_POST['typ'];

                $sql_obiektu = "INSERT INTO OBIEKTY (OSRODEK, TYP, BUDYNEK, NUMER) VALUES ('$osrodek', '$typ', null, '$numer')";
                $sql_obiektu_parsed = oci_parse($con, $sql_obiektu);
                oci_execute($sql_obiektu_parsed);
        ?>

        <div class="basic-grey">
            <h1>Podsumowanie</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="completed-step hoverable">
                        <a href="domek.php"><span>1</span> Ośrodek</a>
                    </div>
                    <div class="completed-step">
                        <a><span>2</span> Domek</a>
                    </div>
                    <div class="active-step">
                        <a><span>3</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <h3>Dodano domek</h3>
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
