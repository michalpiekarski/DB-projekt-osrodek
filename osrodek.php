<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
<script type="text/javascript">
	function showStuff(id) {
		document.getElementById(id).style.display = 'block';
	}
	function hideStuff(id) {
		document.getElementById(id).style.display = 'none';
	}
</script>
</head>
<body onload="hideStuff('answer1');">

	<?php
		include('nav.php');

		$con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
		$osrodek = oci_parse($con,"Select * from OSRODKI");
		oci_execute($osrodek);
		$osrodek2 = oci_parse($con,"Select * from OSRODKI");
		oci_execute($osrodek2);
		$klient = oci_parse($con, "Select ID, IMIE, NAZWISKO from KLIENCI");
		oci_execute($klient);

	?>

	<form action='add.php' method='post' class='basic-grey'>


		<h1>Wybierz ośrodek lub istniejącego klienta</h1>

		<h2>
			<div class="wizard-steps">
				<div class="active-step">
					<a><span>1</span> Ośrodek</a>
				</div>
				<div>
					<a><span>2</span> Formularz dodania</a>
				</div>
				<div>
					<a><span>3</span> Podsumowanie</a>
				</div>
			</div>
		</h2>
		Czy klient znajduje się w bazie?


		<input type="radio" onclick="showStuff('answer1'); hideStuff('przycisk1'); showStuff('przycisk2'); hideStuff('s1');" name="radio1" value="tak" />Tak
		<input type="radio" onclick="hideStuff('answer1'); showStuff('przycisk1'); hideStuff('przycisk2'); showStuff('s1');" name="radio1" value="nie" checked/>Nie

		<label id="s1">
			<span>Ośrodek :</span>
			<select name='selection' >

				<?php
					while($row = oci_fetch_array($osrodek))
						echo"<option value='".$row['ID']."'>".$row['NAZWA']."</option>";
				?>

			</select>
		</label>




		<label id="przycisk1">
			<span>&nbsp;</span>
			<input type="SUBMIT" class="button" value="Dalej" />
		</label>
	</form>

	<form action="add_exist.php" method="post" class="basic-grey" id="answer1">
	<h1>Wybierz Klienta</h1>


	<label>
			<span>Ośrodek :</span>
			<select name='selection' id="s2">

				<?php
					while($row2 = oci_fetch_array($osrodek2))
						echo"<option value='".$row2['ID']."'>".$row2['NAZWA']."</option>";
				?>

			</select>
		</label>


	<label>
			<span >Klient: </span>
			<select name='klient'>
				<?php
					while($row = oci_fetch_array($klient))
						echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";

				?>
			</select>
		</label>

			<label id="przycisk2">
			<span>&nbsp;</span>
			<input type="SUBMIT" class="button" value="Dalej" />
		</label>
	</form>

	<?php
		oci_close($con);
	?>

</body>
</html>
