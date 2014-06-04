<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
		$klient = oci_parse($con,"SELECT ID, IMIE, NAZWISKO FROM KLIENCI");
		oci_execute($klient);

		if(!isset($_POST['button'])) {
	?>

	<form action='rachunek.php' method='post' class='basic-grey'>
			<h1>Wybierz klienta</h1>

			<label>
				<span>Klient :</span>
				<select name='selection'>

					<?php
						while($row = oci_fetch_array($klient))
							echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";
					?>

				</select>
			</label>
			<label>
				<span>&nbsp;</span>
				<input type="SUBMIT" name="button" class="button" value="Wyślij" />
			</label>
	</form>

	<?php
		}

		if(isset($_POST['button'])) {
			$id_klienta = $_POST['selection'];
			$rachunki = oci_parse($con,"Select * from rachunki where klienci_id = '$id_klienta' and zaplacony = 0");
			oci_execute($rachunki);
	?>

	<div class='basic-grey'>
		<h1>Aktualne rachunki klienta</h1>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>

		<?php
			while($row = oci_fetch_array($rachunki)) {
				echo "<tr>";
				echo "<td rowspan='2' style='font-size: 1.5em;'>".$row['ID']."</td>";
				echo "<td>ID Klienta: ".$row['KLIENCI_ID']."</td>";
				echo "<td>ID Pracownika: ".$row['PRACOWNICY_ID']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan='2' style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>Kwota: ".$row['KWOTA']." zł</td>";
				echo "</tr>";
			}
			oci_close($con); }
		?>

		</table>
	</div>

</body>
</html>
