<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('../head_css.php');
	?>

	<script type="text/javascript">
		function SwitchView(show, hide, title) {
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
        $page = "obiekty";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] != 'klient') {
			include('../db_connect.php');
			
			$obiekty = oci_parse($con,"SELECT * FROM OBIEKTY");
			oci_execute($obiekty);
			$typy_obiektow = oci_parse($con,"SELECT * FROM TYPY_OBIEKTOW");
			oci_execute($typy_obiektow);
	?>

	<div class='basic-grey'>
		<h1 id='title'>Obiekty</h1>

		<form id='select' style="font-size: 1.2em; text-align: center; margin: -20px 0 10px;">
			<label>
				<span>Obiekty :</span>
				<input type='radio' name='select' onclick="SwitchView('tabela_obiekty', 'tabela_typy_obiektow', 'Obiekty');" checked />
			</label>
			<label>
				<span>Typy obiektów :</span>
				<input type='radio' name='select' onclick="SwitchView('tabela_typy_obiektow', 'tabela_obiekty', 'Typy obiektów');" />
			</label>
		</form>

		<table id='tabela_obiekty' class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th style='background-color: lightgrey;'>Ośrodek</th>
				<th style='background-color: lightgrey;'>Typ</th>
				<th style='background-color: lightgrey;'>Budynek</th>
				<th style='background-color: lightgrey;'>Numer</th>
				<th style='background-color: lightgrey;' colspan="2">Edycja</th>
			</tr>

			<?php
				while($row = oci_fetch_array($obiekty)) {
					echo"<tr>";
					echo"<td>".$row['OSRODEK']."</td>";
					echo"<td>".$row['TYP']."</td>";
					echo"<td>".$row['BUDYNEK']."</td>";
					echo"<td>".$row['NUMER']."</td>";
					echo"<td><a href='edit.php?id=".$row['ID']."&tabela=OBIEKTY' title='Edytuj obiekt'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
					echo"<td><a href='delete.php?id=".$row['ID']."&tabela=OBIEKTY' title='Usuń obiekt'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
					echo"</tr>";
				}
			?>

		</table>

		<table id='tabela_typy_obiektow' class='basic-grey' style='border: none; padding: 0; text-align: center; display: none;' cellpadding='5em'>
			<tr>
				<th style='background-color: lightgrey;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Ilość miejsc</th>
				<th style='background-color: lightgrey;'>Cena</th>
				<th style='background-color: lightgrey;' colspan="2">Edycja</th>
			</tr>

			<?php
				while($row = oci_fetch_array($typy_obiektow)) {
					echo"<tr>";
					echo"<td>".$row['NAZWA']."</td>";
					echo"<td>".$row['ILOSC_MIEJSC']."</td>";
					echo"<td>".$row['CENA']." zł/dobę</td>";
					echo"<td><a href='edit.php?id=".$row['NAZWA']."&tabela=TYPY_OBIEKTOW' title='Edytuj typ obiektu'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
					echo"<td><a href='delete.php?nazwa=".$row['NAZWA']."&tabela=TYPY_OBIEKTOW' title='Usuń typ obiektu'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
					echo"</tr>";
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
