<form id='form' action='rezerwacja_nowa.php' method='post' class='basic-grey'>
    <h1>Wybierz ośrodek i istniejącego klienta</h1>

    <h2>
        <div class="wizard-steps">
            <div class="active-step">
                <a><span>1</span> Ośrodek / Klient</a>
            </div>
            <div>
                <a><span>2</span> Formularz dodania</a>
            </div>
            <div>
                <a><span>3</span> Podsumowanie</a>
            </div>
        </div>
    </h2>

    <label title="Pole jest wymagane">
        <span>Ośrodek* :</span>
        <select name='osrodek' >
            <option value='' selected></option>

            <?php
                while($row = oci_fetch_array($osrodek))
                    echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
            ?>

        </select>
    </label>
    <label title="Pole jest wymagane">
        <span>Klient* :</span>
        <select name='klient'>
            <option value='' selected></option>

            <?php
                while($row = oci_fetch_array($klient))
                    echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";

            ?>

        </select>
    </label>
    <label>
        <span>&nbsp;</span>
        <input type="SUBMIT" class="button" value="Dalej" />
    </label>
</form>
