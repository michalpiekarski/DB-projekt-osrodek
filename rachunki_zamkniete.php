<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include 'head_css.php';
			include 'validation.php';
		?>

		<script type="text/javascript" src="/bazy/js/validation_rachunki_zamkniete.js"></script>
	</head>
	<body>

		<?php
			$page = "rachunki";
			include 'nav.php';

			if(isset($_COOKIE['logpass'])) {
				include 'db_connect.php';

				if(!$con) {
					header('Refresh: 0; url=error.php?error_type=connect');
				}
				$klient = oci_parse($con,"SELECT ID, IMIE, NAZWISKO FROM KLIENCI");
				if(!oci_execute($klient)) {
					header('Refresh: 0; url=error.php?error_type=execute');
				}
				if(!isset($_POST['button'])) {
					include 'rachunki_zamkniete_klient.php';
				}
				else {
					$id_klienta = $_POST['klient'];
					$rachunki = oci_parse($con,"SELECT * FROM RACHUNKI WHERE KLIENT = $id_klienta AND ZAPLACONY != 0");
					if(!oci_execute($rachunki)) {
						header('Refresh: 0; url=error.php?error_type=execute');
					}
					include 'rachunki_zamkniete_rachunki.php';
				}
				oci_close($con);
			}
			else {
	            include 'login_error.php';
			}
		?>

	</body>
</html>
