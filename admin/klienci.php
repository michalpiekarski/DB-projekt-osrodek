<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include('../head_css.php');
		?>

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

			if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] != 'klient') {
				include('../db_connect.php');

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
								echo"<td><a href='edit.php?id=".$row['ID']."&tabela=KLIENCI' title='Edytuj klienta'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
							echo"</tr>";
							echo"<tr>";
								echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA']."</td>";
								echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['MIESZKANIE']."</td>";
								echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['KOD_POCZTOWY']."</td>";
								echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['MIASTO']."</td>";
								echo"<td><a href='delete.php?id=".$row['ID']."&tabela=KLIENCI' title='Usuń klienta'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
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
