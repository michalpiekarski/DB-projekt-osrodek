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

        $con = oci_connect("tomek", "2") or die("could not connect to oracledb");
        $wynik = oci_parse($con, "Select * From klienci");
        oci_execute($wynik);
        $osrodek = $_POST['osrodek'];
        $obiekt = oci_parse($con, "Select * from OBIEKTY where OSRODEK = '$osrodek'");
        oci_execute($obiekt);
    ?>

    <form action="add.php" method="post" class="basic-grey">
        <h1>
            Rezerwacja
        </h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="rezerwacja.php"><span>1</span> Ośrodek / Klient</a>
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
            <select name="obiekt">

                <?php
                    while ($row = oci_fetch_array($obiekt))
                        echo "<option value='" . $row['ID'] . "'>" . $row['TYP'] . "</option>";
                ?>

            </select>
        </label>

        <?php
            echo "<input type='hidden' name='osrodek' value='$osrodek'>";
        ?>

        <label>
            <span>Imię:</span>
            <input type="text" name="imie" placeholder="Pełne imię" />
        </label>
        <label>
            <span>Nazwisko:</span>
            <input type="text" name="nazwisko" placeholder="Pełne nazwisko" />
        </label>
        <label>
            <span>Telefon:</span>
            <input type="text" name="telefon" placeholder="Numer telefonu" />
        </label>
        <label>
            <span>Email :</span>
            <input type="email" name="email" placeholder="Poprawny adres email" />
        </label>
        <label>
            <span>Ulica :</span>
            <input type="text" name="ulica" placeholder="Ulica" />
        </label>
        <label>
            <span>Mieszkanie :</span>
            <input type="text" name="mieszkanie" placeholder="Numer mieszkania" />
        </label>
        <label>
            <span>Kod pocztowy :</span>
            <input type="text" name="kod_pocztowy" placeholder="Kod Pocztowy" />
        </label>
        <label>
            <span>Miasto :</span>
            <input type="text" name="miasto" placeholder="Miasto" />
        </label>
        <label>
            <span>Przyjazd :</span>
            <input type="date" name="data_od" placeholder="Termin Przyjazdu" />
        </label>
        <label>
            <span>Wyjazd :</span>
            <input type="date" name="data_do" placeholder="Termin Wyjazdu" />
        </label>
        <label>
            <span>Ilość Osób :</span>
            <input type="number" name="ilosc_os" placeholder="Ilość osób" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj Rezerwację" />
        </label>

        <?php
            if (isset($_POST['button'])) {

                $obiekt = $_POST['obiekt'];
                $osrodek = $_POST['osrodek'];
                $sql_cena = oci_parse($con, "Select cena from TYPY_OBIEKTOW where NAZWA = '$obiekt'");
                oci_execute($sql_cena);
                $cena = oci_fetch_array($sql_cena);

                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $telefon = $_POST['telefon'];
                $email = $_POST['email'];
                $adres = $_POST['adres'];
                $data_od = $_POST['data_od'];
                $data_do = $_POST['data_do'];
                $iloscosob = $_POST['ilosc_os'];

                //Obliczenie ilości dni pobytu
                $offset = strtotime($data_od) - strtotime($data_do);
                $dni = floor($offset / 60 / 60 / 24);
                $kwota = $cena['CENA'] * $dni;

                //Pobieranie id ostatniego klienta + Inkrementacja
                $id_klienta = oci_parse($con, " select ID FROM klienci where ID in (select max(ID) from klienci)");
                oci_execute($id_klienta);
                $id_klienta2 = oci_fetch_array($id_klienta);
                $klient = $id_klienta2['ID'];
                $id_klient = $klient + 1;

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

                $sql_klienci = "Insert into klienci (ID,Imie, Nazwisko, Adres, Telefon, EMAIL) VALUES ('$id_klient','$imie','$nazwisko','$adres','$telefon','$email')";
                $sql_klienci2 = oci_parse($con, $sql_klienci);

                $sql_rachunek = "Insert into rachunki (ID,klienci_id,Kwota) VALUES ('$id_rachunek','$id_klient','$kwota')";
                $sql_rachunek2 = oci_parse($con, $sql_rachunek);

                $sql_rezerwacja = "Insert into rezerwacje (ID,Rachunki_ID, Obiekty_ID, Data_od, Data_do) VALUES ('$id_rezerwacja','$id_rachunek','$id_obiekt','$przyjazd','$wyjazd')";
                $sql_rezerwacja2 = oci_parse($con, $sql_rezerwacja);

                if (!$sql_klienci2) {
                    die('Błąd: ' . oci_error($con));
                }
                oci_execute($sql_klienci2);
                echo "Dodano klienta";

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
