<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/progres.css">
</head>
<body>

    <?php
        $page = "typy_zamowien";
        include('nav.php');

        if(isset($_COOKIE['logpass'])) {
            $con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
            if(!isset($_POST['button'])) {
    ?>

    <form action="wypozyczenie.php" method="post" class="basic-grey">
        <h1>Dodaj typ wypożyczenia</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Wypożyczenie</a>
                </div>
                <div>
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Nazwa :</span>
            <input type="text" name="nazwa" placeholder="Nazwa" />
        </label>
        <label>
            <span>Cena :</span>
            <input type="number" name="cena" value="10" step="0.01" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj typ wypożyczenia" />
        </label>
    </form>

    <?php
        }
        else {
            $nazwa = $_POST['nazwa'];
            $cena = $_POST['cena'];

            $sql = "INSERT INTO WYPOZYCZENIA (NAZWA, CENA) VALUES ('$nazwa', $cena)";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="wypozyczenie.php"><span>1</span> Wypożyczenie</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano typ wypożyczenia</h3>
    </div>

    <?php
            }
            oci_close($con);
        }
        else {
    ?>

    <div class='basic-grey'>
        <h1>Nie jesteś zalogowany</h1>
        <h3>Aby uzyskać dostęp do systemu zarzdzania ośrodkiem musisz się zalogować</h3>
    </div>

    <?php
        }
    ?>

</body>
</html>
