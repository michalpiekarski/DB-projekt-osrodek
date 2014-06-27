<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include('head_css.php')
			include('validation.php');
		?>

		<script>
		    $().ready(function () {
		        if($("#wypozyczenie_klient_form")) {
		            $("#wypozyczenie_klient_form").validate({ // initialize the plugin
		                rules: {
		                    selection: "required"
		                },
		                messages: {
		                    selection: "Popraw"
		                }
		            });
		        }
		        if($("#wypozyczenie_form")) {
		            $("#wypozyczenie_form").validate({ // initialize the plugin
		                rules: {
		                    wypozyczenia: "required",
		                    wypozyczenia_ilosc: {
		                    	required: true,
		                    	number: true
		                    },
		                    wypozyczenia_data_od: {
		                    	required: true,
		                    	date: true
		                    },
		                    wypozyczenia_data_do: {
		                    	required: true,
		                    	date: true
		                    }
		                },
		                messages: {
		                    wypozyczenia: "Popraw",
		                    wypozyczenia_ilosc: "Popraw",
		                    wypozyczenia_data_od: "Popraw",
		                    wypozyczenia_data_do: "Popraw"
		                }
		            });
		        }
		    });
		</script>
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

		<form id="wypozyczenie_klient_form" action='wypozyczenie.php' method='post' class='basic-grey'>
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
				$wypozyczenia = oci_parse($con, "Select * from wypozyczenia");
				oci_execute($wypozyczenia);
		?>

		<form id="wypozyczenie_form" action='wypozyczenia2.php' method='post' class='basic-grey'>
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

			<label title="Pole jest wymagane">
				<span>Wypożyczenie* :</span>
				<select name='wypozyczenia'>
					<option value='' selected></option>

					<?php
						while($row = oci_fetch_array($wypozyczenia))
							echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
					?>

				</select>
			</label>
			<label title="Pole jest wymagane">
				<span>Ilość* :</span>
				<input type='number' name='wypozyczenia_ilosc' placeholder="Ilość" min='1' max='8'>
			</label>
			<label title="Pole jest wymagane">
				<span>Data od* :</span>
				<input type='date' name='wypozyczenia_data_od' value="<?php echo date('Y-m-d'); ?>">
			</label>
			<label title="Pole jest wymagane">
				<span>Data do* :</span>
				<input type='date' name='wypozyczenia_data_do' value="<?php echo date('Y-m-d'); ?>">
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
	            include('login_error.php');
			}
		?>

	</body>
</html>
