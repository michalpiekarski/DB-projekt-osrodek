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

		$con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb"); 
		$osrodek = oci_parse($con,"Select * from OSRODKI");
		oci_execute($osrodek);
	?>

	<form action='add.php' method='post' class='basic-grey'>
		<h1>Wybierz ośrodek</h1>

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

		<label>
			<span>Ośrodek :</span>
			<select name='selection'>

				<?php
					while($row = oci_fetch_array($osrodek))
						echo"<option value='".$row['ID']."'>".$row['NAZWA']."</option>";
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