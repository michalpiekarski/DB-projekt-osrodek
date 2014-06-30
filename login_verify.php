<?php
    if(isset($_GET['logout'])) {
        setcookie("logpass", "", time()-60*60*24, '/');
        header("Refresh: 0; url=".urldecode($_GET['url']));
    }
    else {
        if(isset($_POST['login']) and isset($_POST['password']) and isset($_POST['url'])) {
            if(!isset($_POST['register'])) {
                include 'db_connect.php';

                if(!$con) {
                    header('Refresh: 0; url=error.php?error_type=connect');
                }
                $login = $_POST['login'];
                $password = $_POST['password'];
                $typ = oci_parse($con, "SELECT TYP FROM DANE_LOGOWANIA WHERE LOGIN = '$login' AND HASLO = '$password'");
                if(!oci_execute($typ)) {
                    header('Refresh: 0; url=error.php?error_type=execute');
                }
                if($value = oci_fetch_array($typ)) {
                    $expire = 0;
                    if(isset($_POST['remember'])) {
                        $expire = time()+60*60*24*30;
                    }
                    setcookie("logpass", $value['TYP'], $expire, '/');
                }
            }
            else {
                $value = "klient";
                $expire = 0;
                if(isset($_POST['remember'])) {
                    $expire = time()+60*60*24*30;
                }
                setcookie("logpass", $value, $expire, '/');
                header("Refresh: 0; url=".$_POST['url']);
            }
        }
    }
?>
