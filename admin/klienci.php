<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />

	<script type="text/javascript">
		var editMode = false;
		var deleteMode = false;
		function SwitchEditMode(id) {
			if(!deleteMode) {
				var editLink = document.getElementById(id.concat('edit')).firstChild;
				var deleteLink = document.getElementById(id.concat('delete')).firstChild;
				if(!editMode) {
					editMode = true;
					editLink.innerHTML = 'A';
					deleteLink.removeEventListener('click', SwitchDeleteMode);
				} else
				{
					editMode = false;
					editLink.innerHTML = 'E';
					deleteLink.addEventListener('click', SwitchDeleteMode);
				}
			}
		}
		function SwitchDeleteMode(id) {
			if(!editMode) {
				var editLink = document.getElementById(id.concat('edit')).firstChild;
				var deleteLink = document.getElementById(id.concat('delete')).firstChild;
				if(!deleteMode) {
					deleteMode = true;
					deleteLink.innerHTML = 'A';
					editLink.removeEventListener('click', SwitchEditMode);
				} else
				{
					deleteMode = false;
					deleteLink.innerHTML = 'U';
					editLink.addEventListener('click', SwitchEditMode);
				}
			}
		}
	</script>

	<style type="text/css">
		.mode a {
			text-decoration: none;
		}
	</style>
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$klienci = oci_parse($con,"SELECT * FROM KLIENCI");
		oci_execute($klienci);
	?>

	<div class='basic-grey'>
		<h1>Klienci</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th rowspan='2' style='background-color: lightgrey; font-size: 1.4em;'>ID</th>
					<th style='background-color: lightgrey;'>Imię</th>
					<th style='background-color: lightgrey;'>Nazwisko</th>
					<th style='background-color: lightgrey;'>Telefon</th>
					<th style='background-color: lightgrey;'>E-mail</th>
					<th rowspan='2' style='background-color: lightgrey;'>E</th>
					<th rowspan='2' style='background-color: lightgrey;'>U</th>
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
							echo"<td rowspan='2' style='font-size: 1.4em;'>".$row['ID']."</td>";
							echo"<td>".$row['IMIE']."</td>";
							echo"<td>".$row['NAZWISKO']."</td>";
							echo"<td>".$row['TELEFON']."</td>";
							echo"<td>".$row['EMAIL']."</td>";
							echo"<td id='".$row['ID']."edit' class='mode' rowspan='2'><a href='#edit' onclick='SwitchEditMode(\"".$row['ID']."\")'>E</a></td>";
							echo"<td id='".$row['ID']."delete' class='mode' rowspan='2'><a href='#delete' onclick='SwitchDeleteMode(\"".$row['ID']."\")'>U</a></td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['MIESZKANIE']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['KOD_POCZTOWY']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['MIASTO']."</td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

		</table>

		<?php
			oci_close($con);
		?>

	</div>
</body>
</html>
