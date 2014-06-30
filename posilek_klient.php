<form id="posilek_klient_form" action='posilek.php' method='post' class='basic-grey'>
    <h1>Wybierz klienta</h1>

    <h2>
        <div class="wizard-steps">
            <div class="active-step">
                <a><span>1</span> Klient</a>
            </div>
            <div>
                <a><span>2</span> Posiłek</a>
            </div>
            <div>
                <a><span>3</span> Podsumowanie</a>
            </div>
        </div>
    </h2>

    <label>
        <span>Klient :</span>
        <select name='selection'>
            <option value='' selected></option>

            <?php
                while($row = oci_fetch_array($klient))
                    echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";
            ?>

        </select>
    </label>
    <label>
        <span>&nbsp;</span>
        <input type="SUBMIT" name="button" class="button" value="Dalej" />
    </label>
</form>
