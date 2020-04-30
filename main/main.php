<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
	<script src="../js/main_login.js"></script>
	<link rel="stylesheet" href="../css/main_login.css">
</head>
<body>
	<?php
		$secret = $_GET['secret'];
		$login = $_GET['login'];
		$id = $_GET['id'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$secretkey = hash("sha256", "$login$id$ip");
		if($secretkey == $secret){
			echo"correct";
		}else{
			echo"error";
			echo"<script>error()</script>";
		}

	?>
	
</body>
</html>