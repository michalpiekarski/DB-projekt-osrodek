<?php
    echo"<tr>";
        echo"<th colspan='4' style='background-color: lightgrey;'>Posiłki</th>";
    echo"</tr>";

    $zamowienia_posilkow = oci_parse($con, "SELECT * FROM ZAMOWIENIA_POSILKOW WHERE RACHUNEK = '$id_rachunku'");
    if(!oci_execute($zamowienia_posilkow)) {
        header('Refresh: 0; url=error.php?error_type=execute');
    }
    while($posilek = oci_fetch_array($zamowienia_posilkow)) {
        $nazwa_posilku = $posilek['TYP'];
        $ilosc_posilku = $posilek['ILOSC'];
        $sql_cena_posilku = oci_parse($con, "SELECT (CENA * '$ilosc_posilku') CENA_RAZEM FROM POSILKI WHERE NAZWA = '$nazwa_posilku'");
        if(!oci_execute($sql_cena_posilku)) {
            header('Refresh: 0; url=error.php?error_type=execute');
        }
        $cena = oci_fetch_array($sql_cena_posilku);
        echo"<tr>";
            echo"<td>".$nazwa_posilku."</td>";
            echo"<td>".$ilosc_posilku."</td>";
            echo"<td>".$posilek['DATA']."</td>";
            echo"<td>".$cena['CENA_RAZEM']." zł</td>";
        echo"</tr>";
    }
?>
