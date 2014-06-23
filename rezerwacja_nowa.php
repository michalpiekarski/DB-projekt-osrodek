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

         if (! isset($_POST['button1'])) {
        $wynik = oci_parse($con, "Select * From klienci");
        oci_execute($wynik);
        $osrodek = $_POST['osrodek'];
        $id_klienta = $_POST['klient'];
        $klient = oci_parse($con, "Select IMIE, NAZWISKO from KLIENCI where ID= '$id_klienta'");
        oci_execute($klient);
        $row = oci_fetch_array($klient);
        $imie = $row['IMIE'];
        $nazwisko = $row['NAZWISKO'];
        $obiekt = oci_parse($con, "Select * from OBIEKTY where OSRODEK = '$osrodek'");
        oci_execute($obiekt);

    ?>

    <form action="rezerwacja_nowa.php" method="post" class="basic-grey">
        <h1>
            Rezerwacja dla: <?php echo "$imie $nazwisko"; ?> <span>Wypełnij wszystkie pola</span>
        </h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="rezerwacja.php"><span>1</span> Ośrodek</a>
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
            echo "<input type='hidden' name='osrodek2' value='$osrodek'>";
            echo "<input type='hidden' name='klient' value='$id_klienta'>";

        ?>

        <label>
            <span>Przyjazd :</span>
            <input id="termin" type="date" name="data_od" placeholder="Termin Przyjazdu" />
        </label>
        <label>
            <span>Wyjazd :</span>
            <input id="termin" type="date" name="data_do" placeholder="Termin Wyjazdu" />
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
            <input type="submit" class="button" name="button1" value="Dodaj Rezerwację" />
        </label>

        <?php
            }
            else
            {

                $obiekt = $_POST['obiekt'];
                $osrodek = $_POST['osrodek2'];

                $sql_typ = oci_parse($con, "Select TYP from OBIEKTY where OSRODEK = '$osrodek'");
                oci_execute($sql_typ);
                $typ_obiektu = oci_fetch_array($sql_typ);
                $typ = $typ_obiektu['TYP'];


                $sql_cena = oci_parse($con, "Select cena from TYPY_OBIEKTOW where NAZWA = '$typ'");
                oci_execute($sql_cena);
                $cena = oci_fetch_array($sql_cena);

                $klient = $_POST['klient'];
                $data_od = $_POST['data_od'];
                $data_do = $_POST['data_do'];
                $iloscosob = $_POST['ilosc_os'];

                //Obliczenie ilości dni pobytu
                $offset = strtotime($data_do) - strtotime($data_od);
                $dni = floor($offset / 60 / 60 / 24);
                $kwota = $cena['CENA'] * $dni;




                //Pobieranie ID ostatniego rachunku + Inkrementacja
                $id_rachunku = oci_parse($con, "Select ID FROM rachunki where ID in (select max(ID) from rachunki)");
                oci_execute($id_rachunku);
                $id_rachunku2 = oci_fetch_array($id_rachunku);
                $rachunek = $id_rachunku2['ID'];

                $sql_rachunek = "Insert into RACHUNKI (KLIENT,KWOTA) VALUES ('$klient','$kwota')";
                $sql_rachunek2 = oci_parse($con, $sql_rachunek);
                oci_execute($sql_rachunek2);

                $sql_rezerwacja = "Insert into REZERWACJE (RACHUNEK, OBIEKT, Data_od, Data_do) VALUES ('$rachunek','$obiekt','$data_od','$data_do')";
                $sql_rezerwacja2 = oci_parse($con, $sql_rezerwacja);
                oci_execute($sql_rezerwacja2);
                oci_close($con);
                ?>
<center>
                <label>Dodano rezerwację do istniejącego klienta</label>
                <label>
                    <span>&nbsp;</span>
                    <p><a href="rachunki_otwarte.php" class='button' >Przejdź do Rachunku Klienta</a></p>
                </label>
      </center>
           <?php }?>

    </form>
</body>
</html>
