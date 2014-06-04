<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
</head>
<body>

	<?php
		include('nav.php');
	?>

	<form action='#' method="post" class='basic-grey'>
		<h2>
			<div class="wizard-steps">
				<div class="completed-step">
					<a><span>1</span> Klient</a>
				</div>
				<div class="completed-step">
					<a><span>2</span> Posiłek</a>
				</div>
				<div class="active-step">
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<?php
			$con = oci_connect("tomek", "2", "localhost:1521/XE")or die ("could not connect to oracledb"); 

			$posilki = $_POST['posilek'];
			$posilek_ilosc = $_POST['posilek_ilosc'];
			$posilek_data = $_POST['posilek_data'];

			$id_klienta = $_POST['ID'];

			$cena_posilki = oci_parse($con, "Select cena from posilki where nazwa = '$posilki'");
			oci_execute($cena_posilki);
			$cena_posilki2 = oci_fetch_array($cena_posilki);
			$posilki_cena=$cena_posilki2['CENA'];

			$rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENCI_ID = '$id_klienta'");
			oci_execute($rachunek_kwota);
			$rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
			$rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

			$nowa_kwota = ($posilki_cena * $posilek_ilosc) + $rachunek_kwota3;
			$dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENCI_ID = '$id_klienta'");
			oci_execute($dodaj);

			$id_posilki = oci_parse($con," select ID FROM ZAMOWIENIA_POSILKOW where ID in (select max(ID) from ZAMOWIENIA_POSILKOW)");
		    oci_execute($id_posilki);
		    $id_posilki2 = oci_fetch_array($id_posilki);
		    $posilki = $id_posilki2['ID'];
		    $id_posilek = $posilki+1;

		    $id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENCI_ID = '$id_klienta'");
		    oci_execute($id_rachunku);
		    $id_rachunku2 = oci_fetch_array($id_rachunku);
		    $id_rachunek = $id_rachunku2['ID'];

		    $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_POSILKOW (ID,RACHUNKI_ID,ILOSC,POSILKI_NAZWA,DATA) VALUES ('$id_posilek','$id_rachunek','$posilek_ilosc','$posilki','$posilek_data')");
		    oci_execute($dodaj_usluge);
			oci_close($con);
		?>

		<label>Posiłek zamówiony</label>
		<label>
			<span>&nbsp;</span>
			<input type='SUBMIT' class='button' value='Przejdź do Klienta' />
		</label>
	</form>

</body>
</html>