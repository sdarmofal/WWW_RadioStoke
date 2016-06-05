<?php
	function logadd($zagrozenie,$komunikat) {
		session_start();
		include 'dane.php';
		@ $bd = mysqli_connect($baza['0'],$baza['1'],$baza['2'],$baza['3']);
		if(!$bd)
		{
			echo '<p class="blad">Brak połączenia z bazą danych.</p>';
			exit;
		}
		$zapytanie = "select * from admin where nazwa='".$_SESSION['nazwa']."'";
		$wynik = $bd->query($zapytanie);
		$kto = mysqli_fetch_array($wynik);
		$data = date('Y-m-d H-i-s');
		$zapytanie = "insert into logi(data,zagrozenie,konto,akcja,ip) values ('".$data."','".$zagrozenie."','".$kto['imie']."','".$komunikat."','".$_SERVER['REMOTE_ADDR']."')";
		$wynik = $bd->query($zapytanie);
		$bd->close();
	}
?>
