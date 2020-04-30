<!DOCTYPE html>
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
	$pass = hash("sha256", $_GET['user_pass']);
	if($file_exists("account/$login.id")){
		$f = fopen("account/$login.id", "r");
		$all = fread($f,  filesize("account/$login.id"));
		list($id, $login, $name, $pass) = explode("\n", $all);
		echo "$id $login $name $pass";
	}else{
		echo "<script>login_not_found()</script>";
	}
	
?>
</body>
</html>
