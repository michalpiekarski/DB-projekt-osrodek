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
            $osrodki = oci_parse($con, "SELECT * FROM OSRODKI");
            oci_execute($osrodki);
            $stanowiska = oci_parse($con, "SELECT * FROM STANOWISKA");
            oci_execute($stanowiska);
    ?>

    <form action="pracownik.php" method="post" class="basic-grey">
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

        <!-- Do zmiany na sekwencję SQL -->
        <label>
            <span>ID :</span>
            <input type="number" name="id" value="0" />
        </label>
        <label>
            <span>Imię :</span>
            <input type="text" name="imie" placeholder="Imię" />
        </label>
        <label>
            <span>Nazwisko :</span>
            <input type="text" name="nazwisko" placeholder="Nazwisko" />
        </label>
        <label>
            <span>Adres :</span>
            <textarea name="adres" placeholder="Adres"></textarea>
        </label>
        <label>
            <span>Telefon :</span>
            <input type="text" name="telefon" placeholder="Telefon" />
        </label>
        <label>
            <span>E-mail :</span>
            <input type="text" name="e_mail" placeholder="E-mail" />
        </label>
        <label>
            <span>Ośrodek :</span>
            <select name="osrodek">
                <?php
                    while($row = oci_fetch_array($osrodki)) {
                        echo"<option value='".$row['ID']."'>".$row['NAZWA']."</option>";
                    }
                ?>
            </select>
        </label>
        <label>
            <span>Stanowisko :</span>
            <select name="stanowisko">
                <?php
                    while($row = oci_fetch_array($stanowiska)) {
                        echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                    }
                ?>
            </select>
        </label>
        <label>
            <span>Płaca :</span>
            <input type="number" name="placa" value="200" step="0.01" />
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
            $adres = $_POST['adres'];
            $telefon = $_POST['telefon'];
            $e_mail = $_POST['e_mail'];
            $osrodek = $_POST['osrodek'];
            $stanowisko = $_POST['stanowisko'];
            $placa = $_POST['placa'];

            $sql = "INSERT INTO PRACOWNICY (ID, IMIE, NAZIWSKO /*<-- TYPO IN DB*/, ADRES, TELEFON, /*'e-mail',*/ OSRODKI_ID, STANOWISKA_NAZWA, PLACA) VALUES ('$id', '$imie', '$nazwisko', '$adres', '$telefon', /*'$e_mail',*/ '$osrodek', '$stanowisko', '$placa')";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

        <div class="basic-grey">
            <h1>Powodzenie</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="completed-step">
                        <a><span>1</span> Pracownik</a>
                    </div>
                    <div class="active-step">
                        <a><span>2</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

            <p>Dodano pracownika</p>
        </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
