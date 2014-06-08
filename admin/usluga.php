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

    <form action="usluga.php" method="post" class="basic-grey">
        <h1>Dodaj typ usługi</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Usługa</a>
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
            <input type="submit" class="button" name="button" value="Dodaj typ usługi" />
        </label>
    </form>

    <?php
        }
        else {
            $nazwa = $_POST['nazwa'];
            $cena = $_POST['cena'];

            $sql = "INSERT INTO USLUGI (NAZWA, CENA) VALUES ('$nazwa', $cena)";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="usluga.php"><span>1</span> Usługa</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano typ usługi</h3>
    </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
