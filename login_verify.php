<?php
    if(isset($_GET['logout'])) {
        setcookie("logpass", "", time()-60*60*24, '/');
        header('Location: '.urldecode($_GET['url']), true, 302);
    }
    else {
        if(isset($_POST['login']) and isset($_POST['password']) and isset($_POST['url'])) {
            $value = $_POST['login'].$_POST['password'];
            $expire = 0;
            if(isset($_POST['remember'])) {
                $expire = time()+60*60*24*30;
            }
            setcookie("logpass", $value, $expire, '/');
            header('Location: '.$_POST['url']);
        }
    }
?>
