<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include 'head_css.php';
			include 'validation.php';
		?>

		<script type="text/javascript" src="/bazy/js/validation_posilek.js"></script>

	</head>
	<body>

		<?php
			$page = "zamowienia";
			include 'nav.php';

			if(isset($_COOKIE['logpass'])) {
				include 'db_connect.php';

				if(!$con) {
					header('Refresh: 0; url=error.php?error_type=connect');
				}
				$klient = oci_parse($con,"Select ID,imie, nazwisko from klienci");

				if(!oci_execute($klient)) {
					header('Refresh: 0; url=error.php?error_type=execute');
				}
				if(!isset($_POST['button'])) {
					include 'posilek_klient.php';
				}
				else {
					$id_klienta = $_POST['selection'];
					$posilek = oci_parse($con, "Select * from posilki");
					if(!oci_execute($posilek)) {
						header('Refresh: 0; url=error.php?error_type=execute');
					}
					include 'posilek_posilek.php';
				}
				oci_close($con);
			}
			else {
	            include 'login_error.php';
			}
		?>

	</body>
</html>
