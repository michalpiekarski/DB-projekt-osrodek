<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
</head>
<body>

	<?php
		$page = "zamowienia";
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
			$con = oci_connect("tomek", "2")or die ("could not connect to oracledb");

			$posilek_nazwa = $_POST['posilek'];
			$posilek_ilosc = $_POST['posilek_ilosc'];
			$posilek_data = $_POST['posilek_data'];

			$id_klienta = $_POST['ID'];

			$cena_posilki = oci_parse($con, "Select cena from posilki where nazwa = '$posilek_nazwa'");
			oci_execute($cena_posilki);
			$cena_posilki2 = oci_fetch_array($cena_posilki);
			$posilki_cena=$cena_posilki2['CENA'];

			$rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENT = '$id_klienta'");
			oci_execute($rachunek_kwota);
			$rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
			$rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

			$nowa_kwota = ($posilki_cena * $posilek_ilosc) + $rachunek_kwota3;
			$dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENT = '$id_klienta'");
			oci_execute($dodaj);




		    $id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENT = '$id_klienta'");
		    oci_execute($id_rachunku);
		    $id_rachunku2 = oci_fetch_array($id_rachunku);
		    $id_rachunek = $id_rachunku2['ID'];

		    $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_POSILKOW (RACHUNEK,ILOSC,TYP,DATA) VALUES ('$id_rachunek','$posilek_ilosc','$posilek_nazwa','$posilek_data')");
		    oci_execute($dodaj_usluge);
			oci_close($con);
		?>

		<label>Posiłek zamówiony</label>
		<label>
			<span>&nbsp;</span>
			<a href="rachunki_otwarte.php" class='button' >Przejdź do Rachunku Klienta</a>
		</label>
	</form>

</body>
</html>
