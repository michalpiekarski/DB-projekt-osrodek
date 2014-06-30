<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<?php
			include 'head_css.php';
		?>

	</head>
	<body>
		<div class="basic-grey error">
			<span class="mega-octicon octicon-alert" style="min-width: 32px; color: red; float: left; margin-top: -8px;"></span>
			<span class="mega-octicon octicon-alert" style="min-width: 32px; color: red; float: right; margin-top: -8px;"></span>
			<h1 style="color: red; margin-bottom: 2em;">COŚ POSZŁO NIE TAK</h1>

			<h2>

			<?php
				$error_message = "Wystąpił błąd";
				if(isset($_GET['error_type'])) {
					switch ($_GET['error_type']) {
						case 'connect': {
							echo $error_message." z połączeniem!<br/>Nie można było nawiązać połączenia z bazą danych.";
							break;
						}
						case 'execute': {
							echo $error_message." z zapytaniem do bazy danych<br/>Spróbuj wykonać nieudaną czynność ponownie.";
							break;
						}
					}
				}
				else {
					echo $error_message."!";
				}
			?>

			</h2>
			<p>
				Za chwilę zostaniesz przekirowany na stronę główną.
			</p>
			<input type="button" onclick="window.open('index.php', '_self');" class="button" value="Przejdź teraz..." />
		</div>
	</body>
</html>

<?php
	header("Refresh: 3, url=/bazy/index.php");
?>
