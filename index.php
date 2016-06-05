<!DOCTYPE HTML>
<head>
	<title>Radio Stoke</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="images/logo.png"/>
	<link rel="stylesheet" href="style.css" type="text/css"/> 
	<link rel="stylesheet" href="slider/anythingslider.css" type="text/css"/> 
	<script src="js/jquery-1.6.3.min.js"></script>
	<script src="slider/jquery.anythingslider.min.js"></script>
	<script src="http://skrypty.radiohost.pl/script.js" type="text/javascript"></script>
</head>
<script>
	$(document).ready(function() {
		$('#slider').anythingSlider(
		{
			autoPlay: true, 
			buildArrows: false,
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
		function Gramy() {
			setInterval(function() {
				var ramka = document.getElementById("gramy");
				var rdocument = ramka.document || ramka.contentDocument;
				var autor = rdocument.getElementById("autor").innerHTML;
				var utwor = rdocument.getElementById("utwor").innerHTML;
				setTimeout(function() {
					document.title = 'Radio Stoke';
				}, 0);
				setTimeout(function() {
					document.title = autor;
				}, 5000);
				setTimeout(function() {
					document.title = utwor;
				}, 10000);
			}, 10000);
		}
		Gramy();
	});
</script>
<body>
	<iframe src="gramy.php" id="gramy" style="display: none;"></iframe>
	<div id="kontener">
		<header>
			<section id="top">
				<p>Słuchaj nas w swoim odtwarzaczu: </p>
				<a href="http://s0.radiohost.pl:2199/tunein/radiostoke.pls"><img src="images/winamp.png" alt="Winamp"></a>
				<a href="http://s0.radiohost.pl:2199/tunein/radiostoke.asx"><img src="images/wmp.png" alt="WMP"></a>
				<a href="https://www.facebook.com/radiostokeontrent" target="_blank" class="fb"><img src="images/facebook.png" alt="Facebook"></a>
			</section>
			<section id="logo">
				<a href="#"><img src="images/logo.png" alt="Logo Radio Stoke"/></a>
				<aside id="odtwarzacz">
					<script>
						// MixStream Flash Player, http://mixstreamflashplayer.net/ 
						var flashvars = {};flashvars.serverHost = "91.232.4.33:9174/stream/1/";flashvars.getStats = "1";flashvars.autoStart = "1";flashvars.textColour = "FFFFFF";flashvars.buttonColour = "#ffffff";var params = {};params.bgcolor= "";params.wmode="transparent";
					</script>
					<script type="text/javascript" src="http://mixstreamflashplayer.net/v1.3.js"></script>
				</aside>
			</section>
			<section id="menu">
				<ul>
					<li class="menu"><a href="index.php">Strona główna</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=pozdrowienia&server=160&id=138&popup=1','1422614595195','width=300,height=250,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Pozdrowienia</a></li>
					<li class="menu"><a onclick="window.open('http://radiostoke.panelradiowy.pl/embed.php?script=ramowka','','scrollbars=yes, toolbar=no, menubar=no, location=no, personalbar=no, resizable=no, directories=no, status=no, width=590, height=600')">Ramówka</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=prezenterzy&server=160&id=138&popup=1','1422614595195','width=300,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Prezenterzy</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=playlista&server=160&id=138&popup=1','1422614595195','width=600,height=450,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Playlista</a></li>
					<li class="menu"><a href="czat" target="_blank">Chat</a></li>
					<li class="menu"><a href="forum">Forum</a></li>
					<li class="menu"><a href="http://stoke.radio.pl/" target="_blank">Aplikacja</a></li>
					<li class="menu"><a href="kontakt.php">Kontakt</a></li>
				</ul>
			</section>
			<section id="pozdrowienia">
				<p>Pozdrowienia: </p>
				<marquee><div id="pozdrowienia-live" data-id="138" data-server="160" class="radiohost-widget-container-pozdrowienia-live" style="width: 1000px;"></div></marquee>
			</section>
		</header>
		<section id="middle">
			<?php
				require_once 'slider.htm';
			?>
			<div id="news">
				<div id="news_wstep">
					<p><center>NEWS</center></p>
				</div>
				<?php
					include 'admin/dane.php';
					$bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
					if(!$bd)
					{
						echo '<p class="blad">Brak połączenia z bazą danych</p>';
						exit;
					}
					$zapytanie = "select * from news order by id desc";
					$wynik = mysqli_query($bd,$zapytanie);
					while(($wiersz = mysqli_fetch_array($wynik)))
					{
							echo '
								<table class="news news1">
									<tr>
										<td width="70%"><p class="nazwa">'.$wiersz['nazwa'].'</p></td>
										<td></td>
										<td width="30%"><p class="autor">Autor: '.$wiersz['autor'].'</p></td>
									</tr>
									<tr>
										<td colspan="3"><p class="tresc">'.$wiersz['tresc_krotka'].'</p></td>
										
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><a href="news_czytaj.php?id='.$wiersz['id'].'" class="dalej">Czytaj dalej</a></td>
									</tr>
								</table>
							';
					}
				?>
			</div>
		</section>
	</div>
</body>
<footer>
			<p class="stopka_l">Copyright © Radio Stoke 2015</p>
			<p class="stopka_r">Design and code by <a href="mailto:darmofal.szymon@gmail.com">Szymon Darmofał</a></p>
</footer>

