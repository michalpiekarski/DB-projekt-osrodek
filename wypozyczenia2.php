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
		include('nav.php');
	?>

	<form action='#' method="post" class='basic-grey'>
		<h2>
			<div class="wizard-steps">
				<div class="completed-step">
					<a><span>1</span> Klient</a>
				</div>
				<div class="completed-step">
					<a><span>2</span> Wypożyczenie</a>
				</div>
				<div class="active-step">
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<?php
			$con = oci_connect("tomek", "2")or die ("could not connect to oracledb");

			$wypozyczenia_nazwa = $_POST['wypozyczenia'];
			$wypozyczenia_ilosc = $_POST['wypozyczenia_ilosc'];

			$wypozyczenia_data_od = $_POST['wypozyczenia_data_od'];
			$wypozyczenia_data_do = $_POST['wypozyczenia_data_do'];
			$cena_wypozyczenia = oci_parse($con, "Select cena from wypozyczenia where nazwa = '$wypozyczenia_nazwa'");
			oci_execute($cena_wypozyczenia);
			$wypozyczenia_cena = oci_fetch_array($cena_wypozyczenia);
			$id_klienta = $_POST['ID'];

			$cena_wypozyczenia = oci_parse($con, "Select cena from wypozyczenia where nazwa = '$wypozyczenia_nazwa'");
			oci_execute($cena_wypozyczenia);
			$cena_wypozyczenia2 = oci_fetch_array($cena_wypozyczenia);
			$wypozyczenia_cena=$cena_wypozyczenia2['CENA'];

			$rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENT = '$id_klienta'");
			oci_execute($rachunek_kwota);
			$rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
			$rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

			$nowa_kwota = ($wypozyczenia_cena * $wypozyczenia_ilosc) + $rachunek_kwota3;
			$dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENT = '$id_klienta'");
			oci_execute($dodaj);

		

		    $id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENT = '$id_klienta'");
		    oci_execute($id_rachunku);
		    $id_rachunku2 = oci_fetch_array($id_rachunku);
		    $id_rachunek = $id_rachunku2['ID'];

		    $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_WYPOZYCZEN (RACHUNEK,ILOSC,TYP,DATA_OD,DATA_DO) VALUES ('$id_rachunek','$wypozyczenia_ilosc','$wypozyczenia_nazwa','$wypozyczenia_data_od','$wypozyczenia_data_do')");
		    oci_execute($dodaj_usluge);
			oci_close($con);
		?>

		<label>
			Wypożyczono
		</label>

	</form>

</body>
</html>
