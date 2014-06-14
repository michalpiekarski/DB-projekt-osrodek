<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/progres.css">
</head>
<body>
    <?php
        include('nav.php');

        $con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
        if(!isset($_POST['button']) and !isset($_POST['button2'])) {
            $osrodki = oci_parse($con, "SELECT * FROM OSRODKI");
            oci_execute($osrodki);
    ?>

    <form action="domek.php" method="post" class="basic-grey">
        <h1>Dodaj domek</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Ośrodek</a>
                </div>
                <div>
                    <a><span>2</span> Domek</a>
                </div>
                <div>
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Ośrodek :</span>
            <select name="osrodek">
                <?php
                    while($row = oci_fetch_array($osrodki)) {
                        echo "<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                    }
                ?>
            </select>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Wybierz ośrodek" />
        </label>
    </form>

    <?php
        }
        else if(isset($_POST['button']) and !isset($_POST['button2'])) {
            $osrodek = $_POST['osrodek'];
            $typy_domkow = oci_parse($con, "SELECT * FROM TYPY_OBIEKTOW WHERE NAZWA LIKE '%domek' OR NAZWA LIKE 'Domek%'");
            oci_execute($typy_domkow);
            
    ?>

    <form action="domek.php" method="post" class="basic-grey">
        <h1>Dodaj domek</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="domek.php"><span>1</span> Ośrodek</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Domek</a>
                </div>
                <div>
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <?php
            echo"<input type='hidden' name='osrodek' value='$osrodek' />";
            
        ?>

        <label>
            <span>Typ obiektu :</span>
            <select name="typ">
                <?php
                    while($row = oci_fetch_array($typy_domkow)) {
                        echo "<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
                    }
                ?>
            </select>
        </label>
        <!-- Do zmiany na sekwencję SQL czy coś -->
        <label>
            <span>Numer :</span>
            <input type="text" name="numer" placeholder="Numer domku" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button2" value="Dodaj domek" />
        </label>
    </form>

    <?php
        }
        else {
            $osrodek = $_POST['osrodek'];
            $id = $_POST['id'];
            $numer = $_POST['numer'];
            $typ = $_POST['typ'];

            $sql_obiektu = "INSERT INTO OBIEKTY (OSRODEK, TYP, BUDYNEK, NUMER) VALUES ('$osrodek', '$typ', null, '$numer')";
            $sql_obiektu_parsed = oci_parse($con, $sql_obiektu);
            oci_execute($sql_obiektu_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="domek.php"><span>1</span> Ośrodek</a>
                </div>
                <div class="completed-step">
                    <a><span>2</span> Domek</a>
                </div>
                <div class="active-step">
                    <a><span>3</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano domek</h3>
    </div>

    <?php
        oci_close($con); }
    ?>

</body>
</html>
