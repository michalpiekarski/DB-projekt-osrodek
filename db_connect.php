<?php
	$db_user = 'tomek';
	$db_pass = '2';
	//$db_host = 'localhost';
	$db_host = '192.168.0.105';	// Na potrzeby testowania ze zdalną bazą danych w miarę potrzeb zmienić podany adres IP

	error_reporting(E_ERROR | E_PARSE);
	//error_reporting(-1); // Ustawia wyświetlanie wszystkich informacji o błędach serwera PHP

    $con = oci_connect($db_user, $db_pass, $db_host);
?>
