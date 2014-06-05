<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/menu.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/progres.css" />
</head>
<body>

    <?php
        include ('nav.php');

        $con = oci_connect("tomek", "2", "localhost:1521/XE") or die("could not connect to oracledb");

        $wynik = oci_parse($con, "Select * From klienci");
        oci_execute($wynik);
        $osrodek = $_POST['selection'];
        $id_klienta = $_POST['klient'];
        $klient = oci_parse($con, "Select IMIE, NAZWISKO from KLIENCI where ID= '$id_klienta'");
        oci_execute($klient);
        $row = oci_fetch_array($klient);
        $imie = $row['IMIE'];
        $nazwisko = $row['NAZWISKO'];


        if (isset($_POST['selection'])) {
            $obiekt = oci_parse($con, "Select * from OBIEKTY where OSRODKI_ID = '$osrodek'");
            oci_execute($obiekt);
        } else {
            echo "Brak danych";
        }
    ?>

    <form action="add_exist.php" method="post" class="basic-grey">
        <h1>
            Rezerwacja dla: <?php echo "$imie $nazwisko"; ?> <span>Wypełnij wszystkie pola</span>
        </h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step">
                    <a><span>1</span> Ośrodek</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Formularz dodania</a>
                </div>
                <div>
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Obiekt :</span>
            <select name="sel_ob">

                <?php
                    while ($row = oci_fetch_array($obiekt))
                        echo "<option value='" . $row['TYPY_OBIEKTOW_NAZWA'] . "'>" . $row['TYPY_OBIEKTOW_NAZWA'] . "</option>";
                ?>

            </select>
        </label>

        <?php
            echo "<input type='hidden' name='osrodek2' value='$osrodek'>";
            echo "<input type='hidden' name='klient2' value='$id_klienta'>";

        ?>

        <label>
            <span>Przyjazd :</span>
            <input id="termin" type="date" name="termin_przyj" placeholder="Termin Przyjazdu" />
        </label>
        <label>
            <span>Wyjazd :</span>
            <input id="termin" type="date" name="termin_wyj" placeholder="Termin Wyjazdu" />
        </label>
        <label>
            <span>Ilość Osób :</span>
            <input id="ilosc" type="number" name="ilosc_os" placeholder="Ilość osób " min="2" max="8"/>
        </label>
        <label>
            <span>Uwagi :</span>
            <textarea id="message" name="uwagi" placeholder="Dodatkowe uwagi"></textarea>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj Rezerwację" />
        </label>

        <?php
            if (isset($_POST['button'])) {

                $nz_pok = $_POST['sel_ob'];
                $osrodek2 = $_POST['osrodek2'];
                $cena = oci_parse($con, "Select cena from TYPY_OBIEKTOW where NAZWA = '$nz_pok'");
                oci_execute($cena);
                $cena2 = oci_fetch_array($cena);
                $id_klienta = $_POST['klient2'];
                $przyjazd = $_POST['termin_przyj'];
                $wyjazd = $_POST['termin_wyj'];
                $iloscosob = $_POST['ilosc_os'];

                //Obliczenie ilości dni pobytu
                $offset = strtotime($wyjazd) - strtotime($przyjazd);
                $dni = floor($offset / 60 / 60 / 24);
                $kwota = $cena2['CENA'] * $dni;




                //Pobieranie ID ostatniego rachunku + Inkrementacja
                $id_rachunku = oci_parse($con, " select ID FROM rachunki where ID in (select max(ID) from rachunki)");
                oci_execute($id_rachunku);
                $id_rachunku2 = oci_fetch_array($id_rachunku);
                $rachunek = $id_rachunku2['ID'];
                $id_rachunek = $rachunek + 1;

                //pobieranie ID obiektu + Inkrementacja
                $id_obiektu = oci_parse($con, "Select ID from TYPY_OBIEKTOW, OBIEKTY where OBIEKTY.OSRODKI_ID = '$osrodek2' and OBIEKTY.TYPY_OBIEKTOW_NAZWA='$nz_pok'");
                oci_execute($id_obiektu);
                $id_obiektu2 = oci_fetch_array($id_obiektu);
                $id_obiekt = $id_obiektu2['ID'];

                //Pobieranie ID Rezerwacji + Inkrementacja
                $id_rezerwacji = oci_parse($con, " select ID FROM rezerwacje where ID in (select max(ID) from rezerwacje)");
                oci_execute($id_rezerwacji);
                $id_rezerwacji2 = oci_fetch_array($id_rezerwacji);
                $rezerwacja = $id_rezerwacji2['ID'];
                $id_rezerwacja = $rezerwacja + 1;

                $sql_rachunek = "Insert into rachunki (ID,klienci_id,Kwota) VALUES ('$id_rachunek','$id_klienta','$kwota')";
                $sql_rachunek2 = oci_parse($con, $sql_rachunek);

                $sql_rezerwacja = "Insert into rezerwacje (ID,Rachunki_ID, Obiekty_ID, Data_od, Data_do) VALUES ('$id_rezerwacja','$id_rachunek','$id_obiekt','$przyjazd','$wyjazd')";
                $sql_rezerwacja2 = oci_parse($con, $sql_rezerwacja);


                if (!$sql_rachunek2) {
                    die('Błąd: ' . oci_error($con));
                }
                oci_execute($sql_rachunek2);
                echo "Utworzono rachunek";

                if (!$sql_rezerwacja2) {
                    die('Błąd: ' . oci_error($con));
                }
                oci_execute($sql_rezerwacja2);
                echo "Dodano rezerwacje";
                oci_close($con);
            }
        ?>

    </form>
</body>
</html>
