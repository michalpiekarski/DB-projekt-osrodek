<?php
	if(!isset($_COOKIE['logpass'])) {
		include('login.php');
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
</style>
<nav>
	<ul>
		<li>
			<a id="index" href="index.php">Home</a>
		</li>
		<li>
			<a id="rezerwacje">Rezerwacje<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="rezerwacja.php">Dodaj rezerwację</a>
					</li>
					<hr/>
					<li>
						<a href="rezerwacje_aktualne.php">Aktualne</a>
					</li>
					<li>
						<a href="rezerwacje_zakonczone.php">Zakończone</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="zamowienia">Zamówienia<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="posilek.php">Zamów posiłek</a>
					</li>
					<li>
						<a href="uslugi.php">Zamów usługę</a>
					</li>
					<li>
						<a href="wypozyczenie.php">Wypożycz</a>
					</li>
					<hr/>
					<li>
						<a href="zamowienia_aktualne.php">Aktualne</a>
					</li>
					<li>
						<a href="zamowienia_zakonczone.php">Zakończone</a>
					</li>
				</ul>
			</div>
		</li>
		<li>
			<a id="rachunki">Rachunki<span class="octicon octicon-chevron-down caret" style="min-width: 16px;"></span></a>
			<div>
				<ul>
					<li>
						<a href="rachunki_otwarte.php">Otwarte</a>
					</li>
					<li>
						<a href="rachunki_zamkniete.php">Zamknięte</a>
					</li>
				</ul>
			</div>
		</li>
		<li style="float: right;">

			<?php
				if(isset($_COOKIE['logpass'])) {
					echo "<a href='login_verify.php?logout=1&url=".urlencode($_SERVER['PHP_SELF'])."'>Wyloguj <span class='mega-octicon octicon-sign-out' style='min-width: 28px; font-size: 28px; vertical-align: middle; margin: 0 -0.3em 0 0.3em;'></span></a>";
				}
				else {
					echo "<a id='register' href='#' onclick=\"LoginDialog('block', 0);\">Zaloguj <span class='mega-octicon octicon-sign-in' style='min-width: 28px; font-size: 28px; vertical-align: middle; margin: 0 -0.3em 0 0.3em;'></span></a>";
				}
			?>

		</li>
	</ul>
</nav>
<a id="admin_link" href="admin/index.php"><span class="mega-octicon octicon-gear" style="min-width: 32px;"></span></a>
