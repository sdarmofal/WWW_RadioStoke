<?php
	session_start();
?>
<!DOCTYPE html>
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
		?>
		<table width="100%">
		<tr>
			<td width="2%" class="center">ID</td>
			<td width="7%" class="center">DATA</td>
			<td width="10%" class="center">KONTO</td>
			<td width="61%" class="center">AKCJA</td>
			<td width="10%" class="center">IP</td>
		</tr>
		<?php
			include 'dane.php';
			@ $bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
			if(!$bd)
			{
				echo '<p class="blad">Brak połączenia z bazą danych.</p>';
				exit;
			}
			$zapytanie = "select * from logi order by id desc";
			$wynik = $bd->query($zapytanie);
			while($log = mysqli_fetch_array($wynik))
			{
				if($log['zagrozenie'] == 0)
				{
					echo '<tr bgcolor="green">';
					echo '<td>'.$log['id'].'</td>';
					echo '<td>'.$log['data'].'</td>';
					echo '<td>'.$log['konto'].'</td>';
					echo '<td>'.$log['akcja'].'</td>';
					echo '<td>'.$log['ip'].'</td>';
					echo '</tr>';
				}
				if($log['zagrozenie'] == 1)
				{
					echo '<tr bgcolor="yellow">';
					echo '<td>'.$log['id'].'</td>';
					echo '<td>'.$log['data'].'</td>';
					echo '<td>'.$log['konto'].'</td>';
					echo '<td>'.$log['akcja'].'</td>';
					echo '<td>'.$log['ip'].'</td>';
					echo '</tr>';
				}
				if($log['zagrozenie'] == 2)
				{
					echo '<tr bgcolor="red">';
					echo '<td>'.$log['id'].'</td>';
					echo '<td>'.$log['data'].'</td>';
					echo '<td>'.$log['konto'].'</td>';
					echo '<td>'.$log['akcja'].'</td>';
					echo '<td>'.$log['ip'].'</td>';
					echo '</tr>';
				}
			}
		?>
		</table>
		<?php
			}
			else
				echo '<p class="blad">Nie jesteś zalogowany</p>';
		?>
	</section>
	<footer>
			<p>Copyright © Radio Stoke 2015</p>
	</footer>
	</div>
</body>
</html>
