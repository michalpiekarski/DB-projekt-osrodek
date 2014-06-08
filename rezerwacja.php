<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
	<script type="text/javascript">
		function showStuff() {
			document.getElementById('klient').style.display = 'block';
			document.getElementById('form').action = 'add_exist.php';
		}
		function hideStuff() {
			document.getElementById('klient').style.display = 'none';
			document.getElementById('form').action = 'add.php';
		}
	</script>
</head>
<body onload="hideStuff();">

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
		$osrodek = oci_parse($con,"Select * from OSRODKI");
		oci_execute($osrodek);
		$klient = oci_parse($con, "Select ID, IMIE, NAZWISKO from KLIENCI");
		oci_execute($klient);
	?>

	<form id='form' action='add.php' method='post' class='basic-grey'>

		<h1>Wybierz ośrodek lub istniejącego klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="active-step">
					<a><span>1</span> Ośrodek / Klient</a>
				</div>
				<div>
					<a><span>2</span> Formularz dodania</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>

		<h3>Czy klient znajduje się w bazie?
			<span style="float: right; margin-right: 2em;">
				<input type="radio" onclick="showStuff();" name="radio1" value="tak" />Tak
				<input type="radio" onclick="hideStuff();" name="radio1" value="nie" checked/>Nie
			</span>
		</h3>

		<label>
			<span>Ośrodek :</span>
			<select name='osrodek' >

				<?php
					while($row = oci_fetch_array($osrodek))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
				?>

			</select>
		</label>
		<label id='klient'>
			<span >Klient: </span>
			<select name='klient'>

				<?php
					while($row = oci_fetch_array($klient))
						echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";

				?>

			</select>
		</label>
		<label>
			<span>&nbsp;</span>
			<input type="SUBMIT" class="button" value="Dalej" />
		</label>
	</form>

	<?php
		oci_close($con);
	?>

</body>
</html>
