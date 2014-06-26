<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('head_css.php');
	?>

</head>
<body>

	<?php
		$page = "zamowienia";
		include('nav.php');

	if(isset($_COOKIE['logpass'])) {
			include('db_connect.php');
			
			$klient = oci_parse($con,"Select ID,imie, nazwisko from klienci");
			oci_execute($klient);

			if(!isset($_POST['button'])) {
	?>

	<form action='posilek.php' method='post' class='basic-grey'>
		<h1>Wybierz klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="active-step">
					<a><span>1</span> Klient</a>
				</div>
				<div>
					<a><span>2</span> Posiłek</a>
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
			<input type="SUBMIT" name="button" class="button" value="Dalej" />
		</label>
	</form>

	<?php
			}

			if(isset($_POST['button'])) {
				$id_klienta = $_POST['selection'];
				$posilek = oci_parse($con, "Select * from posilki");
				oci_execute($posilek);
	?>

	<form action='posilek2.php' method='post' class='basic-grey'>
		<h1>Wybierz Posilki</h1>

		<h2>
			<div class="wizard-steps">
				<div class="completed-step">
					<a><span>1</span> Klient</a>
				</div>
				<div class="active-step">
					<a><span>2</span> Posiłek</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<label>
			<span>Posilki :</span>
			<select name='posilek'>
				<?php
					while($row = oci_fetch_array($posilek))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
				?>
			</select>
		</label>
		<label>
			<span>Ilość :</span>
			<input type='number' name='posilek_ilosc' value="1" min='1' max='8'>
		</label>
		<label>
			<span>Data :</span>
			<input type='date' name='posilek_data'>
		</label>

		<?php
			echo"<input type='hidden' name='ID' value='$id_klienta' />";
		?>

		<label>
			<span>&nbsp;</span>
			<input type='SUBMIT' class='button' value='Dodaj posiłek' />
		</label>
	</form>

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
