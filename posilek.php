<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		include('head_css.php');
	?>

	<script src="validation/lib/jquery.js"></script>
	<script src="validation/dist/jquery.validate.js"></script>

	<script>
	    $().ready(function () {
	        if($("#posilek_klient_form")) {
	            $("#posilek_klient_form").validate({ // initialize the plugin
	                rules: {
	                    selection: "required"
	                },
	                messages: {
	                    selection: "Popraw"
	                }
	            });
	        }
	        if($("#posilek")) {
	            $("#posilek").validate({ // initialize the plugin
	                rules: {
	                    posilki: "required",
	                    posilek_ilosc: {
	                    	required: true,
	                    	number: true
	                    },
	                    posilek_data: {
	                    	required: true,
	                    	date: true
	                    }
	                },
	                messages: {
	                    posilki: "Popraw",
	                    posilek_ilosc: "Popraw",
	                    posilek_data: "Popraw"
	                }
	            });
	        }
	    });
	</script>
	<style type="text/css">
	    form label.error {
	        margin-left: 8px;
	        width: auto;
	        display: inline;
	        color: red;
	        font-style: italic;
	    }
	</style>
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

	<form id="posilek_klient_form" action='posilek.php' method='post' class='basic-grey'>
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
				<option value='' selected></option>

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

	<form id="posilek" action='posilek2.php' method='post' class='basic-grey'>
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

		<label title="Pole jest wymagane">
			<span>Posilki* :</span>
			<select name='posilek'>
				<option value='' selected></option>

				<?php
					while($row = oci_fetch_array($posilek))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
				?>
			</select>
		</label>
		<label title="Pole jest wymagane">
			<span>Ilość* :</span>
			<input type='number' name='posilek_ilosc' placeholder="Ilość" min='1' max='8'>
		</label>
		<label title="Pole jest wymagane">
			<span>Data* :</span>
			<input type='date' name='posilek_data' value="<?php echo date('Y-m-d'); ?>">
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
