<!DOCTYPE html>
<html>
<head>
	<title>Регестрация</title>
	<script src="../js/login.js"></script>
	<link rel="stylesheet" href="../css/reg.css">
</head>
<body>
	<?php
	$login = $_GET['user_login'];
	$pass_user = hash("sha256", $_GET['user_pass']);
	if(file_exists("account/$login.id")){
		$f = fopen("account/$login.id", "r");
		$all = fread($f,  filesize("account/$login.id"));
		list($id, $login, $name, $pass) = explode("\n", $all);
		// echo "$id $login $name $pass";
		$ip = $_SERVER['REMOTE_ADDR'];
		$secretkey = hash("sha256", "$login$id$ip");
		if($pass == $pass_user){
			echo "corret";
			echo "<script>correct_login('$secretkey', '$login', '$id')</script>";
		}else{
			echo "error";
			echo "<script>error_pass()</script>";
		}
	}else{
		echo "login";
		echo "<script>login_not_found()</script>";
	}
	
?>
</body>
</html>
