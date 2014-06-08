<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
    <style type="text/css">
        .imagelink {
            border: solid 1px black;
            width: 150px;
            height: 110px;
            text-align: center;
            float: left;
            padding-top: 40px;
            margin-left: 20px;
            margin-bottom: 10px;
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
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                REZERWACJE AKTUALNE
            </div>
        </a>
        <a href="zamowienia_aktualne.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                ZAMOWIENIA AKTUALNE
            </div>
        </a>
        <a href="rachunki_otwarte.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                RACHUNKI OTWARTE
            </div>
        </a>
        <div class="clear"></div>
        <a href="rezerwacja.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                NOWA REZERWACJA
            </div>
        </a>
        <div class="imagelink" style="width: 322px;">
            <span style="font-size: 5em;">LOGO</span>
        </div>
        <div class="clear"></div>
        <a href="posilek.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                ZAMOW POSILEK
            </div>
        </a>
        <a href="uslugi.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                ZAMÓW USŁUGĘ
            </div>
        </a>
        <a href="wypozyczenie.php">
            <div class="imagelink">
                TUTAJ LINK OBRAZKOWY
                <hr width="50%" />
                WYPOŻYCZ
            </div>
        </a>
        <div class="clear"></div>
    </div>
</body>
</html>
