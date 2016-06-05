<?php
	ob_start();
?>
<!DOCTYPE html>
<html>
<?php
	require_once 'head.php';
?>
<body>
<div id="kontener">
<?php
	require_once 'header.php';
?>
	<section class="ukryta"></section>
	<section>
		<?php  
	@	session_start();
		if(isset($_SESSION['nazwa']))
		{
			include 'funkcje.php';
			$bd = baza_lacz('emesel_s1');
			$zapytanie = "select * from teren";
			$wynik = mysqli_query($bd,$zapytanie);
			$i=0;
			while($ter = mysqli_fetch_array($wynik))
			{
				$teren[$ter['id']] = $ter['plik'];
				$i++;
			}
			//$y = 1;
			//$dol = 0;
				echo '
				<table border="0" width="100%">
				<tr>
					<td><a href="mapa.php?x='.($_GET['x']-10).'&y='.($_GET['y']+5).'"><img src="../img/strzalka.png" class="strzalka gora-lewo"/></a></td>
					<td><a href="mapa.php?x='.($_GET['x']).'&y='.($_GET['y']+5).'"><img src="../img/strzalka.png" class="strzalka gora"/></a></td>
					<td><a href="mapa.php?x='.($_GET['x']+10).'&y='.($_GET['y']+5).'"><img src="../img/strzalka.png" class="strzalka gora-prawo"/></a></td>
				</tr>
				<tr>
					<td width="50%"><a href="mapa.php?x='.($_GET['x']-10).'&y='.($_GET['y']).'"><img src="../img/strzalka.png" class="strzalka lewo"/></a></td>
					<td style="margin:auto auto;" id="map">
						<div id="mapa">
				';
				mapa_rysuj($_GET['x'],$_GET['y'],5,4,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,3,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,2,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,1,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,0,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,-1,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,-2,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,-3,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,-4,$teren,'gra 1');
				mapa_rysuj($_GET['x'],$_GET['y'],5,-5,$teren,'gra 1');
			echo '
						</div>
					</td>
					<td width="50%"><a href="mapa.php?x='.($_GET['x']+10).'&y='.($_GET['y']).'"><img src="../img/strzalka.png" class="strzalka prawo"/></a></td>
					<tr>
						<td><a href="mapa.php?x='.($_GET['x']-10).'&y='.($_GET['y']-5).'"><img src="../img/strzalka.png" class="strzalka dol-lewo"/></a></td>
						<td><a href="mapa.php?x='.($_GET['x']).'&y='.($_GET['y']-5).'"><img src="../img/strzalka.png" class="strzalka dol"/></a></td>
						<td><a href="mapa.php?x='.($_GET['x']+10).'&y='.($_GET['y']-5).'"><img src="../img/strzalka.png" class="strzalka dol-prawo"/></a></td>
					</tr>
				</table>
				';

			$bd -> close();
		}
		else
		{
			echo  '<p class="error">Musisz być zalogowany aby zobaczyć tą stronę</p>';
		}
		?>
	</section>
<?php
	require_once '../footer.php';
?>
</div>
</body>
</html>

<?php
	ob_end_flush();
?>