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
        $con = oci_connect("tomek", "2") or die ("could not connect to oracledb");
        $tabela = $_GET['tabela'];
        if(isset($_GET['id'])){
        $id = $_GET['id'];
        $typ = $_GET['typ'];
        $rm_obiekt = oci_parse($con,"DELETE FROM $tabela WHERE ID = $id");
        oci_execute($rm_obiekt);
       

        

    ?>

    <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
        <tr>
            <th colspan = '3'style='background-color: lightgrey;'>Usunięto</th>
        </tr>
        <tr>
            <th style='background-color: lightgrey;'>ID</th>
            <th style='background-color: lightgrey;'>Typ</th>
                    </tr>
        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $typ;?></td>
           
        </tr>
        <tr>
            <th style='background-color: lightgrey;'><a href="obiekty.php">Wróć</a></th>
        </tr>
    </table>
<?php 
}
else
{
    $nazwa = $_GET["nazwa"];
    $rm_typ_obiektu=oci_parse($con, "DELETE FROM $tabela WHERE NAZWA = $nazwa");
    oci_execute($rm_typ_obiektu);
?>
    <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
        <tr>
            <th colspan = '3'style='background-color: lightgrey;'>Usunięto</th>
        </tr>
        <tr>
                <th style='background-color: lightgrey;'>Nazwa</th>
        </tr>
        <tr>
            <td><?php echo $nazwa;?></td>
           
        </tr>
<?php
}
?>
</body>
</html>
