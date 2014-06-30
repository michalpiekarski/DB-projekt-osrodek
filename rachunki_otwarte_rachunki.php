<div class='basic-grey'>
    <h1>Otwarte rachunki</h1>

    <h2>
        <div class="wizard-steps">
            <div class="completed-step hoverable">
                <a href="rachunki_otwarte.php"><span>1</span> Klient</a>
            </div>
            <div class="active-step">
                <a><span>2</span> Otwarte rachunki klienta</a>
            </div>
        </div>
    </h2>

    <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

    <?php
        while($row = oci_fetch_array($rachunki)) {
            $id_rachunku = $row['ID'];
            include 'rachunki_otwarte_rachunki_klient.php';
            include 'rachunki_otwarte_rachunki_posilki.php';
            include 'rachunki_otwarte_rachunki_uslugi.php';
            include 'rachunki_otwarte_rachunki_wypozyczenia.php';

            echo "<tr>";
                echo "<th colspan='2' style='border-bottom: solid 1px lightgrey; border-top: solid 1px lightgrey;'>Kwota:</th>";
                echo "<td colspan='2'  style='border-bottom: solid 1px lightgrey; border-top: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['KWOTA']." zł</td>";
            echo "</tr>";
        }
    ?>

    </table>
</div>
