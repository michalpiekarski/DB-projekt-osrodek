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

	






			  function ToggleEditable(button) 
			  {
          			
			  	 
          			
	
            if (div.contentEditable == "true") {
            for(var i=0;i<document.getElementsByName('name').length;i++){
			document.getElementsByName('name')[i].contentEditable=false;}
                button.innerHTML = "Edytuj";
            }
            else {
            	for(var i=0;i<document.getElementsByName(button).length;i++){
				document.getElementsByName(button)[i].contentEditable=true;}
                button.innerHTML = "Zakończ";
            }
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
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$obiekty = oci_parse($con,"SELECT * FROM OBIEKTY");
		oci_execute($obiekty);
		$typy_obiektow = oci_parse($con,"SELECT * FROM TYPY_OBIEKTOW");
		oci_execute($typy_obiektow);
		$licznik=0;
	?>

	<div class='basic-grey'>
		<h1 id='title'>Obiekty</h1>

		<form id='select' style="font-size: 1.2em; text-align: center; margin: -20px 0 10px;">
			<label>
				<span>Obiekty :</span>
				<input type='radio' name='select' onclick="SwitchView('obiekty', 'typy_obiektow', 'Obiekty');" checked />
			</label>
			<label>
				<span>Typy obiektów :</span>
				<input type='radio' name='select' onclick="SwitchView('typy_obiektow', 'obiekty', 'Typy obiektów');" />
			</label>
		</form>

		<table id='obiekty' class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th style='background-color: lightgrey;'>ID</th>
				<th style='background-color: lightgrey;'>Ośrodek</th>
				<th style='background-color: lightgrey;'>Typ</th>
				<th style='background-color: lightgrey;'>Budynek</th>
				<th style='background-color: lightgrey;'>Numer</th>
				<th style='background-color: lightgrey;' colspan="2">Edycja</th>
			</tr>

			<?php
				while($row = oci_fetch_array($obiekty)) {
					$licznik=$licznik+1;
					echo"<tr>";
					echo"<td><div name='Edit$licznik' contenteditable='false'>".$row['ID']."</div></td>";
					echo"<td><div name='Edit$licznik' contenteditable='false'>".$row['OSRODEK']."</div></td>";
					echo"<td><div name='Edit$licznik' contenteditable='false'>".$row['TYP']."</div></td>";
					echo"<td><div name='Edit$licznik' contenteditable='false'>".$row['BUDYNEK']."</div></td>";
					echo"<td><div name='Edit$licznik' contenteditable='false'>".$row['NUMER']."</div></td>";
					echo"<td><a href='delete.php?id=".$row['ID']."&typ=".$row['TYP']."&numer=".$row['NUMER']."'>Usuń</a></td>";
					//echo"<td><a href='edit.php?id=".$row['ID']."&osrodek=".$row['OSRODEK']."&typ=".$row['TYP']."&budynek=".$row['BUDYNEK']."&numer=".$row['NUMER']."'>Edytuj</a></td>";
					echo"<td><button value='Edit$licznik' onclick='ToggleEditable(this.value);'>Edytuj</button></td>";
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
