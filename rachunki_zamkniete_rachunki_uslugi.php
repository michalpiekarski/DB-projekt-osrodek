<?php
    echo"<tr>";
        echo"<th colspan='4' style='background-color: lightgrey;'>Usługi</th>";
    echo"</tr>";

    $zamowienia_uslug = oci_parse($con, "SELECT * FROM ZAMOWIENIA_USLUG WHERE RACHUNEK = '$id_rachunku'");
    if(!oci_execute($zamowienia_uslug)) {
        header('Refresh: 0; url=error.php?error_type=execute');
    }
    while($usluga = oci_fetch_array($zamowienia_uslug)) {
        $nazwa_uslugi = $usluga['TYP'];
        $ilosc_uslugi = $usluga['ILOSC'];
        $sql_cena_uslugi = oci_parse($con, "SELECT (CENA * '$ilosc_uslugi') CENA_RAZEM FROM USLUGI WHERE NAZWA = '$nazwa_uslugi'");
        if(!oci_execute($sql_cena_uslugi)) {
            header('Refresh: 0; url=error.php?error_type=execute');
        }
        $cena = oci_fetch_array($sql_cena_uslugi);

        echo"<tr>";
            echo"<td>".$nazwa_uslugi."</td>";
            echo"<td>".$ilosc_uslugi."</td>";
            echo"<td>".$usluga['DATA']."</td>";
            echo"<td>".$cena['CENA_RAZEM']." zł</td>";
        echo"</tr>";
    }
?>
