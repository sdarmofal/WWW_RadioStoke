<head>
	<meta http-equiv="refresh" content="20">
</head>
<?php
	$pobrane = file_get_contents('http://91.232.4.33:9174/currentsong?sid=1');
	$gramy = explode("-",$pobrane);
	if($gramy[0] != '')
	{
		echo '<p id="autor">'.$gramy[0].'</p>';
		echo '<p id="utwor">'.$gramy[1].'</p>';
	}
	else
	{
		echo '<p id="autor">Data: '.date('d.m.Y').'</p>';
		echo '<p id="utwor">Godzina: '.date('H:i').'</p>';
	}
?>
<script>
			//window.setInterval(location.reload(true), 200000);
</script>
