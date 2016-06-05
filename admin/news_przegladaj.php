<!DOCTYPE HTML>
<head>
	<title>Radio Stoke</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="../images/logo.png"/>
	<link rel="stylesheet" href="../style.css" type="text/css"/> 
	<script src="js/jquery-1.6.3.min.js"></script>
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
				
				</aside>
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
			session_start();
			if(isset($_SESSION['nazwa']))
			{	
				include 'dane.php';
				include 'funkcje.php';
				$bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
				if(!$bd)
				{
					echo '<p class="blad">Brak połączenia z bazą danych</p>';
					exit;
				}
				if($_GET['id'] != '')
				{
					switch($_GET['akcja'])
					{
						case 'edytuj':
						{
							$nazwa = addslashes($_POST['nazwa']);
							$krotka = addslashes($_POST['tekst_krotki']);
							$tresc = addslashes($_POST['tekst']);
							$zapytanie = "update news set nazwa='".$nazwa."' where id=".$_GET['id']."";
							$wynik1 = $bd->query($zapytanie);
							$zapytanie = "update news set tresc_krotka='".$krotka."' where id=".$_GET['id']."";
							$wynik2 = $bd->query($zapytanie);
							$zapytanie = "update news set tresc='".$tresc."' where id=".$_GET['id']."";
							$wynik3 = $bd->query($zapytanie);
							if($wynik1 && $wynik2 && $wynik3)
							{
								logadd('1','Edytowano newsa. Nowa nazwa: '.$_POST['nazwa'].'');
								echo '<p class="ok">Edycja newsa przebiegła pomyślnie</p>';
							}
							if(!$wynik1)
							{
								echo '<p class="blad">Nie udało się zmienić tytułu</p>';
							}
							if(!$wynik2)
							{
								echo '<p class="blad">Nie udało się zmienić treści krótkiej</p>';
							}
							if(!$wynik3)
							{
								echo '<p class="blad">Nie udało się zmienić treści</p>';
							}
							break;
						}
						case 'usun':
						{
							$zapytanie = "select * from news where id =".$_GET['id']."";
							$wynik = $bd->query($zapytanie);
							$news = mysqli_fetch_array($wynik);
							$zapytanie = "delete from news where id=".$_GET['id']."";
							$wynik = $bd->query($zapytanie);
							if($wynik)
							{
								logadd('2','Usunięto newsa. Nazwa: '.$news['nazwa'].'');
								echo '<p class="ok">Usunięto newsa</p>';
							}
							else
							{
								echo '<p class="blad">Nie udało się usunąć newsa</p>';
							}
							break;
						}
					}				
				}
				$zapytanie = "select * from news order by id desc";
				$wynik = $bd->query($zapytanie);
				echo '
					<a href="news_dodaj.php">Dodaj newsa</a>
					<table width="99%">
					<tr>
						<td width="19%" class="center">Tytuł</td>
						<td class="center">Treść krótka</td>
						<td class="center">Treść</td>
						<td class="center">Akcja</td>
					</tr>
				';
				while($news = mysqli_fetch_array($wynik))
				{
					$tytul = stripslashes($news['nazwa']);
					$krotka = stripslashes($news['tresc_krotka']);
					$tresc = stripslashes($news['tresc']);
					echo '
						<tr>
							<form action="news_przegladaj.php?akcja=edytuj&id='.$news['id'].'" method="post">
								<td><input type="text" name="nazwa" value="'.$tytul.'"></td>
								<td><textarea name="tekst_krotki" rows="5">'.$krotka.'</textarea></td>
								<td><textarea name="tekst" rows="5">'.$tresc.'</textarea></td>
								<td class="center">
									<input type="submit" value="Edytuj"><br/><br/>
									<a href="news_przegladaj.php?akcja=usun&id='.$news['id'].'">Usuń</a><br/>
								</td>
							</form>
						</tr>
					';
				}
				echo '</table>';
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
