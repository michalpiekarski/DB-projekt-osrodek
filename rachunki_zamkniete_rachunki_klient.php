<?php
    echo "<tr>";
        echo "<th colspan='2' style='background-color: lightgrey;'>Klient</th>";
        echo "<th colspan='2' style='background-color: lightgrey;'>Pracownik</th>";
    echo "</tr>";

    $id_klienta = $row['KLIENT'];
    $sql_klient = oci_parse($con, "SELECT * FROM KLIENCI WHERE ID = '$id_klienta'");
    if(!oci_execute($sql_klient)) {
        header('Refresh: 0; url=error.php?error_type=execute');
    }
    $klient_array = oci_fetch_array($sql_klient);

    $id_pracownika = $row['PRACOWNIK'];
    $sql_pracownik = oci_parse($con, "SELECT * FROM PRACOWNICY WHERE ID = '$id_pracownika'");
    if(!oci_execute($sql_pracownik)) {
        header('Refresh: 0; url=error.php?error_type=execute');
    }
    $pracownik_array = oci_fetch_array($sql_pracownik);

    echo"<tr>";
        echo"<td>".$klient_array['IMIE']."</td>";
        echo"<td>".$klient_array['NAZWISKO']."</td>";
        echo"<td>".$pracownik_array['IMIE']."</td>";
        echo"<td>".$pracownik_array['NAZWISKO']."</td>";
    echo"</tr>";
?>
