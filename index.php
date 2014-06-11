<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
    <style type="text/css">
        .imagelink {
            width: 150px;
            height: 150px;
            float: left;
            margin-left: 20px;
            margin-bottom: 10px;
        }
        #logo {
            width: 320px;
            height: 150px;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>

	<?php
		include('nav.php');
	?>

    <div class="basic-grey" style="margin-top: 100px;">
        <a href="rezerwacje_aktualne.php">
            <img src="images/aktualne_rezerwacje.PNG" alt="Aktualne Rezerwacje" class="imagelink" />
        </a>
        <a href="zamowienia_aktualne.php">
            <img src="images/aktualne_zamowienia.PNG" alt="Aktualne Zamówienia" class="imagelink" />
        </a>
        <a href="rachunki_otwarte.php">
            <img src="images/rachunki_otwarte.PNG" alt="Otwarte Rachunki" class="imagelink" />
        </a>
        <div class="clear"></div>
        <a href="rezerwacja.php">
            <img src="images/nowa_rezerwacja.PNG" alt="Zarezerwuj" class="imagelink" />
        </a>
        <div class="imagelink" style="width: 322px;">
            <img id="logo" src="images/logo.PNG" alt="Logo" />
        </div>
        <div class="clear"></div>
        <a href="posilek.php">
            <img src="images/zamow_posilek.PNG" alt="Zamów Posiłek" class="imagelink" />
        </a>
        <a href="uslugi.php">
            <img src="images/zamow_usluge.PNG" alt="Zamów Usługę" class="imagelink" />
        </a>
        <a href="wypozyczenie.php">
            <img src="images/wypozycz.PNG" alt="Wypożycz" class="imagelink" />
        </a>
        <div class="clear"></div>
    </div>
</body>
</html>
