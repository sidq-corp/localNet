<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Регестрация</title>
	<script src="../js/reg.js"></script>
	<link rel="stylesheet" href="../css/reg.css">
</head>
<body>
	<?php
	function get_len_dir(){
		$dir = scandir('account');
		return count($dir);
	}

	$login = $_GET['reg_login'];
	$name = $_GET['reg_name'];
	$pass = $_GET['reg_pass'];
	$money = 5;
	if(strlen($login) < 6 or strlen($pass) < 6 or strlen($name) < 2 or file_exists("account/$login.id") or strlen($login) > 30 or strlen($pass) > 30 or strlen($name) > 30){
		echo "<script>error()</script>";
		echo "Ошибка регестраци";
	}else{
		$pass = hash("sha256", $pass);
		$id = get_len_dir() + 1;
		// echo "$login $name $pass $id";
		$f = fopen("account/$login.id", 'w');
		fwrite($f, "$id\n");
		fwrite($f, "$login\n");
		fwrite($f, "$name\n");
		fwrite($f, "$pass\n");
		fwrite($f, "$money\n");

		fclose($f);
		echo "Успешная регестрация";
   	    echo "<script>correct()</script>";


	}
?>
</body>
</html>
