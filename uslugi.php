<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include('head_css.php');
			include('validation.php');
		?>

		<script type="text/javascript" src="/bazy/js/validation_uslugi.js"></script>
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

		<form id="uslugi_klient_form" action='uslugi.php' method='post' class='basic-grey'>
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
					<option value='' selected></option>

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

		<form id="uslugi_form" action='uslugi2.php' method='post' class='basic-grey'>
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

			<label title="Pole jest wymagane">
				<span>Usługa* :</span>
				<select name='usluga'>
					<option value='' selected></option>

					<?php
						while($row = oci_fetch_array($usluga))
							echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']." - ".$row['CENA']." zł</option>";
					?>

				</select>
			</label>
			<label title="Pole jest wymagane">
				<span>Ilość* :</span>
				<input type='number' name='usluga_ilosc' placeholder="Ilość" min='1' max='5'></label>
			<label title="Pole jest wymagane">
				<span>Data* :</span>
				<input type='date' name='usluga_data' value="<?php echo date('Y-m-d'); ?>">
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
				}
				oci_close($con);
			}
			else {
	            include('login_error.php');
			}
		?>

	</body>
</html>
