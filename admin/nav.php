<?php
	if(!isset($_COOKIE['logpass'])) {
		include('../login.php');
	}
?>
<style type="text/css">
	<?php
		echo "nav #".$page;
	?>

	{
		font-weight: bold;
		background-color: lightgrey;
		color: white;
		border: solid 3px white;
	    line-height: 50px;
	    padding: 0 18px;
	}

	<?php
		echo "nav #".$page.":hover";
	?>

	{
		background-color: grey;
	}

	<?php
		echo "nav #".$page." > .caret";
	?>

	{
		border-top-color: white;
		border-width: 5px;
		margin-top: -2px;
	}
</style>
<nav>
	<ul>
		<li>
			<a id="index" href="index.php">Home</a>
		</li>
		<li>
			<a id="konta" href="konta.php">Konta<span class="caret"></span></a>
			<div>
				<ul>
					<li>
						<a href="konto.php">Dodaj konto</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="klienci" href="klienci.php">Klienci</a>
		</li>
		<li>
			<a id="osrodki" href="osrodki.php">Ośrodki<span class="caret"></span></a>
			<div>
				<ul>
					<li>
						<a href="osrodek.php">Dodaj ośrodek</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="obiekty" href="obiekty.php">Obiekty<span class="caret"></span></a>
			<div>
				<ul>
					<li>
						<a href="typ_obiektu.php">Dodaj typ obiektu</a>
					</li>
					<hr/>
					<li>
						<a href="domek.php">Dodaj domek</a>
					</li>
					<li>
						<a href="pokoj.php">Dodaj pokój</a>
					</li>
					<li>
						<a href="inny_obiekt.php">Dodaj inny</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="pracownicy" href="pracownicy.php">Pracownicy<span class="caret"></span></a>
			<div>
				<ul>
					<li>
						<a href="stanowisko.php">Dodaj stanowisko</a>
					</li>
					<hr />
					<li>
						<a href="pracownik.php">Dodaj pracownika</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="typy_zamowien" href="typy_zamowien.php">Typy zamówień<span class="caret"></span></a>
			<div>
				<ul>
					<li>
						<a href="posilek.php">Dodaj typ posiłku</a>
					</li>
					<li>
						<a href="usluga.php">Dodaj typ usługi</a>
					</li>
					<li>
						<a href="wypozyczenie.php">Dodaj typ wypożyczenia</a>
					</li>
				</ul>
			</div>
		</li>
		<li style="float: right">
			<a href="../index.php">Przejdź do strony głównej</a>
		</li>
		<li style="float: right;">

			<?php
				if(isset($_COOKIE['logpass'])) {
					echo "<a href='../login_verify.php?logout=1&url=".urlencode($_SERVER['PHP_SELF'])."'>Wyloguj</a>";
				}
				else {
					echo "<a href='#' onclick=\"LoginDialog('block', 0);\">Zaloguj</a>";
				}
			?>

		</li>
	</ul>
</nav>
