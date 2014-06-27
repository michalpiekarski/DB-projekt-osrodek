<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php
        include('../head_css.php');
    ?>

    <link rel="stylesheet" type="text/css" href="/bazy/css/grid.css" />
</head>
<body>

    <?php
        $page = "index";
        include('nav.php');

        if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
    ?>

    <div class="basic-grey admin">
        <a href="osrodki.php"><div class="imagelink">OŚRODKI</div></a>
        <a href="klienci.php"><div class="imagelink">KLIENCI</div></a>
        <a href="pracownicy.php"><div class="imagelink">PRACOWNICY</div></a>
        <a href="obiekty.php"><div class="imagelink">OBIEKTY</div></a>
        <a href="osrodek.php"><div class="imagelink">DODAJ<br>OŚRODEK</div></a>
        <a href="stanowisko.php"><div class="imagelink">DODAJ<br>STANOWISKO</div></a>
        <a href="pracownik.php"><div class="imagelink">DODAJ<br>PRACOWNIKA</div></a>
        <img src="../images/autorzy.PNG" alt="Informacje o zespole" class="imagelink" />
        <a href="typ_obiektu.php"><div class="imagelink">DODAJ<br>TYP OBIEKTU</div></a>
        <a href="domek.php"><div class="imagelink">DODAJ<br>DOMEK</div></a>
        <a href="pokoj.php"><div class="imagelink">DODAJ<br>POKÓJ</div></a>
        <a href="inny_obiekt.php"><div class="imagelink">DODAJ<br>INNY OBIEKT</div></a>
        <a href="typy_zamowien.php"><div class="imagelink">TYPY<br>ZAMÓWIEŃ</div></a>
        <a href="posilek.php"><div class="imagelink">DODAJ<br>POSIŁEK</div></a>
        <a href="usluga.php"><div class="imagelink">DODAJ<br>USŁUGĘ</div></a>
        <a href="wypozyczenie.php"><div class="imagelink">DODAJ<br>WYPOŻYCZENIE</div></a>
    </div>

    <?php
        }
        else {
            include('../login_error.php');
        }
    ?>

</body>
</html>
