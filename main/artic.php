<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$f = fopen("cont/$id.txt", 'r');
		$all = fread($f, filesize("cont/$id.txt"));
		fclose($f);
		list($title, $subtitle, $imgs, $text) = explode("\n", $all);
		$imgs = explode(" ", $imgs);
		echo "$title<br>$subtitle<br>$text<br>";
		print_r($imgs);
	} 
?>