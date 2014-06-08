<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$osrodki = oci_parse($con,"SELECT * FROM OSRODKI");
		oci_execute($osrodki);
	?>

	<div class='basic-grey'>
		<h1>Ośrodki</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<tr>
				<th rowspan='2' style='background-color: lightgrey; font-size: 1.2em;'>Nazwa</th>
				<th style='background-color: lightgrey;'>Otwarty</th>
				<th style='background-color: lightgrey;'>Telefon</th>
			</tr>
			<tr>
				<th style='background-color: lightgrey;'>Adres</th>
				<th style='background-color: lightgrey;'>E-mail</th>
			</tr>

			<?php
				while($row = oci_fetch_array($osrodki)) {
					echo"<tr>";
					echo"<td rowspan='2' style='font-size: 1.4em;'>".$row['NAZWA']."</td>";
					if($row['OTWARTY']!=0) {
						echo"<td>Otwarty <input type='checkbox' checked disabled /></td>";
					} else
					{
						echo"<td>Zamknięty <input type='checkbox' disabled /></td>";
					}
					echo"<td>".$row['TELEFON']."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA'].", ".$row['KOD_POCZTOWY']." ".$row['MIASTO']."</td>";
					echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['EMAIL']."</td>";
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