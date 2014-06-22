<style type="text/css">

	<?php
		echo "nav #".$page;
	?>

	{
		font-weight: bold;
		background-color: lightgrey;
		color: white;
		border: solid 3px white;
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
			<a id="rezerwacje">Rezerwacje<span class="caret"></span></a>
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
			<a id="zamowienia">Zamówienia<span class="caret"></span></a>
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
			<a id="rachunki">Rachunki<span class="caret"></span></a>
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
	</ul>
</nav>
<a id="admin_link" href="admin/index.php"></a>
