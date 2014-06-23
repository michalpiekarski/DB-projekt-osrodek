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
        $page = "konta";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
			$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
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
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($konta)) {
					echo"<tbody id='".$row['LOGIN']."'>";
						echo"<tr>";
							echo"<td>".$row['LOGIN']."</td>";
							echo"<td>".$row['HASLO']."</td>";
							echo"<td>".$row['TYP']."</td>";
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
