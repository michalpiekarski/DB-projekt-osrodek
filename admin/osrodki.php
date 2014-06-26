<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('../head_css.php');
	?>

	<script src="edit-delete.js" type="text/javascript" charset="utf-8"></script>

	
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
        $page = "osrodki";
		include('nav.php');

		if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] != 'klient') {
			include('../db_connect.php');
			
			$osrodki = oci_parse($con,"SELECT * FROM OSRODKI");
			oci_execute($osrodki);
	?>

	<div class='basic-grey'>
		<h1>Ośrodki</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th rowspan='2' style='background-color: lightgrey; font-size: 1.2em;'>Nazwa</th>
					<th style='background-color: lightgrey;'>Otwarty</th>
					<th style='background-color: lightgrey;'>Telefon</th>
					<th style='background-color: lightgrey;' colspan="2" rowspan="2">Edycja</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'>Adres</th>
					<th style='background-color: lightgrey;'>E-mail</th>
				</tr>
			</thead>

			<?php
				while($row = oci_fetch_array($osrodki)) {
					echo"<tbody id='".$row['NAZWA']."'>";
						echo"<tr>";
							echo"<td rowspan='2' style='font-size: 1.4em;'>".$row['NAZWA']."</td>";
							if($row['OTWARTY']!=0) {
								echo"<td>Otwarty <input type='checkbox' checked disabled /></td>";
							} else
							{
								echo"<td>Zamknięty <input type='checkbox' disabled /></td>";
							}
							echo"<td>".$row['TELEFON']."</td>";
							echo"<td><a href='edit.php?nazwa=".$row['NAZWA']."&tabela=OSRODKI' title='Edytuj ośrodek'><span class='octicon octicon-pencil' style='min-width: 32px;'></a></td>";
						echo"</tr>";
						echo"<tr>";
							echo"<td style='border-bottom: solid 1px lightgrey;'>".$row['ULICA'].", ".$row['KOD_POCZTOWY']." ".$row['MIASTO']."</td>";
							echo"<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row['EMAIL']."</td>";
							echo"<td><a href='delete.php?nazwa=".$row['NAZWA']."&tabela=OSRODKI' title='Usuń ośrodek'><span class='octicon octicon-trashcan' style='min-width: 32px;'></span></a></td>";
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
