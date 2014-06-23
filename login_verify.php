<?php
    if(isset($_GET['logout'])) {
        setcookie("logpass", "", time()-60*60*24, '/');
        header('Refresh: 0; url='.urldecode($_GET['url']), true);
        exit;
    }
    else {
        if(isset($_POST['login']) and isset($_POST['password']) and isset($_POST['url'])) {
            if(!isset($_POST['register'])) {
                $con = oci_connect("tomek", "2")or die ("could not connect to oracledb");

                $login = $_POST['login'];
                $password = $_POST['password'];
                $typ = oci_parse($con, "SELECT TYP FROM DANE_LOGOWANIA WHERE LOGIN = '$login' AND HASLO = '$password'");
                oci_execute($typ);
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
            }
            header('Refresh: 0; url='.$_POST['url'], true);
            exit;
        }
    }
?>
