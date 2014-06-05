<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/progres.css" />
</head>
<body>
    <?php
        include('nav.php');

        $con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
        if(!isset($_POST['button'])) {
    ?>

    <form action="osrodek.php" method="post" class="basic-grey">
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

        <!-- Do zmiany na sekwencję SQL -->
        <label>
            <span>ID:</span>
            <input type="number" name="id_osrodka" value="0" />
        </label>
        <label>
            <span>Nazwa :</span>
            <input type="text" name="nazwa" placeholder="Nazwa ośrodka" />
        </label>
        <label>
            <span>Adres :</span>
            <textarea name="adres" placeholder="Adres ośrodka"></textarea>
        </label>
        <label>
            <span>Otwarty :</span>
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
            $id_osrodka = $_POST['id_osrodka'];
            $nazwa = $_POST['nazwa'];
            $adres = $_POST['adres'];
            $otwarty = 0;
            if(isset($_POST['otwarty']))
            {
                $otwarty = 1;
            }

            $sql = "INSERT INTO OSRODKI (ID, NAZWA, ADRES, OTWARTY) VALUES ('$id_osrodka', '$nazwa', '$adres', '$otwarty')";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step">
                    <a><span>1</span> Ośrodek</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <p>Dodano ośrodek</p>
    </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
