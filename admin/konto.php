<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">

    <?php
        include('../head_css.php');
    ?>
    
    <style type="text/css">
        .basic-grey #pass {
            border: 1px solid #DADADA;
            color: #888;
            height: 24px;
            margin-bottom: 16px;
            margin-right: 6px;
            margin-top: 2px;
            outline: 0 none;
            padding: 3px 3px 3px 5px;
            width: 70%;
            font: normal 12px/12px Georgia, "Times New Roman", Times, serif;
        }
    </style>
</head>
<body>
    <?php
        $page = "konta";
        include('nav.php');

        if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
            include('../db_connect.php');
            
            if(!isset($_POST['button'])) {
    ?>

    <form action="konto.php" method="post" class="basic-grey">
        <h1>Zarejestruj</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Konto</a>
                </div>
                <div>
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Login: </span>
            <input type="text" name="login" placeholder="Login" />
        </label>
        <label>
            <span>Hasło: </span>
            <input id="pass" type="password" name="password" placeholder="Hasło" />
        </label>
        <label>
            <span>Typ: </span>
            <select name="typ">
                <option value="pracownik">Pracownik</option>
                <option value="admin">Admin</option>
            </select>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj konto" />
        </label>
    </form>

    <?php
        }
        else {
            $login = $_POST['login'];
            $haslo = $_POST['password'];
            $typ = $_POST['typ'];

            $sql = "INSERT INTO DANE_LOGOWANIA (LOGIN, HASLO, TYP) VALUES ('$login', '$haslo', '$typ')";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="konto.php"><span>1</span> Konto</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano konto</h3>
    </div>

    <?php
            }
            oci_close($con);
        }
        else {
            include('../login_error.php');
        }
    ?>

</body>
</html>
