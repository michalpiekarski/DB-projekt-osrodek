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
        $page = "rezerwacje";
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

                $sql_typ = oci_parse($con, "Select TYP from OBIEKTY where OSRODEK = '$osrodek'");
                oci_execute($sql_typ);
                $typ_obiektu = oci_fetch_array($sql_typ);
                $typ = $typ_obiektu['TYP'];


                $sql_cena = oci_parse($con, "Select cena from TYPY_OBIEKTOW where NAZWA = '$typ'");
                oci_execute($sql_cena);
                $cena = oci_fetch_array($sql_cena);

                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $telefon = $_POST['telefon'];
                $email = $_POST['email'];
                $ulica = $_POST['ulica'];
                $mieszkanie = $_POST['mieszkanie'];
                $kod_pocztowy = $_POST['kod_pocztowy'];
                $miasto = $_POST['miasto'];
                $data_od = $_POST['data_od'];
                $data_do = $_POST['data_do'];
                $iloscosob = $_POST['ilosc_os'];

                //Obliczenie ilości dni pobytu
                $offset = strtotime($data_do) - strtotime($data_od);
                $dni = floor($offset / 60 / 60 / 24);
                $kwota = $cena['CENA'] * $dni;



                $sql_klienci = "Insert into KLIENCI (IMIE, NAZWISKO, ULICA, MIESZKANIE, KOD_POCZTOWY, MIASTO, TELEFON, EMAIL) VALUES ('$imie','$nazwisko','$ulica', '$mieszkanie', '$kod_pocztowy', '$miasto', '$telefon','$email')";
                $sql_klienci2 = oci_parse($con, $sql_klienci);
                oci_execute($sql_klienci2);



                //Pobieranie id ostatniego klienta
                $id_klienta = oci_parse($con, "Select ID FROM klienci where ID in (select max(ID) from klienci)");
                oci_execute($id_klienta);
                $id_klienta2 = oci_fetch_array($id_klienta);
                $klient = $id_klienta2['ID'];

                $sql_rachunek = "Insert into RACHUNKI (KLIENT,KWOTA) VALUES ('$klient','$kwota')";
                $sql_rachunek2 = oci_parse($con, $sql_rachunek);
                oci_execute($sql_rachunek2);

                //Pobieranie ID ostatniego rachunku
                $id_rachunku = oci_parse($con, "Select ID FROM rachunki where ID in (select max(ID) from rachunki)");
                oci_execute($id_rachunku);
                $id_rachunku2 = oci_fetch_array($id_rachunku);
                $rachunek = $id_rachunku2['ID'];

                $sql_rezerwacja = "Insert into REZERWACJE (RACHUNEK, OBIEKT, Data_od, Data_do) VALUES ('$rachunek','$obiekt','$data_od','$data_do')";
                $sql_rezerwacja2 = oci_parse($con, $sql_rezerwacja);
                oci_execute($sql_rezerwacja2);
                oci_close($con);
                ?>

        <label>Dodano klienta</label>
        <label>
            <span>&nbsp;</span>
            <p><a href="rachunki_otwarte.php" class='button' >Przejdź do Rachunku Klienta</a></p>
        </label>
          <?php }?>

    </form>
</body>
</html>
