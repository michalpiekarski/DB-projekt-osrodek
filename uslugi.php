<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
</head>
<body>

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2")or die ("could not connect to oracledb");

		$klient = oci_parse($con,"Select ID,imie, nazwisko from klienci");
		oci_execute($klient);

		if(!isset($_POST['button'])) {
	?>

	<form action='uslugi.php' method='post' class='basic-grey'>
		<h1>Wybierz klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="active-step">
					<a><span>1</span> Klient</a>
				</div>
				<div>
					<a><span>2</span> Usługa</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

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
			<input type='SUBMIT' name='button' class='button' value='Dalej' />
		</label>
	</form>

	<?php
		}

		if(isset($_POST['button'])) {
			$id_klienta = $_POST['selection'];
			$usluga = oci_parse($con,"Select * from uslugi");
			oci_execute($usluga);
	?>

	<form action='uslugi2.php' method='post' class='basic-grey'>
		<h1>Wybierz usługę</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step">
					<a><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Usługa</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<label>
			<span>Usługa :</span>
			<select name='usluga'>

				<?php
					while($row = oci_fetch_array($usluga))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']." - ".$row['CENA']." zł</option>";
				?>

			</select>
		</label>
		<label>
			<span>Ilość :</span>
			<input type='number' name='usluga_ilosc' value='1' min='1' max='5'></label>
		<label>
			<span>Data :</span>
			<input type='date' name='usluga_data'>
		</label>

		<?php
			echo"<input type='hidden' name='ID' value='$id_klienta' />";
		?>

		<label>
			<span>&nbsp;</span>
			<input type='SUBMIT' class='button' value='Dodaj Usługę' />
		</label>
	</form>

	<?php
		oci_close($con); }
	?>

</body>
</html>
