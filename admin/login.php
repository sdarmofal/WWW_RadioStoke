<?php
	session_start();
	include 'dane.php';
			$nazwa = $_POST['nazwa'];
			$haslo = $_POST['haslo'];
			if(!isset($_POST['nazwa'])&&!isset($_POST['haslo']))
			{
			}
			else
			{
				@ $bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
				if(!$bd)
				{
					echo '<p class="blad">Brak połączenia z bazą danych.</p>';
					exit;
				}
				$zapytanie = "select count(*) from admin where nazwa = '".$nazwa."' and haslo = sha1('".$haslo."')";
				$wynik = $bd->query($zapytanie);
				if(!$wynik)
				{
					echo '<p class="blad">Nie można wykonać zapytania</p>';
					echo mysqli_error($bd);
					exit;
				}
				$wiersz = mysqli_fetch_row($wynik);
				$ile = $wiersz[0];
				if ($ile > 0)
				{
					session_start();
					$nazwa = $_POST['nazwa'];
					$_SESSION['nazwa'] = $nazwa;
					include 'funkcje.php';
					logadd('0','Zalogowano');
					header ("Location: admin.php");
				}
				else
				{
					$data = date('Y-m-d H-i-s');
					$zapytanie = "insert into logi(data,zagrozenie,konto,akcja,ip) values ('".$data."','2','Podana nazwa: ".$nazwa."','Nieudane logowanie','".$_SERVER['REMOTE_ADDR']."')";
					$wynik = $bd->query($zapytanie);
					echo '<p class="blad">Podałeś nieprawidłowe dane</p>';	
				}
			}
			$bd->close();
?>
