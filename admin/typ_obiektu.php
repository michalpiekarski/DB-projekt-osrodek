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
        include('nav.php');

        $con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
        if(!isset($_POST['button'])) {
    ?>

    <form action="typ_obiektu.php" method="post" class="basic-grey">
        <h1>Dodaj typ obiektu</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Typ obiektu</a>
                </div>
                <div>
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Nazwa :</span>
            <input type="text" name="nazwa" placeholder="Nazwa typu obiektu" />
        </label>
        <label>
            <span>Ilość miejsc :</span>
            <input type="number" name="ilosc_miejsc" value="1" />
        </label>
        <label>
            <span>Cena :</span>
            <input type="number" name="cena" value="10" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj typ obiektu" />
        </label>
    </form>

    <?php
        }
        else {
            $nazwa = $_POST['nazwa'];
            $ilosc_miejsc = $_POST['ilosc_miejsc'];
            $cena = $_POST['cena'];

            $sql = "INSERT INTO TYPY_OBIEKTOW (NAZWA, ILOSC_MIEJSC, CENA) VALUES ('$nazwa', '$ilosc_miejsc', '$cena')";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step">
                    <a><span>1</span> Typ obiektu</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <p>Dodano typ obiektu</p>
    </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
