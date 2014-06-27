<?php
	$db_user = 'tomek';
	$db_pass = '2';
	$db_host = 'localhost';
	//$db_host = '192.168.0.108';	// Na potrzeby testowania ze zdalną bazą danych w miarę potrzeb zmienić podany adres IP

    $con = oci_connect($db_user, $db_pass, $db_host) or die ("could not connect to oracledb");
?>
