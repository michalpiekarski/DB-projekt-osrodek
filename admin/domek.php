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

        $con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
        if(!isset($_POST['button']) and !isset($_POST['button2'])) {
            $osrodki = oci_parse($con, "SELECT * FROM OSRODKI");
            oci_execute($osrodki);
    ?>

    <form action="domek.php" method="post" class="basic-grey">
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

        <label>
            <span>Ośrodek :</span>
            <select name="osrodek_id">
                <?php
                    while($row = oci_fetch_array($osrodki)) {
                        echo "<option value='".$row['ID']."'>".$row['NAZWA']."</option>";
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
            $osrodek_id = $_POST['osrodek_id'];
            $typy_obiektow = oci_parse($con, "SELECT * FROM TYPY_OBIEKTOW");
            oci_execute($typy_obiektow);
    ?>

    <form action="domek.php" method="post" class="basic-grey">
        <h1>Dodaj domek</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step">
                    <a><span>1</span> Ośrodek</a>
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
            echo"<input type='hidden' name='osrodek_id_obiektu' value='$osrodek_id' />";
        ?>
        <!-- Do zmiany na sekwencję SQL -->
        <label>
            <span>ID :</span>
            <input type="number" name="id" value="0" />
        </label>
        <!-- Do zmiany na sekwencję SQL -->
        <label>
            <span>Numer :</span>
            <input type="number" name="numer" value="0" />
        </label>
        <label>
            <span>Typ obiektu :</span>
            <select name="typ_obiektu">
                <?php
                    while($row = oci_fetch_array($typy_obiektow)) {
                        echo "<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                    }
                ?>
            </select>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button2" value="Dodaj domek" />
        </label>
    </form>

    <?php
        }
        else {
            $osrodek_id_obiektu = $_POST['osrodek_id_obiektu'];
            $id = $_POST['id'];

            $sql_obiektu = "INSERT INTO OBIEKTY (ID, OSRODKI_ID) VALUES ('$id', '$osrodek_id_obiektu')";
            $sql_obiektu_parsed = oci_parse($con, $sql_obiektu);
            oci_execute($sql_obiektu_parsed);

            $numer = $_POST['numer'];
            $typ_obiektu = $_POST['typ_obiektu'];

            $sql = "INSERT INTO DOMKI (ID, NUMER, TYPY_OBIEKTOW_NAZWA) VALUES ('$id', '$numer', '$typ_obiektu')";
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
                <div class="completed-step">
                    <a><span>2</span> Domek</a>
                </div>
                <div class="active-step">
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <p>Dodano domek</p>
    </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
