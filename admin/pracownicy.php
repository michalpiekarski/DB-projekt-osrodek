<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$pracownicy = oci_parse($con,"SELECT * FROM PRACOWNICY");
		oci_execute($pracownicy);
	?>

	<div class='basic-grey'>
		<h1>Pracownicy</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th rowspan='2' style='background-color: lightgrey; font-size: 1.4em;'>ID</th>
				<th style='background-color: lightgrey;'>Imie Nazwisko</th>
				<th style='background-color: lightgrey;'>Stanowisko - Płaca</th>
				<th style='background-color: lightgrey;'>Ośrodek</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Adres</th>
				<th style='background-color: lightgrey;'>E-mail</th>
				<th style='background-color: lightgrey;'>Telefon</th>
			</tr>

			<?php
				while($row = oci_fetch_array($pracownicy)) {
					echo"<tr>";
					echo"<td rowspan='2' style='font-size: 1.4em;'>".$row['ID']."</td>";
					echo"<td>".$row['IMIE']." ".$row['NAZWISKO']."</td>";
					echo"<td>".$row['STANOWISKO']." - ".$row['PLACA']." zł/mies.</td>";
					echo"<td>".$row['OSRODEK']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA']." ".$row['MIESZKANIE']." ".$row['KOD_POCZTOWY']." ".$row['MIASTO']."</td>";
					echo"<td style='border-bottom: solid 1px lightgrey;' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['EMAIL']."</td>";
					echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['TELEFON']."</td>";
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
