<form id="posilek" action='posilek_podsumowanie.php' method='post' class='basic-grey'>
    <h1>Wybierz Posilki</h1>

    <h2>
        <div class="wizard-steps">
            <div class="completed-step">
                <a><span>1</span> Klient</a>
            </div>
            <div class="active-step">
                <a><span>2</span> Posiłek</a>
            </div>
            <div>
                <a><span>3</span> Podsumowanie</a>
            </div>
        </div>
    </h2>

    <label title="Pole jest wymagane">
        <span>Posilki* :</span>
        <select name='posilek'>
            <option value='' selected></option>

            <?php
                while($row = oci_fetch_array($posilek))
                    echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
            ?>
        </select>
    </label>
    <label title="Pole jest wymagane">
        <span>Ilość* :</span>
        <input type='number' name='posilek_ilosc' placeholder="Ilość" min='1' max='8'>
    </label>
    <label title="Pole jest wymagane">
        <span>Data* :</span>
        <input type='date' name='posilek_data' value="<?php echo date('Y-m-d'); ?>">
    </label>

    <?php
        echo"<input type='hidden' name='ID' value='$id_klienta' />";
    ?>

    <label>
        <span>&nbsp;</span>
        <input type='SUBMIT' class='button' value='Dodaj posiłek' />
    </label>
</form>
