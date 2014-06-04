<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2", "localhost:1521/XE")or die ("could not connect to oracledb");
		$rezerwacja = oci_parse($con,"SELECT * FROM REZERWACJE WHERE DATA_DO > sysdate");
		oci_execute($rezerwacja);
	?>

	<div class='basic-grey'>
		<h1>Aktualne rezerwacje</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

		<?php
			while($row = oci_fetch_array($rezerwacja)) {
				echo "<tr>";
				echo "<td rowspan='2' style='font-size: 1.5em;'>".$row['ID']."</td>";
				echo "<td>ID Rachunku: ".$row['RACHUNKI_ID']."</td>";
				echo "<td>ID Obiektu: ".$row['OBIEKTY_ID']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td style='border-bottom: solid 1px lightgrey;'>Data od: ".$row['DATA_OD']."</td>";
				echo "<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>Data do: ".$row['DATA_DO']."</td>";
				echo "</tr>";
			}
			oci_close($con);
		?>

		</table>
	</div>
</body>
</html>
