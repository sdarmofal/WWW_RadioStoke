<?php
	
	session_start();
?>
<!DOCTYPE HTML>
<head>
	<title>Radio Stoke</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/logo.png"/>
	<link rel="stylesheet" href="../style.css" type="text/css"/> 
	<script src="../js/jquery-1.6.3.min.js"></script>
</head>
<script>
	$(document).ready(function() {
		$('#slider').anythingSlider(
		{
			autoPlay: true, 
			buildArrows: false
		});
		$('.menu').fadeTo(0, 0.3);
		$('.menu').mouseover(function(){
			$(this).stop().fadeTo(300, 1);
		});
		$('.menu').mouseout(function(){
			$(this).stop().fadeTo(700, 0.3);
		});
		$('#top img').fadeTo(0, 0.3);
		$('#top img').mouseover(function(){
			$(this).stop().fadeTo(300, 1);
		});
		$('#top img').mouseout(function(){
			$(this).stop().fadeTo(700, 0.3);
		});
	});
</script>
<body>
	<script type="text/javascript" charset="UTF-8" src="http://radiostoke.panelradiowy.pl/toolbar.php"></script>
	<div id="kontener">
		<header>
			<section id="top">
				<p>Słuchaj nas w swoim odtwarzaczu: </p>
				<a href="#"><img src="../images/winamp.png" alt="Winamp"></a>
				<a href="#"><img src="../images/wmp.png" alt="WMP"></a>
				<a href="#" class="fb"><img src="../images/facebook.png" alt="Facebook"></a>
			</section>
			<section id="logo">
				<a href="#"><img src="../images/logo.png" alt="Logo Radio Stoke"/></a>
			</section>
			<section id="menu">
				<ul>
					<li class="menu"><a href="index.php">Strona główna</a></li>
					<li class="menu"><a href="#">Ramówka</a></li>
					<li class="menu"><a href="#">Pozdrowienia</a></li>
					<li class="menu"><a href="#">Prezenterzy</a></li>
					<li class="menu"><a href="#">Playlista</a></li>
					<li class="menu"><a href="#">Chat</a></li>
					<li class="menu"><a href="forum">Forum</a></li>
					<li class="menu"><a href="#">Aplikacja</a></li>
					<li class="menu"><a href="#">Kontakt</a></li>
				</ul>
			</section>
			<section id="pozdrowienia">
				<p>Pozdrowienia: </p>
			</section>
		</header>
		<section id="middle">
			<?php
			if(isset($_SESSION['nazwa']))
			{
				include 'dane.php';
				@ $bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
				if(!$bd)
				{
					echo '<p class="blad">Brak połączenia z bazą danych.</p>';
					exit;
				}
				$zapytanie = "select * from kontakt where id=".$_GET['id']."";
				$wynik = mysqli_query($bd,$zapytanie);
				$wiad = mysqli_fetch_array($wynik);
				switch($_GET['akcja'])
				{
					case 'odpowiedz':
					{
						echo '<form action="kontakt_akcja.php?akcja=odpowiedz&id='.$_GET['id'].'" method="post"><textarea name="odp">Wpisz tresc wiadomosci</textarea></br><input type="submit" value="Wyślij"></form>';
						if(isset($_POST['odp']))
						{
						$headers = "MIME-Version: 1.0\r\n".
						"Content-type: text/html; charset=utf8\r\n".
						"From:  Radio Stoke\r\n";
						mail($wiad['mail'],'RE: '.$wiad['tytul'],$_POST['odp'],$headers);
						echo '<p class="ok">Wysłano wiadomość</p>';
						$zapytanie = "update kontakt set odp=1 where id=".$_GET['id']."";
						$wynik = mysqli_query($bd,$zapytanie);
						$zapytanie = "update kontakt set odczyt=1 where id=".$_GET['id']."";
						$wynik = mysqli_query($bd,$zapytanie);
	
						}
						break;						
					}
					case 'usun':
					{
						$zapytanie="delete from kontakt where id=".$_GET['id']."";
						$wynik = mysqli_query($bd,$zapytanie);
						include 'funkcje.php';
						logadd(1,'Usunięto wiadomość od '.$wiad['nick']);
						break;
					}
				}
			}
			else
				echo '<p class="blad">Nie jesteś zalogowany</p>';
			?>
		</section>
	</div>
</body>
<footer>
	<p>Copyright © Radio Stoke 2015</p>
</footer>

