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
		border-top: solid 3px white;
		border-bottom: solid 3px white;
	    line-height: 50px;
	    padding: 0 18px;
	}

	<?php
		echo "nav #".$page.":hover";
	?>

	{
		background-color: grey;
	}
</style>
<nav>
	<ul>
		<li>
			<a id="index" href="index.php">Home</a>
		</li><li>
			<a id="konta" href="konta.php">Konta<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="konto.php">Dodaj konto<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
				</ul>
			</div>
		</li><li>
			<a id="klienci" href="klienci.php">Klienci</a>
		</li><li>
			<a id="osrodki" href="osrodki.php">Ośrodki<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="osrodek.php">Dodaj ośrodek<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
				</ul>
			</div>
		</li><li>
			<a id="obiekty" href="obiekty.php">Obiekty<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="typ_obiektu.php">Dodaj typ obiektu<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<hr/>
					<li>
						<a href="domek.php">Dodaj domek<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<li>
						<a href="pokoj.php">Dodaj pokój<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<li>
						<a href="inny_obiekt.php">Dodaj inny<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
				</ul>
			</div>
		</li><li>
			<a id="pracownicy" href="pracownicy.php">Pracownicy<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="stanowisko.php">Dodaj stanowisko<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<hr />
					<li>
						<a href="pracownik.php">Dodaj pracownika<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
				</ul>
			</div>
		</li><li>
			<a id="typy_zamowien" href="typy_zamowien.php">Typy zamówień<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="posilek.php">Dodaj typ posiłku<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<li>
						<a href="usluga.php">Dodaj typ usługi<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
					<li>
						<a href="wypozyczenie.php">Dodaj typ wypożyczenia<span class="octicon octicon-plus caret" style="min-width: 16px;"></span></a>
					</li>
				</ul>
			</div>
		</li><li style="float:right;">
			<a href="../index.php" title="Przejdź do strony głównej"><span class="mega-octicon octicon-home" style="min-width: 32px; vertical-align: -15%;"></span></a>
		</li><li style="float:right;">

			<?php
				if(isset($_COOKIE['logpass'])) {
					echo "<a href='../login_verify.php?logout=1&url=".urlencode($_SERVER['PHP_SELF'])."' title='Wyloguj'><span class='mega-octicon octicon-sign-out' style='min-width: 32px; vertical-align: middle;'></span></a>";
				}
				else {
					echo "<a href='#' onclick=\"LoginDialog('block', 0);\" title='Zaloguj'><span class='mega-octicon octicon-sign-in' style='min-width: 32px; vertical-align: middle;'></span></a>";
				}
			?>

		</li>
	</ul>
</nav>
