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
		$page = "zamowienia";
		include('nav.php');

		if(isset($_COOKIE['logpass'])) {
			$con = oci_connect("tomek", "2")or die ("could not connect to oracledb");
			$klient = oci_parse($con,"Select ID,imie, nazwisko from klienci");
			oci_execute($klient);

			if(!isset($_POST['button'])) {
	?>

	<form action='wypozyczenie.php' method='post' class='basic-grey'>
		<h1>Wybierz klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="active-step">
					<a><span>1</span> Klient</a>
				</div>
				<div>
					<a><span>2</span> Wypożyczenie</a>
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
			$wypozyczenia = oci_parse($con, "Select * from wypozyczenia");
			oci_execute($wypozyczenia);
	?>

	<form action='wypozyczenia2.php' method='post' class='basic-grey'>
		<h1>Wybierz Wypożyczenie</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step">
					<a><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Wypożyczenie</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<label>
			<span>Wypożyczenie :</span>
			<select name='wypozyczenia'>

				<?php
					while($row = oci_fetch_array($wypozyczenia))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
				?>

			</select>
		</label>
		<label>
			<span>Ilość :</span>
			<input type='number' name='wypozyczenia_ilosc' min='0' max='8'>
		</label>
		<label>
			<span>Data od:</span>
			<input type='date' name='wypozyczenia_data_od'>
		</label>
		<label>
			<span>Data do:</span>
			<input type='date' name='wypozyczenia_data_do'>
		</label>

		<?php
			echo"<input type='hidden' name='ID' value='$id_klienta' />";
		?>

		<label>
			<span>&nbsp;</span>
			<input type='SUBMIT' class='button' value='Wypożycz' />
		</label>
	</form>

	<?php
			}
			oci_close($con);
		}
		else {
	?>

    <div class='basic-grey'>
        <h1>Nie jesteś zalogowany</h1>
        <h3>Aby uzyskać dostęp do systemu zarzdzania ośrodkiem musisz się zalogować</h3>
    </div>

	<?php
		}
	?>

</body>
</html>
