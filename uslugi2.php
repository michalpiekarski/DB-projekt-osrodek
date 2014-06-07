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
        include('nav.php');
    ?>

    <form action='#' method="post" class='basic-grey'>
        <h2>
            <div class="wizard-steps">
                <div class="completed-step">
                    <a><span>1</span> Klient</a>
                </div>
                <div class="completed-step">
                    <a><span>2</span> Usługa</a>
                </div>
                <div class="active-step">
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <?php
            $con = oci_connect("tomek", "2")or die ("could not connect to oracledb");

            $usluga = $_POST['usluga'];
            $usluga_ilosc = $_POST['usluga_ilosc'];
            $usluga_data = $_POST['usluga_data'];
            $id_klienta = $_POST['ID'];

            $cena_usluga = oci_parse($con, "Select cena from uslugi where nazwa = '$usluga'");
            oci_execute($cena_usluga);
            $cena_usluga2 = oci_fetch_array($cena_usluga);
            $usluga_cena=$cena_usluga2['CENA'];

            $rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENCI_ID = '$id_klienta'");
            oci_execute($rachunek_kwota);
            $rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
            $rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

            $nowa_kwota = ($usluga_cena * $usluga_ilosc) + $rachunek_kwota3;
            $dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENCI_ID = '$id_klienta'");
            oci_execute($dodaj);

            $id_uslugi = oci_parse($con," select ID FROM ZAMOWIENIA_USLUG where ID in (select max(ID) from ZAMOWIENIA_USLUG)");
            oci_execute($id_uslugi);
            $id_uslugi2 = oci_fetch_array($id_uslugi);
            $uslugi = $id_uslugi2['ID'];
            $id_usluga = $uslugi+1;

            $id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENCI_ID = '$id_klienta'");
            oci_execute($id_rachunku);
            $id_rachunku2 = oci_fetch_array($id_rachunku);
            $id_rachunek = $id_rachunku2['ID'];

            $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_USLUG (ID,RACHUNKI_ID,ILOSC,USLUGI_NAZWA,DATA) VALUES ('$id_usluga','$id_rachunek','$usluga_ilosc','$usluga','$usluga_data')");
            oci_execute($dodaj_usluge);
            oci_close($con);
        ?>

        <label>
            Usługa zamówiona
        </label>
        <label>
            <span>&nbsp;</span>
            <input type='SUBMIT' class='button' value='Przejdź do Klienta' />
        </label>
    </form>
</body>
</html>
