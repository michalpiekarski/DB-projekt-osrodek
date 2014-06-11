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
        <script type="text/javascript">
        function Table(){
        var Row = document.getElementById("remove");
        var Cells = Row.getElementsByTagName("td");
       
         var id = Cells[0].innerText;
         var osrodek = Cells[1].innerText;
         var typ = Cells[2].innerText;
         var budynek = Cells[3].innerText;
         var numer = Cells[4].innerText;
        
        window.location.href="edit2.php?id="+ id +"&osrodek=" + osrodek + "&typ=" + typ + "&budynek=" + budynek + "&numer=" + numer;


        
        }
    </script>
</head>
<body>

    <?php
        include('nav.php');
        $con = oci_connect("tomek", "2") or die ("could not connect to oracledb");

        $id = $_GET['id'];
        $osrodek = $_GET['osrodek'];
        $typ = $_GET['typ'];
        $budynek = $_GET['budynek'];
        $numer = $_GET['numer'];
       


        

    ?>

    <table class='basic-grey' style='border: none; padding: 0; text-align: center;' cellpadding='5em'>
        <tr>
            <th colspan = '5'style='background-color: lightgrey;'>Edycja</th>
        </tr>
        <tr>
            <th style='background-color: lightgrey;'>ID</th>
            <th style='background-color: lightgrey;'>Ośrodek</th>
            <th style='background-color: lightgrey;'>Typ</th>
            <th style='background-color: lightgrey;'>Budynek</th>
            <th style='background-color: lightgrey;'>Numer</th>
        </tr>
        <tr id="remove">
           
            <td><?php echo $id;?></td>
            <td><div contenteditable="true"><?php echo $osrodek;?></div></td>
            <td><div contenteditable="true"><?php echo $typ;?></div></td>
            <td><div contenteditable="true"><?php echo $budynek;?></div></td>
            <td><div contenteditable="true"><?php echo $numer;?></div></td>
            
        </tr>
        <tr>
            <th style='background-color: lightgrey;'><a href="obiekty.php">Wróć</a></th>
            <th style='background-color: lightgrey;'><input type='submit' name='button' onclick="Table();" value='Zapisz'></th>
        </tr>
    </table>







</body>
</html>
