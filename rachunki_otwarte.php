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

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");

		if(!isset($_POST['button'])) {
			$klient = oci_parse($con,"SELECT ID, IMIE, NAZWISKO FROM KLIENCI");
			oci_execute($klient);
	?>

	<form action='rachunki_otwarte.php' method='post' class='basic-grey'>
			<h1>Wybierz klienta</h1>

			<h2>
				<div class="wizard-steps">
					<div class="active-step">
						<a><span>1</span> Klient</a>
					</div>
					<div>
						<a><span>2</span> Otwarte rachunki klienta</a>
					</div>
				</div>
			</h2>

			<label>
				<span>Klient :</span>
				<select name='klient'>

					<?php
						while($row = oci_fetch_array($klient))
							echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";
					?>

				</select>
			</label>
			<label>
				<span>&nbsp;</span>
				<input type="SUBMIT" name="button" class="button" value="Wyślij" />
			</label>
	</form>

	<?php
		}

		if(isset($_POST['button'])) {
			$id_klienta = $_POST['klient'];
			$rachunki = oci_parse($con,"SELECT * FROM RACHUNKI WHERE KLIENT = $id_klienta AND ZAPLACONY = 0");
			oci_execute($rachunki);
	?>

	<div class='basic-grey'>
		<h1>Otwarte rachunki klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step hoverable">
					<a href="rachunki_otwarte.php"><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Otwarte rachunki klienta</a>
				</div>
			</div>
		</h2>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

		<?php
			while($row = oci_fetch_array($rachunki)) {
				$id_rachunku = $row['ID'];
				echo "<tr>";
				echo "<th colspan='2' style='background-color: lightgrey;'>Klient</th>";
				echo "<th colspan='2' style='background-color: lightgrey;'>Pracownik</th>";
				echo "</tr>";

				$id_klienta = $row['KLIENT'];
				$sql_klient = oci_parse($con, "SELECT * FROM KLIENCI WHERE ID = '$id_klienta'");
				oci_execute($sql_klient);
				$klient_array = oci_fetch_array($sql_klient);

				$id_pracownika = $row['PRACOWNIK'];
				$sql_pracownik = oci_parse($con, "SELECT * FROM PRACOWNICY WHERE ID = '$id_pracownika'");
				oci_execute($sql_pracownik);
				$pracownik_array = oci_fetch_array($sql_pracownik);

				echo"<tr>";
				echo"<td>".$klient_array['IMIE']."</td>";
				echo"<td>".$klient_array['NAZWISKO']."</td>";
				echo"<td>".$pracownik_array['IMIE']."</td>";
				echo"<td>".$pracownik_array['NAZWISKO']."</td>";
				echo"</tr>";

				echo"<tr>";
				echo"<th colspan='4' style='background-color: lightgrey;'>Posiłki</th>";
				echo"</tr>";

				$zamowienia_posilkow = oci_parse($con, "SELECT * FROM ZAMOWIENIA_POSILKOW WHERE RACHUNEK = '$id_rachunku'");
				oci_execute($zamowienia_posilkow);

				while($posilek = oci_fetch_array($zamowienia_posilkow)) {
					$nazwa_posilku = $posilek['TYP'];
					$ilosc_posilku = $posilek['ILOSC'];
					$sql_cena_posilku = oci_parse($con, "SELECT (CENA * '$ilosc_posilku') CENA_RAZEM FROM POSILKI WHERE NAZWA = '$nazwa_posilku'");
					oci_execute($sql_cena_posilku);
					$cena = oci_fetch_array($sql_cena_posilku);
					echo"<tr>";
					echo"<td>".$nazwa_posilku."</td>";
					echo"<td>".$ilosc_posilku."</td>";
					echo"<td>".$posilek['DATA']."</td>";
					echo"<td>".$cena['CENA_RAZEM']." zł</td>";
					echo"</tr>";
				}

				echo"<tr>";
				echo"<th colspan='4' style='background-color: lightgrey;'>Usługi</th>";
				echo"</tr>";

				$zamowienia_uslug = oci_parse($con, "SELECT * FROM ZAMOWIENIA_USLUG WHERE RACHUNEK = '$id_rachunku'");
				oci_execute($zamowienia_uslug);

				while($usluga = oci_fetch_array($zamowienia_uslug)) {
					$nazwa_uslugi = $usluga['TYP'];
					$ilosc_uslugi = $usluga['ILOSC'];
					$sql_cena_uslugi = oci_parse($con, "SELECT (CENA * '$ilosc_uslugi') CENA_RAZEM FROM USLUGI WHERE NAZWA = '$nazwa_uslugi'");
					oci_execute($sql_cena_uslugi);
					$cena = oci_fetch_array($sql_cena_uslugi);

					echo"<tr>";
					echo"<td>".$nazwa_uslugi."</td>";
					echo"<td>".$ilosc_uslugi."</td>";
					echo"<td>".$usluga['DATA']."</td>";
					echo"<td>".$cena['CENA_RAZEM']." zł</td>";
					echo"</tr>";
				}

				echo"<tr>";
				echo"<th colspan='4' style='background-color: lightgrey;'>Wypożyczenia</th>";
				echo"</tr>";

				$zamowienia_wypozyczen = oci_parse($con, "SELECT * FROM ZAMOWIENIA_WYPOZYCZEN WHERE RACHUNEK = '$id_rachunku'");
				oci_execute($zamowienia_wypozyczen);

				while($wypozyczenie = oci_fetch_array($zamowienia_wypozyczen)) {
					$nazwa_wypozyczenia = $wypozyczenie['TYP'];
					$ilosc_wypozyczenia = $wypozyczenie['ILOSC'];
					$sql_cena_wypozyczenia = oci_parse($con, "SELECT (CENA * '$ilosc_wypozyczenia') CENA_RAZEM FROM WYPOZYCZENIA WHERE NAZWA = '$nazwa_wypozyczenia'");
					oci_execute($sql_cena_wypozyczenia);
					$cena = oci_fetch_array($sql_cena_wypozyczenia);
					echo"<tr>";
					echo"<td>".$nazwa_wypozyczenia."</td>";
					echo"<td>".$ilosc_wypozyczenia."</td>";
					echo"<td>".$wypozyczenie['DATA_OD']."-".$wypozyczenie['DATA_DO']."</td>";
					echo"<td>".$cena['CENA_RAZEM']." zł/dzień</td>";
					echo"</tr>";
				}

				echo "<tr>";
				echo "<th colspan='2' style='border-bottom: solid 1px lightgrey; border-top: solid 1px lightgrey;'>Kwota:</th>";
				echo "<td colspan='2'  style='border-bottom: solid 1px lightgrey; border-top: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['KWOTA']." zł</td>";
				echo "</tr>";
			}
			oci_close($con); }
		?>

		</table>
	</div>

</body>
</html>
