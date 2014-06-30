<form action='rachunki_otwarte.php' method='post' class='basic-grey'>
    <h1>Wybierz klienta</h1>

    <h2>
        <div class="wizard-steps">
            <div class="active-step">
                <a><span>1</span> Klient</a>
            </div>
            <div>
                <a><span>2</span> Otwarte rachunki klienta</a>
            </div>
        </div>
    </h2>

    <label title="Pole jest wymagane">
        <span>Klient* :</span>
        <select name='klient'>

            <?php
                while($row = oci_fetch_array($klient))
                    echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";
            ?>

        </select>
    </label>
    <label>
        <span>&nbsp;</span>
        <input type="SUBMIT" name="button" class="button" value="Wyślij" />
    </label>
</form>
