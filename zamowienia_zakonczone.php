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
			$klient = oci_parse($con,"SELECT * FROM KLIENCI");
			oci_execute($klient);
	?>

	<form action='zamowienia_zakonczone.php' method='post' class='basic-grey'>
			<h1>Wybierz klienta</h1>

			<h2>
				<div class="wizard-steps">
					<div class="active-step">
						<a><span>1</span> Klient</a>
					</div>
					<div>
						<a><span>2</span> Zakończone zamówienia klienta</a>
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
			$rachunki = oci_parse($con,"SELECT * FROM RACHUNKI WHERE KLIENT = $id_klienta");
			oci_execute($rachunki);
	?>

	<div class='basic-grey'>
		<h1>Zamówienia</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step hoverable">
					<a href="zamowienia_zakonczone.php"><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Zakończone zamówienia klienta</a>
				</div>
			</div>
		</h2>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th colspan='3' style="font-size: 1.8em;">Zamówienia posiłków</th>
			</tr>
			<tr>
				<th colspan='3' style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th colspan='2' style='background-color: lightgrey;'>Data</th>
			</tr>

			<?php
				while($row = oci_fetch_array($rachunki)) {
					$id_rachunku = $row['ID'];
					$zamowienia_posilkow = oci_parse($con,"SELECT * FROM ZAMOWIENIA_POSILKOW WHERE DATA < sysdate AND RACHUNEK = ".$row['ID']);
					oci_execute($zamowienia_posilkow);
					while($row2 = oci_fetch_array($zamowienia_posilkow)) {
						echo"<tr>";
							echo"<td colspan='3'>".$row2['TYP']."</td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td>".$row2['ILOSC']."</td>";
							echo"<td colspan='2' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row2['DATA']."</td>";
						echo"</tr>";
					}
				}
			?>

			<tr>
				<th colspan='3' style="font-size: 1.8em;">Zamówienia usług</th>
			</tr>
			<tr>
				<th colspan='3' style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th colspan='2' style='background-color: lightgrey;'>Data</th>
			</tr>

			<?php
				while($row = oci_fetch_array($rachunki))
				{
					$zamowienia_uslug = oci_parse($con,"SELECT * FROM ZAMOWIENIA_USLUG WHERE DATA < sysdate AND RACHUNEK = ".$row['ID']);
					oci_execute($zamowienia_uslug);
					while($row2 = oci_fetch_array($zamowienia_uslug)) {
						echo"<tr>";
							echo"<td colspan='3'>".$row2['TYP']."</td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td>".$row2['ILOSC']."</td>";
							echo"<td colspan='2' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row2['DATA']."</td>";
						echo"</tr>";
					}
				}
			?>

			<tr>
				<th colspan='3' style="font-size: 1.8em;">Zamówienia wypożyczeń</th>
			</tr>
			<tr>
				<th colspan='3' style='background-color: lightgrey;'>Typ</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Ilość</th>
				<th style='background-color: lightgrey;'>Data od</th>
				<th style='background-color: lightgrey;'>Data do</th>
			</tr>

			<?php
				while($row = oci_fetch_array($rachunki)) {
					$zamowienia_wypozyczen = oci_parse($con,"SELECT * FROM ZAMOWIENIA_WYPOZYCZEN WHERE DATA_DO < sysdate AND RACHUNEK = ".$row['ID']);
					oci_execute($zamowienia_wypozyczen);
					while($row2 = oci_fetch_array($zamowienia_wypozyczen)) {
						echo"<tr>";
							echo"<td colspan='3'>".$row2['TYP']."</td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td>".$row2['ILOSC']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row2['DATA_OD']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row2['DATA_DO']."</td>";
						echo"</tr>";
					}
				}
			?>

		</table>
	</div>

	<?php
		}
		oci_close($con);
	?>

</body>
</html>
