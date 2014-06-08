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
		$posilki = oci_parse($con,"SELECT * FROM POSILKI");
		oci_execute($posilki);
		$uslugi = oci_parse($con,"SELECT * FROM USLUGI");
		oci_execute($uslugi);
		$wypozyczenia = oci_parse($con,"SELECT * FROM WYPOZYCZENIA");
		oci_execute($wypozyczenia);
	?>

	<div class='basic-grey'>
		<h1>Typy zamówień</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th colspan='2' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Posiłki</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Cena</th>
			</tr>

			<?php
				while($row = oci_fetch_array($posilki)) {
					echo"<tr>";
					echo"<td>".$row['NAZWA']."</td>";
					echo"<td>".$row['CENA']." zł/os.</td>";
					echo"</tr>";
				}
			?>

			<tr>
				<th colspan='2' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Usługi</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Cena</th>
			</tr>

			<?php
				while($row = oci_fetch_array($uslugi)) {
					echo"<tr>";
					echo"<td>".$row['NAZWA']."</td>";
					echo"<td>".$row['CENA']." zł/os.</td>";
					echo"</tr>";
				}
			?>

			<tr>
				<th colspan='2' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Wypożyczenia</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Cena</th>
			</tr>

			<?php
				while($row = oci_fetch_array($wypozyczenia)) {
					echo"<tr>";
					echo"<td>".$row['NAZWA']."</td>";
					echo"<td>".$row['CENA']." zł/os.</td>";
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
