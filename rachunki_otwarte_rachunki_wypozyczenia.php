<?php
    echo"<tr>";
        echo"<th colspan='4' style='background-color: lightgrey;'>Wypożyczenia</th>";
    echo"</tr>";

    $zamowienia_wypozyczen = oci_parse($con, "SELECT * FROM ZAMOWIENIA_WYPOZYCZEN WHERE RACHUNEK = '$id_rachunku'");
    if(!oci_execute($zamowienia_wypozyczen)) {
        header('Refresh: 0; url=error.php?error_type=execute');
    }

    while($wypozyczenie = oci_fetch_array($zamowienia_wypozyczen)) {
        $nazwa_wypozyczenia = $wypozyczenie['TYP'];
        $ilosc_wypozyczenia = $wypozyczenie['ILOSC'];
        $sql_cena_wypozyczenia = oci_parse($con, "SELECT (CENA * '$ilosc_wypozyczenia') CENA_RAZEM FROM WYPOZYCZENIA WHERE NAZWA = '$nazwa_wypozyczenia'");
        if(!oci_execute($sql_cena_wypozyczenia)) {
            header('Refresh: 0; url=error.php?error_type=execute');
        }
        $cena = oci_fetch_array($sql_cena_wypozyczenia);
        echo"<tr>";
            echo"<td>".$nazwa_wypozyczenia."</td>";
            echo"<td>".$ilosc_wypozyczenia."</td>";
            echo"<td>".$wypozyczenie['DATA_OD']."-".$wypozyczenie['DATA_DO']."</td>";
            echo"<td>".$cena['CENA_RAZEM']." zł/dzień</td>";
        echo"</tr>";
    }
?>
