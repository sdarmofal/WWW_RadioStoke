<?php
			if(($_POST['tytul'] != "") && ($_POST['tresc'] != "") && ($_POST['nick'] != "") && ($_POST['mail'] != ""))
				{
					include 'admin/dane.php';
					@ $bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
					if(!$bd)
					{
						echo '<p class="blad">Brak połączenia z bazą danych.</p>';
						exit;
					}
					$tytul = addslashes($_POST['tytul']);
					$tresc = addslashes($_POST['tresc']);
					$zapytanie = "insert into kontakt(tytul,tresc,nick,mail,ip) values('".$tytul."','".$tresc."','".$_POST['nick']."','".$_POST['mail']."','".$_SERVER['REMOTE_ADDR']."')";
					$wynik = mysqli_query($bd,$zapytanie);
					if($wynik)
						header("Location: kontakt.php?ok=1");
				}
				else
				{
					header("Location: kontakt.php?blad=1");
					exit;
				}
?>
