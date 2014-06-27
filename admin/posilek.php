<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">

	<?php
		include('../head_css.php');
	?>
<script src="../validation/lib/jquery.js"></script>
<script src="../validation/dist/jquery.validate.js"></script>
<script>
$().ready(function () {

    $("#posilek").validate({ // initialize the plugin
        rules: {

            nazwa: "required",
            cena: {
                required: true,
                number: true
            }
        },
        messages: {
            nazwa: "Popraw",
            cena: "Popraw"
        }


});
});
</script>
<style type="text/css">
    #posilek label.error {
    margin-left: 8px;
    width: auto;
    display: inline;
    color: red;
    font-style: italic;
}
</style>
</head>
<body>

    <?php
        $page = "typy_zamowien";
        include('nav.php');

        if(isset($_COOKIE['logpass']) and $_COOKIE['logpass'] == 'admin') {
            include('../db_connect.php');

            if(!isset($_POST['button'])) {
    ?>

    <form action="posilek.php" id="posilek" method="post" class="basic-grey">
        <h1>Dodaj typ posiłku</h1>

        <h2>
            <div class="wizard-steps">
                <div class="active-step">
                    <a><span>1</span> Posiłek</a>
                </div>
                <div>
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <label>
            <span>Nazwa :</span>
            <input type="text" name="nazwa" placeholder="Nazwa" />
        </label>
        <label>
            <span>Cena :</span>
            <input type="number" name="cena" placeholder="Cena" step="0.01" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" name="button" value="Dodaj typ posiłku" />
        </label>
    </form>

    <?php
        }
        else {
            $nazwa = $_POST['nazwa'];
            $cena = $_POST['cena'];

            $sql = "INSERT INTO POSILKI (NAZWA, CENA) VALUES ('$nazwa', $cena)";
            $sql_parsed = oci_parse($con, $sql);
            oci_execute($sql_parsed);
    ?>

    <div class="basic-grey">
        <h1>Podsumowanie</h1>

        <h2>
            <div class="wizard-steps">
                <div class="completed-step hoverable">
                    <a href="posilek.php"><span>1</span> Posiłek</a>
                </div>
                <div class="active-step">
                    <a><span>2</span> Podsumowanie</a>
                </div>
            </div>
        </h2>

        <h3>Dodano typ posiłku</h3>
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
