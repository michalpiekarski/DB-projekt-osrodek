<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />

	<script src="edit-delete.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript">
		function show_confirm() {
			var r=confirm("Usunięcie jest bezpowrotne. Kontynuować?");
		}
	</script>

	<style type="text/css">
		.mode a {
			text-decoration: none;
		}
		.deletedRecord {
			background-color: red;
		}
	</style>
</head>
<body>

	<?php
		$page = "typy_zamowien";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] != 'klient') {
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
			<thead>
				<tr>
					<th colspan='4' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Posiłki</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Nazwa</th>
					<th style='background-color: lightgrey;'>Cena</th>
					<th style='background-color: lightgrey;' colspan="2">Edycja</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($posilki)) {
					echo"<tbody id='".$row['NAZWA']."'>";
						echo"<tr>";
							echo"<td>".$row['NAZWA']."</td>";
							echo"<td>".$row['CENA']." zł/os.</td>";
							echo"<td><a class='edit-button' href='edit.php?id=".$row['NAZWA']."&tabela=POSILKI' title='Edytuj typ posiłku'>Edytuj</a></td>";
							echo"<td><a class='delete-button' href='delete.php?id=".$row['NAZWA']."&tabela=POSILKI' onclick='show_confirm();' title='Usuń typ posiłku'>Usuń</a></td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

			<thead>
				<tr>
					<th colspan='4' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Usługi</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Nazwa</th>
					<th style='background-color: lightgrey;'>Cena</th>
					<th style='background-color: lightgrey;' colspan="2">Edycja</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($uslugi)) {
					echo"<tbody id='".$row['NAZWA']."'>";
						echo"<tr>";
							echo"<td>".$row['NAZWA']."</td>";
							echo"<td>".$row['CENA']." zł/os.</td>";
							echo"<td><a class='edit-button' href='edit.php?id=".$row['NAZWA']."&tabela=USLUGI' title='Edytuj typ usługi'>Edytuj</a></td>";
							echo"<td><a class='delete-button' href='delete.php?id=".$row['NAZWA']."&tabela=USLUGI' onclick='show_confirm();' title='Usuń typ usługi'>Usuń</a></td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

			<thead>
				<tr>
					<th colspan='4' style="font-size: 1.8em; border-top: solid 1px lightgrey;">Wypożyczenia</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Nazwa</th>
					<th style='background-color: lightgrey;'>Cena</th>
					<th style='background-color: lightgrey;' colspan="2">Edycja</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($wypozyczenia)) {
					echo"<tbody id='".$row['NAZWA']."'>";
						echo"<tr>";
							echo"<td>".$row['NAZWA']."</td>";
							echo"<td>".$row['CENA']." zł/os.</td>";
							echo"<td><a class='edit-button' href='edit.php?id=".$row['NAZWA']."&tabela=WYPOZYCZENIA' title='Edytuj typ wypożyczenia'>Edytuj</a></td>";
							echo"<td><a class='delete-button' href='delete.php?id=".$row['NAZWA']."&tabela=WYPOZYCZENIA' onclick='show_confirm();' title='Usuń typ wypożyczenia'>Usuń</a></td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

		</table>
	</div>

	<?php
			oci_close($con);
		}
		else {
            include('../login_error.php');
		}
	?>

</body>
</html>
