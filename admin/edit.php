<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/menu.css" />
    <link rel="stylesheet" type="text/css" href="../css/form.css" />

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

        if(!isset($_GET['zapis'])) {
            $tabela = $_GET['tabela'];
            $id = $_GET['id'];

            // Uzyskaj nazwy kolumn tabeli
            $col_names = oci_parse($con, "SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '$tabela'");
            oci_execute($col_names);
            $col_count = oci_fetch_all($col_names, $col_names, null, null, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_NUM);

            // Uzyskaj dane rekordu
            $dane = oci_parse($con, "SELECT * FROM $tabela WHERE ".$col_names[0][0]." = '$id'");
            oci_execute($dane);
            $dane = oci_fetch_array($dane);
    ?>

    <div class='basic-grey'>
        <h1>Edycja</h1>

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
            <input type='submit' name='button' onclick="ZapiszZmiany();" value='Zapisz'>
        </h3>
    </div>

    <script type="text/javascript">
        function ZapiszZmiany() {
            if(confirm("Czy na pewno chcesz zapisać wprowadzone zmiany?\nUWAGA: Tej operacji nie będzie można cofcać!")) {
                var Row = document.getElementById("remove");
                var Cells = Row.getElementsByTagName("td");
                var CellValues = {};
                for (var i = 0; i < Cells.length; i++) {
                    CellValues[Cells[i].firstChild.id] = Cells[i].innerText.trim();
                }

                window.location.href="edit.php?zapis=1&tabela=<?php echo $tabela; ?>&id=<?php echo $id; ?>&json="+JSON.stringify(CellValues);
            }
        }
    </script>

    <?php
       
        } else {
            $tabela = $_GET['tabela'];
            $id = $_GET['id'];

            // Uzyskaj nazwy kolumn tabeli
            $col_names = oci_parse($con, "SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '$tabela'");
            oci_execute($col_names);
            $col_count = oci_fetch_all($col_names, $col_names, null, null, OCI_FETCHSTATEMENT_BY_COLUMN + OCI_NUM);

            $json = json_decode($_GET['json'], true);

            $sql = "UPDATE ".$tabela." SET ";
            for ($i=1; $i < $col_count; $i++) {
                $sql .= $col_names[0][$i]." = '".$json[$col_names[0][$i]]."'";
                if($i < $col_count-1) {
                    $sql .= ", ";
                }
            }
            $sql .= "WHERE ".$col_names[0][0]." = '".$id."'";
            $sql = oci_parse($con, $sql);
            oci_execute($sql);
        }
    ?>

</body>
</html>
