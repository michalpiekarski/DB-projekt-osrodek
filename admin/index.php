<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/menu.css" />
    <link rel="stylesheet" type="text/css" href="../css/form.css" />
    <link rel="stylesheet" type="text/css" href="../css/grid.css" />
</head>
<body>

    <?php
        $page = "index";
        include('nav.php');

        if(isset($_COOKIE['logpass'])) {
    ?>

    <div class="basic-grey admin">
        <a href="osrodki.php">
            <img src="images/osrodki.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/osrodki_hov.PNG'" onmouseout="this.src='images/osrodki.PNG'" />
        </a>
        <a href="klienci.php">
            <img src="images/klienci.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/klienci_hov.PNG'" onmouseout="this.src='images/klienci.PNG'" />
        </a>
        <a href="pracownicy.php">
            <img src="images/pracownicy.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/pracownicy_hov.PNG'" onmouseout="this.src='images/pracownicy.PNG'" />
        </a>
        <a href="obiekty.php">
            <img src="images/obiekty.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/obiekty_hov.PNG'" onmouseout="this.src='images/obiekty.PNG'" />
        </a>
        <a href="osrodek.php">
            <img src="images/dodaj_osrodek.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_osrodek_hov.PNG'" onmouseout="this.src='images/dodaj_osrodek.PNG'" />
        </a>
        <a href="stanowisko.php">
            <img src="images/dodaj_stanowisko.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_stanowisko_hov.PNG'" onmouseout="this.src='images/dodaj_stanowisko.PNG'" />
        </a>
        <a href="pracownik.php">
            <img src="images/dodaj_pracownika.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_pracownika_hov.PNG'" onmouseout="this.src='images/dodaj_pracownika.PNG'" />
        </a>
        <img src="images/tm.PNG" alt="Informacje o zespole" class="imagelink" />
        <a href="typ_obiektu.php">
            <img src="images/dodaj_typ_obiektu.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_typ_obiektu_hov.PNG'" onmouseout="this.src='images/dodaj_typ_obiektu.PNG'" />
        </a>
        <a href="domek.php">
            <img src="images/dodaj_domek.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_domek_hov.PNG'" onmouseout="this.src='images/dodaj_domek.PNG'" />
        </a>
        <a href="pokoj.php">
            <img src="images/dodaj_pokoj.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_pokoj_hov.PNG'" onmouseout="this.src='images/dodaj_pokoj.PNG'" />
        </a>
        <a href="inny_obiekt.php">
            <img src="images/dodaj_inny_obiekt.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_inny_obiekt_hov.PNG'" onmouseout="this.src='images/dodaj_inny_obiekt.PNG'" />
        </a>
        <a href="typy_zamowien.php">
            <img src="images/typy_zamowien.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/typy_zamowien_hov.PNG'" onmouseout="this.src='images/typy_zamowien.PNG'" />
        </a>
        <a href="posilek.php">
            <img src="images/dodaj_typ_posilku.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_typ_posilku_hov.PNG'" onmouseout="this.src='images/dodaj_typ_posilku.PNG'" />
        </a>
        <a href="usluga.php">
            <img src="images/dodaj_typ_uslugi.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_typ_uslugi_hov.PNG'" onmouseout="this.src='images/dodaj_typ_uslugi.PNG'" />
        </a>
        <a href="wypozyczenie.php">
            <img src="images/dodaj_typ_wypozyczenia.PNG" alt="Aktualne Rezerwacje" class="imagelink" onmouseover="this.src='images/dodaj_typ_wypozyczenia_hov.PNG'" onmouseout="this.src='images/dodaj_typ_wypozyczenia.PNG'" />
        </a>
    </div>

    <?php
        }
        else {
    ?>

    <div class='basic-grey'>
        <h1>Nie jesteś zalogowany</h1>
        <h3>Aby uzyskać dostęp do systemu zarzdzania ośrodkiem musisz się zalogować</h3>
    </div>

    <?php
        }
    ?>

</body>
</html>
