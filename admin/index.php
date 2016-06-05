<?php
	
	session_start();
	if(isset($_SESSION['nazwa']))
		header ("Location: admin.php");
	else
	{
?>
<!DOCTYPE HTML>
<head>
	<title>Radio Stoke</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/logo.png"/>
	<link rel="stylesheet" href="../style.css" type="text/css"/> 
	<link rel="stylesheet" href="../slider/anythingslider.css" type="text/css"/> 
	<script src="../js/jquery-1.6.3.min.js"></script>
	<script src="../slider/jquery.anythingslider.min.js"></script>
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
				<a href="#"><img src="../images/winamp.png" alt="Winamp"></a>
				<a href="#"><img src="../images/wmp.png" alt="WMP"></a>
				<a href="#" class="fb"><img src="../images/facebook.png" alt="Facebook"></a>
			</section>
			<section id="logo">
				<a href="#"><img src="../images/logo.png" alt="Logo Radio Stoke"/></a>
			</section>
			<section id="menu">
				<ul>
					<li class="menu"><a href="#">Strona główna</a></li>
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
			<section id="admin">
				<form action="login.php" method="post" name="login">
					<label for="nazwa">Login</label>
					<input id="nazwa" type="text" name="nazwa"><br/>
					<label for="haslo">Hasło</label>
					<input id="haslo" type="password" name="haslo"></br>
					<input type="submit" value="Zaloguj">					
				</form>
			</section>
		</section>
		<footer>
			<p>Copyright © Radio Stoke 2015</p>
		</footer>
	</div>
</body>
<?php
}
?>
