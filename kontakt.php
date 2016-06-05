
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
	<div id="kontener">
		<header>
			<section id="top">
				<p>Słuchaj nas w swoim odtwarzaczu: </p>
				<a href="http://s0.radiohost.pl:2199/tunein/radiostoke.pls"><img src="images/winamp.png" alt="Winamp"></a>
				<a href="http://s0.radiohost.pl:2199/tunein/radiostoke.asx"><img src="images/wmp.png" alt="WMP"></a>
				<a href="#" class="fb"><img src="images/facebook.png" alt="Facebook"></a>
			</section>
			<section id="logo">
				<a href="#"><img src="images/logo.png" alt="Logo Radio Stoke"/></a>
				<aside id="odtwarzacz">
					<script>
						// MixStream Flash Player, http://mixstreamflashplayer.net/ 
						var flashvars = {};flashvars.serverHost = "91.232.4.33:9174/stream/1/";flashvars.getStats = "1";flashvars.autoStart = "1";flashvars.textColour = "FFFFFF";flashvars.buttonColour = "#FF0000";var params = {};params.bgcolor= "";params.wmode="transparent";
					</script>
				</aside>
			</section>
			<section id="menu">
				<ul>
					<li class="menu"><a href="index.php">Strona główna</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=pozdrowienia&server=160&id=138&popup=1','1422614595195','width=300,height=250,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Pozdrowienia</a></li>
					<li class="menu"><a onclick="javascript:void window.open('http://skrypty.radiohost.pl/widget.php?type=ramowka&server=160&id=138&popup=1','1422614595195','width=500,height=450,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="#" class="small-box-footer">Ramówka</a></li>
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
				<marquee><div id="pozdrowienia-live" data-id="138" data-server="160" class="radiohost-widget-container-pozdrowienia-live"></div></marquee>
			</section>
		</header>
		<section id="middle">
			<?php
				if(isset($_GET['ok']))
					echo '<p class="ok">Wiadomość została wysłana. Administracja prześle odpowiedź wkrótce na twój adres mailowy</p>';
				if(isset($_GET['blad']))
					echo '<p class="blad">Proszę wypełnić wszystkie pola</p>';
				
			?>
			<form action="kontakt_wyslij.php" method="post">
				<table width="80%" id="kontakt" >
					<tr>
						<td width="30%">Tytuł</td>
						<td width="70%"><input type="text" name="tytul" maxlength="50"/></td>
					</tr>
					<tr>
						<td width="30%">Treść wiadomości</td>
						<td width="70%"><textarea name="tresc" cols="30" rows="5"></textarea></td>
					</tr>
					<tr>
						<td width="30%">Nick</td>
						<td width="70%"><input type="text" name="nick" maxlength="80"/></td>
					</tr>
					<tr>
						<td width="30%">E-mail</td>
						<td width="70%"><input type="text" name="mail" maxlength="30"/></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Wyślij wiadomość" width="100%"></td>
					</tr>
				</table>
			</form>
			
							
		</section>
	</div>
</body>
<footer>
			<p class="stopka_l">Copyright © Radio Stoke 2015</p>
			<p class="stopka_r">Design and code by <a href="mailto:darmofal.szymon@gmail.com">Szymon Darmofał</a></p>
</footer>
