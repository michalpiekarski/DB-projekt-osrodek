<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('../head_css.php');
	?>

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
        $page = "konta";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
			include('../db_connect.php');
			
			$konta = oci_parse($con,"SELECT * FROM DANE_LOGOWANIA");
			oci_execute($konta);
	?>

	<div class='basic-grey'>
		<h1>Konta</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th style='background-color: lightgrey;'>Login</th>
					<th style='background-color: lightgrey;'>Hasło</th>
					<th style='background-color: lightgrey;'>Typ</th>
					<th style='background-color: lightgrey;' colspan="2" rowspan="2">Edycja</th
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($konta)) {
					echo"<tbody id='".$row['LOGIN']."'>";
						echo"<tr>";
							echo"<td>".$row['LOGIN']."</td>";
							echo"<td>".$row['HASLO']."</td>";
							echo"<td>".$row['TYP']."</td>";
							echo"<td><a class='edit-button' href='edit.php?id=".$row['LOGIN']."&tabela=DANE_LOGOWANIA' title='Edytuj konto'>Edytuj</a></td>";
							echo"<td><a class='delete-button' href='delete.php?id=".$row['LOGIN']."&tabela=DANE_LOGOWANIA' onclick='show_confirm();' title='Usuń konto'>Usuń</a></td>";
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
