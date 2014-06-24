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

	<script type="text/javascript">
		function SwitchView(show, hide, title)
		{
			document.getElementById(show).style.display = 'table';
			document.getElementById(hide).style.display = 'none';
			document.getElementById('title').innerHTML = title;
		}
	</script>

	<style type="text/css">
		#select input[type='radio'] {
			width: 1.5em;
			height: 1.5em;
			margin: -5px 15px 0px -5px;
			vertical-align: middle;
		}
		#select label {
			display: inline;
			float: none;
		}
		#select label > span {
			float: none;
			font-size: 1.2em;
		}
	</style>
</head>
<body>

	<?php
        $page = "pracownicy";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] != 'klient') {
			include('../db_connect.php');
			
			$pracownicy = oci_parse($con,"SELECT * FROM PRACOWNICY");
			oci_execute($pracownicy);
			$stanowiska = oci_parse($con,"SELECT * FROM STANOWISKA");
			oci_execute($stanowiska);
	?>

	<div class='basic-grey'>
		<h1 id='title'>Pracownicy</h1>

		<form id='select' style="font-size: 1.2em; text-align: center; margin: -20px 0 10px;">
			<label>
				<span>Pracownicy :</span>
				<input type="radio" name="select" value="Pracownicy" onclick="SwitchView('tabela_pracownicy', 'tabela_stanowiska', 'Pracownicy');" checked />
			</label>
			<label>
				<span>Stanowiska :</span>
				<input type="radio" name="select" value="Stanowiska" onclick="SwitchView('tabela_stanowiska', 'tabela_pracownicy', 'Stanowiska');" />
			</label>
		</form>

		<table id='tabela_pracownicy' class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th style='background-color: lightgrey;'>Imie Nazwisko</th>
					<th style='background-color: lightgrey;'>Stanowisko - Płaca</th>
					<th style='background-color: lightgrey;'>Ośrodek</th>
				<th style='background-color: lightgrey;' colspan="2" rowspan="2">Edycja</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Adres</th>
					<th style='background-color: lightgrey;'>E-mail</th>
					<th style='background-color: lightgrey;'>Telefon</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($pracownicy)) {
					echo"<tbody id='".$row['ID']."'>";
						echo"<tr>";
							echo"<td>".$row['IMIE']." ".$row['NAZWISKO']."</td>";
							echo"<td>".$row['STANOWISKO']." - ".$row['PLACA']." zł/mies.</td>";
							echo"<td>".$row['OSRODEK']."</td>";
							echo"<td><a href='edit.php?id=".$row['ID']."&tabela=PRACOWNICY' title='Edytuj pracownika'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA']." ".$row['MIESZKANIE']." ".$row['KOD_POCZTOWY']." ".$row['MIASTO']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey;' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['EMAIL']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['TELEFON']."</td>";
							echo"<td><a href='delete.php?id=".$row['ID']."&tabela=PRACOWNICY' onclick='show_confirm();' title='Usuń pracownika'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

		</table>

		<table id='tabela_stanowiska' class='basic-grey' style='border: none; padding: 0; text-align: center; display: none;' cellpadding='5em'>
			<thead>
				<tr>
					<th style='background-color: lightgrey;'>Nazwa</th>
					<th style='background-color: lightgrey;'>Płaca od</th>
					<th style='background-color: lightgrey;'>Płaca do</th>
				<th style='background-color: lightgrey;' colspan="2">Edycja</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($stanowiska)) {
					echo"<tbody id='".$row['NAZWA']."'>";
						echo"<tr>";
							echo"<td>".$row['NAZWA']."</td>";
							echo"<td>".$row['PLACA_OD']." zł/mies.</td>";
							echo"<td>".$row['PLACA_DO']." zł/mies.</td>";
							echo"<td><a href='edit.php?id=".$row['NAZWA']."&tabela=STANOWISKA' title='Edytuj stanowisko'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
							echo"<td><a href='delete.php?id=".$row['NAZWA']."&tabela=STANOWISKA' onclick='show_confirm();' title='Usuń stanowisko'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
						echo"</tr>";
					echo"</tbody>";
				}
			?>

		</table>

		<?php
				oci_close($con);
			}
			else {
            	include('../login_error.php');
			}
		?>

	</div>
</body>
</html>
