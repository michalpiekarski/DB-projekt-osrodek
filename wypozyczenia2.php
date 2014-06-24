<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('head_css.php');
	?>

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
					<a><span>2</span> Wypożyczenie</a>
				</div>
				<div class="active-step">
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<?php
			include('db_connect.php');

			$wypozyczenia_nazwa = $_POST['wypozyczenia'];
			$wypozyczenia_ilosc = $_POST['wypozyczenia_ilosc'];

			$wypozyczenia_data_od = $_POST['wypozyczenia_data_od'];
			$wypozyczenia_data_do = $_POST['wypozyczenia_data_do'];
			$id_klienta = $_POST['ID'];

			$rachunek_stan = oci_parse($con, "Select ZAPLACONY from RACHUNKI where klient = $id_klienta and ZAPLACONY = 0");
			oci_execute($rachunek_stan);
			$rachunek_stan2 = oci_fetch_array($rachunek_stan);
			$stan_rachunku = $rachunek_stan2['ZAPLACONY'];

			$cena_wypozyczenia = oci_parse($con, "Select cena from wypozyczenia where nazwa = '$wypozyczenia_nazwa'");
			oci_execute($cena_wypozyczenia);
			$cena_wypozyczenia2 = oci_fetch_array($cena_wypozyczenia);
			$wypozyczenia_cena=$cena_wypozyczenia2['CENA'];

			$offset = strtotime($wypozyczenia_data_do) - strtotime($wypozyczenia_data_od);
            $dni = floor($offset / 60 / 60 / 24);
            $kwota = $wypozyczenia_cena * $dni;

            if(isset($stan_rachunku))
            {

				$rachunek_kwota = oci_parse($con, "Select kwota from RACHUNKI where KLIENT = '$id_klienta'ZAPLACONY = 0");
				oci_execute($rachunek_kwota);
				$rachunek_kwota2 = oci_fetch_array($rachunek_kwota);
				$rachunek_kwota3 = $rachunek_kwota2['KWOTA'];

				$nowa_kwota = ($kwota * $wypozyczenia_ilosc) + $rachunek_kwota3;
				$dodaj = oci_parse($con, "UPDATE RACHUNKI SET KWOTA = $nowa_kwota where KLIENT = '$id_klienta'AND ZAPLACONY = 0");
				oci_execute($dodaj);


			    $id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENT = '$id_klienta' ZAPLACONY = 0");
			    oci_execute($id_rachunku);
			    $id_rachunku2 = oci_fetch_array($id_rachunku);
			    $id_rachunek = $id_rachunku2['ID'];

			    $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_WYPOZYCZEN (RACHUNEK,ILOSC,TYP,DATA_OD,DATA_DO) VALUES ('$id_rachunek','$wypozyczenia_ilosc','$wypozyczenia_nazwa','$wypozyczenia_data_od','$wypozyczenia_data_do')");
			    oci_execute($dodaj_usluge);
				oci_close($con);

			}
			else
			{
				$nowa_kwota = ($kwota * $wypozyczenia_ilosc);

				$sql_klient = oci_parse($con, "Insert into RACHUNKI (KLIENT, KWOTA) VALUES ('$id_klienta', '$nowa_kwota')");
				oci_execute($sql_klient);

				$id_rachunku = oci_parse($con, "Select ID from rachunki where KLIENT = '$id_klienta' AND ZAPLACONY = '0'");
			    oci_execute($id_rachunku);
			    $id_rachunku2 = oci_fetch_array($id_rachunku);
			    $id_rachunek = $id_rachunku2['ID'];

			    $dodaj_usluge = oci_parse($con, "Insert into ZAMOWIENIA_WYPOZYCZEN (RACHUNEK,ILOSC,TYP,DATA_OD,DATA_DO) VALUES ('$id_rachunek','$wypozyczenia_ilosc','$wypozyczenia_nazwa','$wypozyczenia_data_od','$wypozyczenia_data_do')");
			    oci_execute($dodaj_usluge);
				oci_close($con);
			}
		?>

		<label>
			Wypożyczono
		</label>
		<label>
			<span>&nbsp;</span>
			<a href="rachunki_otwarte.php" class='button' >Przejdź do Rachunku Klienta</a>
		</label>
	</form>

</body>
</html>
