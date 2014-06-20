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

		$con = oci_connect("tomek", "2")or die ("could not connect to oracledb");
		$rezerwacja = oci_parse($con,"SELECT * FROM REZERWACJE WHERE DATA_DO < sysdate");
		oci_execute($rezerwacja);
	?>

	<div class='basic-grey'>
		<h1>Zakończone rezerwacje</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

		<?php
			while($row = oci_fetch_array($rezerwacja)) {
				echo "<tr>";
				echo "<th colspan='2' style='background-color: lightgrey;'>Klient</th>";
				echo "<th colspan='2' style='background-color: lightgrey;'>Obiekt</th>";
				echo "</tr>";

				$id_rachunku = $row['RACHUNEK'];
				$sql_id_klienta = oci_parse($con, "SELECT * FROM RACHUNKI WHERE ID = '$id_rachunku'");
				oci_execute($sql_id_klienta);
				$id_klienta_array = oci_fetch_array($sql_id_klienta);

				$id_klienta = $id_klienta_array['KLIENT'];
				$sql_klient = oci_parse($con, "SELECT * FROM KLIENCI WHERE ID = '$id_klienta'");
				oci_execute($sql_klient);
				$klient_array = oci_fetch_array($sql_klient);

				$id_obiektu = $row['OBIEKT'];

				echo"<tr>";
				echo"<td>".$klient_array['IMIE']."</td>";
				echo"<td>".$klient_array['NAZWISKO']."</td>";
				echo"<td colspan='2'>".$id_obiektu."</td>";
				echo"</tr>";

				echo "<tr>";
				echo "<th style='border-bottom: solid 1px lightgrey;'>Data od:</th>";
				echo "<td style='border-bottom: solid 1px lightgrey;'>".$row['DATA_OD']."</td>";
				echo "<th style='border-bottom: solid 1px lightgrey;'>Data do:</th>";
				echo "<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['DATA_DO']."</td>";
				echo "</tr>";
			}
			oci_close($con);
		?>

		</table>
	</div>
</body>
</html>
