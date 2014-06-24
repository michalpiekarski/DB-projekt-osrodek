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
        $page = "pracownicy";
        include('nav.php');

        if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
            include('db_connect.php');
            
            if(!isset($_POST['button'])) {
    ?>

    <form action="stanowisko.php" method="post" class="basic-grey">
        <h1>Dodaj stanowisko</h1>

            <h2>
                <div class="wizard-steps">
                    <div class="active-step">
                        <a><span>1</span> Stanowisko</a>
                    </div>
                    <div>
                        <a><span>2</span> Podsumowanie</a>
                    </div>
                </div>
            </h2>

        <label>
            <span>Nazwa :</span>
            <input type="text" name="nazwa" placeholder="Nazwa stanowiska" />
        </label>
        <label>
            <span>Płaca od :</span>
            <input type="number" name="placa_od" value="100.0" step="0.01"/>
        </label>
        <label>
            <span>Płaca do :</span>
            <input type="number" name="placa_do" value="2000.0"  step="0.01"/>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj stanowisko" />
        </label>
    </form>

    <?php
        }
        else {
            $nazwa = $_POST['nazwa'];
            $placa_od = $_POST['placa_od'];
            $placa_do = $_POST['placa_do'];

            $sql = "INSERT INTO STANOWISKA (NAZWA, PLACA_OD, PLACA_DO) VALUES ('$nazwa', $placa_od, $placa_do)";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Powodzenie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="stanowisko.php"><span>1</span> Stanowisko</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano stanowisko</h3>
    </div>

    <?php
            }
            oci_close($con);
        }
        else {
            include('../login_error.php');
        }
    ?>

</body>
</html>
