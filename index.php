<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('head_css.php');
	?>

    <link rel="stylesheet" type="text/css" href="/bazy/css/grid.css">
</head>
<body>

	<?php
        $page = "index";
		include('nav.php');

        if(isset($_COOKIE['logpass'])) {
	?>

    <div class="basic-grey">
        <a href="rezerwacje_aktualne.php"><div class="imagelink">AKTUALNE<br>REZERWACJE</div></a>
        <a href="zamowienia_aktualne.php"><div class="imagelink">AKTUALNE<br>ZAMÓWIENIA</div></a>
        <a href="rachunki_otwarte.php"><div class="imagelink">OTWARTE<br>RACHUNKI</div></a>
        <a href="rezerwacja.php"><div class="imagelink">DODAJ<br>REZERWACJĘ</div></a>
        <img id="logo" src="images/logo.PNG" alt="Logo" />
        <a href="posilek.php"><div class="imagelink">ZAMÓW<br>POSIŁEK</div></a>
        <a href="uslugi.php"><div class="imagelink">ZAMÓW<br>USŁUGĘ</div></a>
        <a href="wypozyczenie.php"><div class="imagelink">ZAMÓW<br>WYPOŻYCZENIE</div></a>
    </div>

    <?php
        }
        else {
            include('login_error.php');
        }
    ?>

</body>
</html>
