<form id="rezerwacja_nowa_form" action="rezerwacja_nowa.php" method="post" class="basic-grey">
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

    <label title="Pole jest wymagane">
        <span>Obiekt* :</span>
        <select name='obiekt'>
            <option value='' selected></option>

            <?php
                while ($row = oci_fetch_array($obiekt))
                    echo "<option value='" . $row['ID'] . "'>TYP:" . $row['TYP'] . " BUDYNEK: ".$row['BUDYNEK']." NUMER:".$row['NUMER']." </option>";
            ?>

        </select>
    </label>

    <label title="Pole jest wymagane">
        <span>Od* :</span>
        <input type="date" name='data_od' value="<?php echo date('Y-m-d'); ?>" />
    </label>
    <label title="Pole jest wymagane">
        <span>Do* :</span>
        <input type="date" name='data_do' value="<?php echo date('Y-m-d',strtotime('+1 week')); ?>" />
    </label>
    <label title="Pole jest wymagane">
        <span>Ilość Osób* :</span>
        <input type="number" name='ilosc_os' placeholder="Ilość osób" min="2" max="8" />
    </label>
    <label>
        <span>&nbsp;</span>
        <input type="submit" class="button" name="button1" value="Dodaj Rezerwację" />
    </label>

    <?php
        echo "<input type='hidden' name='osrodek2' value='$osrodek'>";
        echo "<input type='hidden' name='klient' value='$id_klienta'>";
    ?>
</form>
