<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
		$klient = oci_parse($con,"SELECT ID, IMIE, NAZWISKO FROM KLIENCI");
		oci_execute($klient);

		if(!isset($_POST['button'])) {
	?>

	<form action='rachunek.php' method='post' class='basic-grey'>
			<h1>Wybierz klienta</h1>

			<label>
				<span>Klient :</span>
				<select name='selection'>

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
			$id_klienta = $_POST['selection'];
			$rachunki = oci_parse($con,"Select * from rachunki where klienci_id = '$id_klienta' and zaplacony = 0");
			oci_execute($rachunki);
	?>

	<div class='basic-grey'>
		<h1>Aktualne rachunki klienta</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

		<?php
			while($row = oci_fetch_array($rachunki)) {
				$id_rachunku = $row['ID'];
				echo "<tr>";
				echo "<th rowspan='2' style='font-size: 1.5em;'>".$id_rachunku."</th>";
				echo "<th colspan='2'>Klient</th>";
				echo "<th colspan='2'>Pracownik</th>";
				echo "</tr>";

				$id_klienta = $row['KLIENCI_ID'];
				$sql_klient = oci_parse($con, "SELECT * FROM KLIENCI WHERE ID = '$id_klienta'");
				oci_execute($sql_klient);
				$klient_array = oci_fetch_array($sql_klient);

				$id_pracownika = $row['PRACOWNICY_ID'];
				$sql_pracownik = oci_parse($con, "SELECT * FROM PRACOWNICY WHERE ID = '$id_pracownika'");
				oci_execute($sql_pracownik);
				$pracownik_array = oci_fetch_array($sql_pracownik);

				echo"<tr>";
				echo"<td>".$klient_array['IMIE']."</td>";
				echo"<td>".$klient_array['NAZWISKO']."</td>";
				echo"<td>".$pracownik_array['IMIE']."</td>";
				echo"<td>".$pracownik_array['NAZIWSKO']/*<-- Typo in DB*/."</td>";
				echo"</tr>";

				echo"<tr>";
				echo"<td></td>";
				echo"<th colspan='4'>Posiłki</th>";
				echo"</tr>";

				$zamowienia_posilkow = oci_parse($con, "SELECT * FROM ZAMOWIENIA_POSILKOW WHERE RACHUNKI_ID = '$id_rachunku'");
				oci_execute($zamowienia_posilkow);

				while($posilek = oci_fetch_array($zamowienia_posilkow)) {
					echo"<tr>";
					echo"<td></td>";
					echo"<td>".$posilek['POSILKI_NAZWA']."</td>";
					echo"<td>".$posilek['ILOSC']."</td>";
					echo"<td>".$posilek['DATA']."</td>";
					echo"<td>CENA</td>";//<--UZUPEŁNIĆ
					echo"</tr>";
				}

				echo"<tr>";
				echo"<td></td>";
				echo"<th colspan='4'>Usługi</th>";
				echo"</tr>";

				$zamowienia_uslug = oci_parse($con, "SELECT * FROM ZAMOWIENIA_USLUG WHERE RACHUNKI_ID = '$id_rachunku'");
				oci_execute($zamowienia_uslug);

				while($usluga = oci_fetch_array($zamowienia_uslug)) {
					echo"<tr>";
					echo"<td></td>";
					echo"<td>".$usluga['USLUGI_NAZWA']."</td>";
					echo"<td>".$usluga['ILOSC']."</td>";
					echo"<td>".$usluga['DATA']."</td>";
					echo"<td>CENA</td>";//<--UZUPEŁNIĆ
					echo"</tr>";
				}

				echo"<tr>";
				echo"<td></td>";
				echo"<th colspan='4'>Wypożyczenia</th>";
				echo"</tr>";

				$zamowienia_wypozyczen = oci_parse($con, "SELECT * FROM ZAMOWIENIA_WYPOZYCZEN WHERE RACHUNKI_ID = '$id_rachunku'");
				oci_execute($zamowienia_wypozyczen);

				while($wypozyczenie = oci_fetch_array($zamowienia_wypozyczen)) {
					echo"<tr>";
					echo"<td></td>";
					echo"<td>".$wypozyczenie['WYPOZYCZENIA_NAZWA']."</td>";
					echo"<td>".$wypozyczenie['ILOSC']."</td>";
					echo"<td>".$wypozyczenie['DATA_OD']."-".$wypozyczenie['DATA_DO']."</td>";
					echo"<td>CENA</td>";//<--UZUPEŁNIĆ
					echo"</tr>";
				}

				echo "<tr>";
				echo "<td></td>";
				echo "<th colspan='2' style='border-bottom: solid 1px lightgrey;'>Kwota:</th>";
				echo "<td colspan='2'  style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['KWOTA']." zł</td>";
				echo "</tr>";
			}
			oci_close($con); }
		?>

		</table>
	</div>

</body>
</html>
