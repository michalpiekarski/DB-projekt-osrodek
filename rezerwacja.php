<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    	<?php
    		include 'head_css.php';
            include 'validation.php';
    	?>

        <script type="text/javascript" src="/bazy/js/validation_rezerwacja.js"></script>
    </head>
    <body>

    	<?php
            $page = "rezerwacje";
    		include 'nav.php';

    		if(isset($_COOKIE['logpass'])) {
    			include 'db_connect.php';

                if(!$con) {
                    header('Refresh: 0; url=error?error_type=connect');
                }
    			$osrodek = oci_parse($con,"Select * from OSRODKI");
    			if(!oci_execute($osrodek)) {
                    header('Refresh: 0; url=error.php?error_type=execute');
                }
    			$klient = oci_parse($con, "Select ID, IMIE, NAZWISKO from KLIENCI");
    			if(!oci_execute($klient)) {
                    header('Refresh: 0; url=error.php?error_type=execute');
                }
                include 'rezerwacja_klient_osrodek.php';
    			oci_close($con);
    		}
    		else {
                include 'login_error.php';
    		}
    	?>

    </body>
</html>
