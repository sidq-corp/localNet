<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Регестрация</title>
	<script src="../js/reg.js"></script>

</head>
<body>

</body>
</html>
<?php
	function get_len_dir(){
		$dir = opendir('account');
		$count = 0;
		while($file = readdir($dir)){
    		if($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)){
       			 continue;
	    }
	    $count++;
	    return $count;
	}

	}
	$login = $_GET['reg_login'];
	$name = $_GET['reg_name'];
	$pass = $_GET['reg_pass'];
	if(strlen($login) < 6 or strlen($pass) < 6 or strlen($name) < 2 or file_exists("account/$login.id")){
		echo "Ошибка регестраци";
	}else{
		$id = get_len_dir() + 1;
		// echo "$login $name $pass $id";
		$f = fopen("account/$login.id", 'w');
		fwrite($f, "$id\n");
		fwrite($f, "$login\n");
		fwrite($f, "$name\n");
		fwrite($f, "$pass\n");
		fclose($f);
		echo "Успешная регестрация";
   	    echo "<script>document.location.href='../index.php'</script>";


	}
?>