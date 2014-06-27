<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    	<?php
    		include('head_css.php');
            include('validation.php');
    	?>

        <script type="text/javascript" src="/bazy/js/validation_rezerwacja.js"></script>
    </head>
    <body>

    	<?php
            $page = "rezerwacje";
    		include('nav.php');

    		if(isset($_COOKIE['logpass'])) {
    			include('db_connect.php');

    			$osrodek = oci_parse($con,"Select * from OSRODKI");
    			oci_execute($osrodek);
    			$klient = oci_parse($con, "Select ID, IMIE, NAZWISKO from KLIENCI");
    			oci_execute($klient);
    	?>

    	<form id='form' action='rezerwacja_nowa.php' method='post' class='basic-grey'>
    		<h1>Wybierz ośrodek i istniejącego klienta</h1>

    		<h2>
    			<div class="wizard-steps">
    				<div class="active-step">
    					<a><span>1</span> Ośrodek / Klient</a>
    				</div>
    				<div>
    					<a><span>2</span> Formularz dodania</a>
    				</div>
    				<div>
    					<a><span>3</span> Podsumowanie</a>
    				</div>
    			</div>
    		</h2>

    		<label title="Pole jest wymagane">
    			<span>Ośrodek* :</span>
    			<select name='osrodek' >
    				<option value='' selected></option>

    				<?php
    					while($row = oci_fetch_array($osrodek))
    						echo"<option value='".$row['NAZWA']."'>".$row['NAZWA']."</option>";
    				?>

    			</select>
    		</label>
    		<label title="Pole jest wymagane">
    			<span>Klient* :</span>
    			<select name='klient'>
    				<option value='' selected></option>

    				<?php
    					while($row = oci_fetch_array($klient))
    						echo"<option value='".$row['ID']."'>".$row['IMIE']." ".$row['NAZWISKO']."</option>";

    				?>

    			</select>
    		</label>
    		<label>
    			<span>&nbsp;</span>
    			<input type="SUBMIT" class="button" value="Dalej" />
    		</label>
    	</form>

    	<?php
    			oci_close($con);
    		}
    		else {
                include('login_error.php');
    		}
    	?>

    </body>
</html>
