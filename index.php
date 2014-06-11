<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" />
</head>
<body>

	<?php
		include('nav.php');
	?>

    <div class="basic-grey">
        <a href="rezerwacje_aktualne.php">
            <img src="images/aktualne_rezerwacje.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/aktualne_rezerwacje_hov.PNG'" onmouseout="this.src='images/aktualne_rezerwacje.PNG'"/>
        </a>
        <a href="zamowienia_aktualne.php">
            <img src="images/aktualne_zamowienia.PNG" alt="Aktualne Zamówienia" class="imagelink" onmouseover="this.src='images/aktualne_zamowienia_hov.PNG'" onmouseout="this.src='images/aktualne_zamowienia.PNG'" />
        </a>
        <a href="rachunki_otwarte.php">
            <img src="images/rachunki_otwarte.PNG" alt="Otwarte Rachunki" class="imagelink" onmouseover="this.src='images/rachunki_otwarte_hov.PNG'" onmouseout="this.src='images/rachunki_otwarte.PNG'" />
        </a>
        <a href="rezerwacja.php">
            <img src="images/nowa_rezerwacja.PNG" alt="Zarezerwuj" class="imagelink" onmouseover="this.src='images/nowa_rezerwacja_hov.PNG'" onmouseout="this.src='images/nowa_rezerwacja.PNG'" />
        </a>
        <img id="logo" src="images/logo.PNG" alt="Logo" />
        <a href="posilek.php">
            <img src="images/zamow_posilek.PNG" alt="Zamów Posiłek" class="imagelink" onmouseover="this.src='images/zamow_posilek_hov.PNG'" onmouseout="this.src='images/zamow_posilek.PNG'" />
        </a>
        <a href="uslugi.php">
            <img src="images/zamow_usluge.PNG" alt="Zamów Usługę" class="imagelink" onmouseover="this.src='images/zamow_usluge_hov.PNG'" onmouseout="this.src='images/zamow_usluge.PNG'" />
        </a>
        <a href="wypozyczenie.php">
            <img src="images/wypozycz.PNG" alt="Wypożycz" class="imagelink" onmouseover="this.src='images/wypozycz_hov.PNG'" onmouseout="this.src='images/wypozycz.PNG'" />
        </a>
    </div>
</body>
</html>
