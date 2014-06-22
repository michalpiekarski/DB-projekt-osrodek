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
        $page = "klienci";
		include('nav.php');

		if(isset($_COOKIE['logpass'])) {
			$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
			$klienci = oci_parse($con,"SELECT * FROM KLIENCI");
			oci_execute($klienci);
	?>

	<div class='basic-grey'>
		<h1>Klienci</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th style='background-color: lightgrey;'>Imię</th>
					<th style='background-color: lightgrey;'>Nazwisko</th>
					<th style='background-color: lightgrey;'>Telefon</th>
					<th style='background-color: lightgrey;'>E-mail</th>
					<th style='background-color: lightgrey;' colspan="2" rowspan="2">Edycja</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Ulica</th>
					<th style='background-color: lightgrey;'>Mieszkanie</th>
					<th style='background-color: lightgrey;'>Kod pocztowy</th>
					<th style='background-color: lightgrey;'>Miasto</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($klienci)) {
					echo"<tbody id='".$row['ID']."'>";
						echo"<tr>";
							echo"<td>".$row['IMIE']."</td>";
							echo"<td>".$row['NAZWISKO']."</td>";
							echo"<td>".$row['TELEFON']."</td>";
							echo"<td>".$row['EMAIL']."</td>";
							echo"<td><a class='edit-button' href='edit.php?id=".$row['ID']."&tabela=KLIENCI' title='Edytuj klienta'>Edytuj</a></td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['MIESZKANIE']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['KOD_POCZTOWY']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['MIASTO']."</td>";
							echo"<td><a class='delete-button' href='delete.php?id=".$row['ID']."&tabela=KLIENCI' onclick='show_confirm();' title='Usuń klienta'>Usuń</a></td>";
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
	?>

	    <div class='basic-grey'>
	        <h1>Nie jesteś zalogowany</h1>
	        <h3>Aby uzyskać dostęp do systemu zarzdzania ośrodkiem musisz się zalogować</h3>
	    </div>

	<?php
		}
	?>

</body>
</html>
