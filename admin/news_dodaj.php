<!DOCTYPE HTML>
<head>
	<title>Radio Stoke</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/logo.png"/>
	<link rel="stylesheet" href="../style.css" type="text/css"/> 
	<script src="../js/jquery-1.6.3.min.js"></script>
	<script src="http://skrypty.radiohost.pl/script.js" type="text/javascript"></script>
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
				<aside id="odtwarzacz">
					<div id="radio" data-id="138" data-server="160" data-attributes="player=2&showstop=1&showinfo=1&volume=1" class="radiohost-widget-container-radio" style="width:500px;"></div>
				</aside>
			</section>
			<section id="menu">
				<ul>
					<li class="menu"><a href="../index.php">Strona główna</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=pozdrowienia&server=160&id=138&popup=1','1422614595195','width=300,height=250,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Pozdrowienia</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=ramowka&server=160&id=138&popup=1','1422614595195','width=500,height=450,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Ramówka</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=prezenterzy&server=160&id=138&popup=1','1422614595195','width=300,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Prezenterzy</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=playlista&server=160&id=138&popup=1','1422614595195','width=600,height=450,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Playlista</a></li>
					<li class="menu"><a href="#">Chat</a></li>
					<li class="menu"><a href="../forum">Forum</a></li>
					<li class="menu"><a href="http://stoke.radio.pl/" target="_blank">Aplikacja</a></li>
					<li class="menu"><a href="#">Kontakt</a></li>
				</ul>
			</section>
			<section id="pozdrowienia">
				<p>Pozdrowienia: </p>
				<marquee><div id="pozdrowienia-live" data-id="138" data-server="160" class="radiohost-widget-container-pozdrowienia-live"></div></marquee>
			</section>
		</header>
		<section id="middle">
			<?php
			session_start();
			include 'dane.php';
			include 'funkcje.php';
		if(isset($_SESSION['nazwa']))
		{		
		if($_POST['nazwa'] != '' && $_POST['tekst_krotki'] != '' && $_POST['tekst'] != '')
		{
			$nazwa = addslashes($_POST['nazwa']);
			$tekst_krotki = addslashes($_POST['tekst_krotki']);
			$tekst = addslashes($_POST['tekst']);
			$bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
			if(!$bd)
			{
				echo '<p class="blad">Brak połączenia z bazą danych</p>';
				exit;
			}
			$zapytanie = "select * from admin where nazwa='".$_SESSION['nazwa']."'";
			$wynik = $bd->query($zapytanie);
			$autor = mysqli_fetch_array($wynik);
			$autor = $autor['imie'];
			$zapytanie = "insert into news(nazwa,tresc_krotka,tresc,autor) values ('".$nazwa."','".$tekst_krotki."','".$tekst."','".$autor."')";
			$wynik = $bd->query($zapytanie);
			if($wynik)
			{
				echo '<p class="ok">Dodano newsa</p>';
				logadd('0','Dodano newsa o tytule '.$_POST['nazwa'].'');
			}
			else 
			{
				echo '<p class="blad">Wystąpił błąd podczas dodawania newsa</p>';
			}
		}
		else
		{
		?>
			<form action="news_dodaj.php" method="post">
				<table id="news">
					<tr>
						<td>Tytuł</td>
						<td><input type="text" name="nazwa" placeholder="Wpisz tytuł wiadomości."></td>
					</tr>
					<tr>
						<td>Krótki tekst</td>
						<td><textarea name="tekst_krotki" rows="5" placeholder="Wpisz opisowy tekst wyświetlany na stronie głównej. Pamiętaj aby nie był zbyt długi."></textarea></td>
					</tr>
					<tr>
						<td>Tekst</td>
						<td><textarea name="tekst" rows="20" placeholder="Wpisz cały tekst. Może być on dowolnej długości. Wiadomość ta jest wyświetlona po kliknięciu na link Pokaż więcej. Jeżeli chcesz aby tekst wyglądał atrakcyjniej użyj znaczników języka HTML."></textarea></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Zapisz"></td>
					</tr>
				</table>
			</form>
			<?php
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
