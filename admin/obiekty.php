<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
	<script type="text/javascript">
	function SwitchView(show, hide, title)
	{
		document.getElementById(show).style.display = 'table';
		document.getElementById(hide).style.display = 'none';
		document.getElementById('title').innerHTML = title;
	}
	</script>
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$obiekty = oci_parse($con,"SELECT * FROM OBIEKTY");
		oci_execute($obiekty);
		$typy_obiektow = oci_parse($con,"SELECT * FROM TYPY_OBIEKTOW");
		oci_execute($typy_obiektow);
	?>

	<div class='basic-grey'>
		<h1 id='title'>Obiekty</h1>
		<form style="text-align: center;">
			Obiekty :
			<input type="radio" name="obiekty" value="Obiekty" checked onclick="SwitchView('obiekty', 'typy_obiektow', 'Obiekty');" />
			Typy obiektów :
			<input type="radio" name="obiekty" value="Typy obiektów" onclick="SwitchView('typy_obiektow', 'obiekty', 'Typy obiektów');" />
		</form>

		<table id='obiekty' class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th style='background-color: lightgrey;'>ID</th>
				<th style='background-color: lightgrey;'>Ośrodek</th>
				<th style='background-color: lightgrey;'>Typ</th>
				<th style='background-color: lightgrey;'>Budynek</th>
				<th style='background-color: lightgrey;'>Numer</th>
			</tr>

			<?php
				while($row = oci_fetch_array($obiekty)) {
					echo"<tr>";
					echo"<td>".$row['ID']."</td>";
					echo"<td>".$row['OSRODEK']."</td>";
					echo"<td>".$row['TYP']."</td>";
					echo"<td>".$row['BUDYNEK']."</td>";
					echo"<td>".$row['NUMER']."</td>";
					echo"</tr>";
				}
			?>

		</table>

		<table id='typy_obiektow' class='basic-grey' style='border: none; padding: 0; text-align: center; display: none;' cellpadding='5em'>
			<tr>
				<th style='background-color: lightgrey;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Ilość miejsc</th>
				<th style='background-color: lightgrey;'>Cena</th>
			</tr>

			<?php
				while($row = oci_fetch_array($typy_obiektow)) {
					echo"<tr>";
					echo"<td>".$row['NAZWA']."</td>";
					echo"<td>".$row['ILOSC_MIEJSC']."</td>";
					echo"<td>".$row['CENA']." zł/dobę</td>";
					echo"</tr>";
				}
			?>

		</table>

		<?php
			oci_close($con);
		?>

	</div>
</body>
</html>
