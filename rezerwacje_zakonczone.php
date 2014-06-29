<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('head_css.php');
		include('validation.php');
	?>

	<script type="text/javascript" src="/bazy/js/rezerwacje_zakonczone.js"></script>
</head>
<body>

	<?php
        $page = "rezerwacje";
		include('nav.php');

		if(isset($_COOKIE['logpass'])) {
			include('db_connect.php');

			if(!isset($_POST['button'])) {
				$klient = oci_parse($con,"SELECT ID, IMIE, NAZWISKO FROM KLIENCI");
				oci_execute($klient);
	?>

	<form id="rezerwacje_zakonczone_klient_form" action='rezerwacje_zakonczone.php' method='post' class='basic-grey'>
			<h1>Wybierz klienta</h1>

			<h2>
				<div class="wizard-steps">
					<div class="active-step">
						<a><span>1</span> Klient</a>
					</div>
					<div>
						<a><span>2</span> Zakończone rezerwacje klienta</a>
					</div>
				</div>
			</h2>

			<label title="Pole jest wymagane">
				<span>Klient* :</span>
				<select name='klient'>
					<option value='' selected></option>

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
			$id_klienta = $_POST['klient'];
			$rachunki = oci_parse($con, "SELECT * FROM RACHUNKI WHERE KLIENT = $id_klienta");
			oci_execute($rachunki);
	?>

	<div class='basic-grey'>
		<h1>Zakończone rezerwacje</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step hoverable">
					<a href="rezerwacje_zakonczone.php"><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Zakończone rezerwacje klienta</a>
				</div>
			</div>
		</h2>

		<table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
			<thead>
				<tr>
					<th colspan='3' style='background-color: lightgrey;'>Obiekt</th>
				</tr>
				<tr>
					<th style='background-color: lightgrey;'></th>
					<th style='background-color: lightgrey;'>Data od</th>
					<th style='background-color: lightgrey;'>Data do</th>
				</tr>
			</thead>
			<tbody>

			<?php
				while($row = oci_fetch_array($rachunki)) {
					$rezerwacje = oci_parse($con,"SELECT * FROM REZERWACJE WHERE DATA_DO < sysdate AND RACHUNEK = ".$row['ID']);
					oci_execute($rezerwacje);
					while($row2 = oci_fetch_array($rezerwacje)) {
						$obiekt = oci_parse($con,"SELECT * FROM OBIEKTY WHERE ID = ".$row2['OBIEKT']);
						oci_execute($obiekt);
						$obiekt = oci_fetch_array($obiekt);

						echo"<tr>";
							echo"<td>".$obiekt['TYP']."</td>";
							echo"<td>".$obiekt['BUDYNEK']."</td>";
							echo"<td>".$obiekt['NUMER']."</td>";
						echo"</tr>";
						echo "<tr>";
							echo "<td style='border-bottom: solid 1px lightgrey;'></td>";
							echo "<td style='border-bottom: solid 1px lightgrey;'>".$row2['DATA_OD']."</td>";
							echo "<td style='border-bottom: solid 1px lightgrey; border-right: solid 1px lightgrey;'>".$row2['DATA_DO']."</td>";
						echo "</tr>";
					}
				}
			?>

			</tbody>
		</table>
	</div>

	<?php
			}
			oci_close($con);
		}
		else {
            include('login_error.php');
		}
	?>
</body>
</html>
