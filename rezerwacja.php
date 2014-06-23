<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/progres.css" />
	
<body>

	<?php
        $page = "rezerwacje";
		include('nav.php');

		if(isset($_COOKIE['logpass'])) {

			$con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
			$osrodek = oci_parse($con,"Select * from OSRODKI");
			oci_execute($osrodek);
			$klient = oci_parse($con, "Select ID, IMIE, NAZWISKO from KLIENCI");
			oci_execute($klient);
	?>

	<form id='form' action='rezerwacja_nowa.php' method='post' class='basic-grey'>

		<h1>Wybierz ośrodek i istniejącego klienta</h1>

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

		<label>
			<span>Ośrodek :</span>
			<select name='osrodek' >

				<?php
					while($row = oci_fetch_array($osrodek))
						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
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
		<label>
			<span>&nbsp;</span>
			<input type="SUBMIT" class="button" value="Dalej" />
		</label>
	</form>

	<?php
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
