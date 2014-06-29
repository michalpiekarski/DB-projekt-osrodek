<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php
            include('../head_css.php');
        ?>
        <style type="text/css">
            .imagelink {
                border: solid 1px black;
                width: 120px;
                height: 100px;
                text-align: center;
                float: left;
                padding-top: 20px;
                margin-left: 20px;
                margin-bottom: 10px;
            }
            .clear {
                clear: both;
            }
        </style>
    </head>
    <body>

        <?php
            include('nav.php');
            include('../db_connect.php');

            $tabela = $_GET['tabela'];
            if(isset($_GET['id'])){
            $id = $_GET['id'];

            // Uzyskaj nazwy kolumn tabeli
            $col_names = oci_parse($con, "SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '$tabela'");
            oci_execute($col_names);
            $col_count = oci_fetch_all($col_names, $col_names, null, null, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_NUM);

            // Uzyskaj dane rekordu
            $dane = oci_parse($con, "SELECT * FROM $tabela WHERE ".$col_names[0][0]." = '$id'");
            oci_execute($dane);
            $dane = oci_fetch_array($dane);

            $rm_obiekt = oci_parse($con,"DELETE FROM $tabela WHERE ".$col_names[0][0]." = '$id'");
            oci_execute($rm_obiekt);
        ?>

        <div class='basic-grey'>
            <h1>Usunięto</h1>

            <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
                <thead>
                    <tr>

                        <?php
                            for($i=0; $i<$col_count; $i++) {
                                echo"<th style='background-color: lightgrey;'>".$col_names[0][$i]."</th>";
                            }
                        ?>

                    </tr>
                </thead>
                <tbody>
                    <tr id="remove">
                        <td>
                            <?php echo"<div id='".$id."'>".$id."</div>"; ?>
                        </td>

                        <?php
                            for($i=1; $i<$col_count; $i++) {
                                echo "<td><div id='".$col_names[0][$i]."' contenteditable='true'>".$dane[$i]."</div></td>";
                            }
                        ?>

                    </tr>
                </tbody>
            </table>

            <h3>
                 <a href="#" onclick="location.href = document.referrer; return false;">Wróć</a>
            </h3>
        </div>

        <?php
        }
        else {
            $nazwa = $_GET["nazwa"];

            // Uzyskaj nazwy kolumn tabeli
            $col_names = oci_parse($con, "SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '$tabela'");
            oci_execute($col_names);
            $col_count = oci_fetch_all($col_names, $col_names, null, null, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_NUM);

            // Uzyskaj dane rekordu
            $dane = oci_parse($con, "SELECT * FROM $tabela WHERE ".$col_names[0][0]." = '$nazwa'");
            oci_execute($dane);
            $dane = oci_fetch_array($dane);

            $rm_typ_obiektu=oci_parse($con, "DELETE FROM $tabela WHERE ".$col_names[0][0]." = '$nazwa'");
            oci_execute($rm_typ_obiektu);
        ?>

        <div class='basic-grey'>
            <h1>Usunięto</h1>

            <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
                <thead>
                    <tr>

                        <?php
                            for($i=0; $i<$col_count; $i++) {
                                echo"<th style='background-color: lightgrey;'>".$col_names[0][$i]."</th>";
                            }
                        ?>

                    </tr>
                </thead>
                <tbody>
                    <tr id="remove">
                        <td>
                            <?php echo"<div id='".$nazwa."'>".$nazwa."</div>"; ?>
                        </td>

                        <?php
                            for($i=1; $i<$col_count; $i++) {
                                echo "<td><div id='".$col_names[0][$i]."' contenteditable='true'>".$dane[$i]."</div></td>";
                            }
                        ?>

                    </tr>
                </tbody>
            </table>

            <h3>
               <a href="#" onclick="location.href = document.referrer; return false;">Wróć</a>
            </h3>
        </div>

        <?php
            }
        ?>

    </body>
</html>
