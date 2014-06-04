<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
    <?php
        include('nav.php');

        $con = oci_connect("tomek", "2", "localhost:1521/XE") or die ("could not connect to oracledb");
        if(!isset($_POST['button'])) {
    ?>

    <form action="domek.php" method="post" class="basic-grey">
        <h1>Dodaj domek</h1>

        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj domek" />
        </label>
    </form>

    <?php
        }
        else {
    ?>

        <div class="basic-grey">
            <h1>Powodzenie</h1>
            <p>Dodano domek</p>
        </div>

    <?php
            $sql = "INSERT INTO DOMKI () VALUES ()";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
        }
        oci_close($con);
    ?>

</body>
</html>
