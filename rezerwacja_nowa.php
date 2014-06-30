<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?php
            include 'head_css.php';
            include 'validation.php';
        ?>

        <script type="text/javascript" src="/bazy/js/validation_rezerwacja_nowa.js"></script>
    </head>
    <body>

        <?php
            $page = "rezerwacje";
            include 'nav.php';

            include 'db_connect.php';
            if(!$con) {
                header('Refresh: 0; url=error.php?error_type=connect');
            }

            if(isset($_COOKIE['logpass']))  {
                if (!isset($_POST['button1'])) {
                    $wynik = oci_parse($con, "Select * From klienci");
                    if(!oci_execute($wynik)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    $osrodek = $_POST['osrodek'];
                    $id_klienta = $_POST['klient'];
                    $klient = oci_parse($con, "Select IMIE, NAZWISKO from KLIENCI where ID= '$id_klienta'");
                    if(!oci_execute($klient)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    $row = oci_fetch_array($klient);
                    $imie = $row['IMIE'];
                    $nazwisko = $row['NAZWISKO'];
                    $obiekt = oci_parse($con, "Select * from OBIEKTY where OSRODEK = '$osrodek'");
                    if(!oci_execute($obiekt)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    include 'rezerwacja_nowa_rezerwacja.php';
                }
                else {
                    $obiekt = $_POST['obiekt'];
                    $osrodek = $_POST['osrodek2'];

                    $sql_typ = oci_parse($con, "Select TYP from OBIEKTY where OSRODEK = '$osrodek'");
                    if(!oci_execute($sql_typ)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    $typ_obiektu = oci_fetch_array($sql_typ);
                    $typ = $typ_obiektu['TYP'];

                    $sql_cena = oci_parse($con, "Select cena from TYPY_OBIEKTOW where NAZWA = '$typ'");
                    if(!oci_execute($sql_cena)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
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
                    $id_rachunku = oci_parse($con, "Select ID FROM RACHUNKI where KLIENT=$klient AND ZAPLACONY = 0");
                    if(!oci_execute($id_rachunku)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    $id_rachunku2 = oci_fetch_array($id_rachunku);
                    $rachunek = $id_rachunku2['ID'];

                    $rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENT = '$klient' and ZAPLACONY = 0");
                    if(!oci_execute($rachunek_kwota)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    $rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
                    $rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

                    $nowa_kwota = $kwota + $rachunek_kwota3;
                    $dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENT = '$klient'AND ZAPLACONY = 0");
                    if(!oci_execute($dodaj)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }

                    $sql_rezerwacja = "Insert into REZERWACJE (RACHUNEK, OBIEKT, Data_od, Data_do) VALUES ('$rachunek','$obiekt','$data_od','$data_do')";
                    $sql_rezerwacja2 = oci_parse($con, $sql_rezerwacja);
                    if(!oci_execute($sql_rezerwacja2)) {
                        header('Refresh: 0; url=error.php?error_type=execute');
                    }
                    include 'rezerwacja_nowa_podsumowanie.php';
                }
                oci_close($con);
            }
            else {
                include 'login_error.php';
            }
        ?>

    </body>
</html>
