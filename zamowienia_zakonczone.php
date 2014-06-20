<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$zamowienia_posilkow = oci_parse($con,"SELECT * FROM ZAMOWIENIA_POSILKOW WHERE DATA < sysdate");
		oci_execute($zamowienia_posilkow);
		$zamowienia_uslug = oci_parse($con,"SELECT * FROM ZAMOWIENIA_USLUG WHERE DATA < sysdate");
		oci_execute($zamowienia_uslug);
		$zamowienia_wypozyczen = oci_parse($con,"SELECT * FROM ZAMOWIENIA_WYPOZYCZEN WHERE DATA_DO < sysdate");
		oci_execute($zamowienia_wypozyczen);
	?>

	<div class='basic-grey'>
		<h1>Zamówienia</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th colspan='4' style="font-size: 1.8em;">Zamówienia posiłków</th>
			</tr>
			<tr>
				<th colspan='2' style='background-color: lightgrey;'>Klient</th>
				<th style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th colspan='2' style='background-color: lightgrey;'>Data</th>
			</tr>

			<?php
				while($row = oci_fetch_array($zamowienia_posilkow)) {
					/* POBIEŻ ID KLIENTA Z RACHUNKU DLA TEGO ZAMOWIENIA */
					$klientID = oci_parse($con, "SELECT KLIENT FROM RACHUNKI WHERE ID = ".$row['RACHUNEK']);
					oci_execute($klientID);
					$klientID = oci_fetch_array($klientID);
					/* POBIEŻ IMIE I NAZWISKO TEGO KLIENTA */
					$klient = oci_parse($con, "SELECT IMIE, NAZWISKO FROM KLIENCI WHERE ID = ".$klientID['KLIENT']);
					oci_execute($klient);
					$klient = oci_fetch_array($klient);

					echo"<tr>";
					echo"<td>".$klient['IMIE']."</td>";
					echo"<td>".$klient['NAZWISKO']."</td>";
					echo"<td>".$row['TYP']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>".$row['ILOSC']."</td>";
					echo"<td colspan='2' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['DATA']."</td>";
					echo"</tr>";
				}
			?>

			<tr>
				<th colspan='4' style="font-size: 1.8em;">Zamówienia usług</th>
			</tr>
			<tr>
				<th colspan='2' style='background-color: lightgrey;'>Klient</th>
				<th style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th colspan='2' style='background-color: lightgrey;'>Data</th>
			</tr>

			<?php
				while($row = oci_fetch_array($zamowienia_uslug)) {
					/* POBIEŻ ID KLIENTA Z RACHUNKU DLA TEGO ZAMOWIENIA */
					$klientID = oci_parse($con, "SELECT KLIENT FROM RACHUNKI WHERE ID = ".$row['RACHUNEK']);
					oci_execute($klientID);
					$klientID = oci_fetch_array($klientID);
					/* POBIEŻ IMIE I NAZWISKO TEGO KLIENTA */
					$klient = oci_parse($con, "SELECT IMIE, NAZWISKO FROM KLIENCI WHERE ID = ".$klientID['KLIENT']);
					oci_execute($klient);
					$klient = oci_fetch_array($klient);

					echo"<tr>";
					echo"<td>".$klient['IMIE']."</td>";
					echo"<td>".$klient['NAZWISKO']."</td>";
					echo"<td>".$row['TYP']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>".$row['ILOSC']."</td>";
					echo"<td colspan='2' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['DATA']."</td>";
					echo"</tr>";
				}
			?>

			<tr>
				<th colspan='4' style="font-size: 1.8em;">Zamówienia wypożyczeń</th>
			</tr>
			<tr>
				<th colspan='2' style='background-color: lightgrey;'>Klient</th>
				<th style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th style='background-color: lightgrey;'>Data od</th>
				<th style='background-color: lightgrey;'>Data do</th>
			</tr>

			<?php
				while($row = oci_fetch_array($zamowienia_wypozyczen)) {
					/* POBIEŻ ID KLIENTA Z RACHUNKU DLA TEGO ZAMOWIENIA */
					$klientID = oci_parse($con, "SELECT KLIENT FROM RACHUNKI WHERE ID = ".$row['RACHUNEK']);
					oci_execute($klientID);
					$klientID = oci_fetch_array($klientID);
					/* POBIEŻ IMIE I NAZWISKO TEGO KLIENTA */
					$klient = oci_parse($con, "SELECT IMIE, NAZWISKO FROM KLIENCI WHERE ID = ".$klientID['KLIENT']);
					oci_execute($klient);
					$klient = oci_fetch_array($klient);

					echo"<tr>";
					echo"<td>".$klient['IMIE']."</td>";
					echo"<td>".$klient['NAZWISKO']."</td>";
					echo"<td>".$row['TYP']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>".$row['ILOSC']."</td>";
					echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['DATA_OD']."</td>";
					echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['DATA_DO']."</td>";
					echo"</tr>";
				}
			?>

		</table>

		<?php
			oci_close($con);
		?>

	</div>
</body>
</html>
