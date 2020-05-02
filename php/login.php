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
		fclose($f);

	


		if($pass == $pass_user){
			$f = fopen("account/$login.id", "w");
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			fwrite($f, "$id\n");
			fwrite($f, "$login\n");
			fwrite($f, "$name\n");
			fwrite($f, "$pass\n");
			fwrite($f, "$ip\n");
			fwrite($f, $user_agent);
			fclose($f);
			echo "corret";
			echo "<script>correct_login('$login')</script>";
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
