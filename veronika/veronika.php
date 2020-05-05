<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Вероника младшая</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="../css/global.css">
	<script src="main.js"></script>
	<script src="../js/global.js"></script>
</head>
<body onload="global_init(); chat()">
	<div style = "display: none;">
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = 'header'>

	</div>

	<div id="main">
		<form method="get" id="form" action="veronika.php">
			<input type="text" name="name" style='display: none;' value="<?php echo $name; ?>">
			<input type="text" name="text" id="input">
			<div id="answer">Ответ...</div>
			<input type="submit" name="submit" value="Отправить" id="enter">
			<?php
				function write($name, $text){
					$f = fopen("input.txt", "w");
					fwrite($f, "$name@%@$text");
					fclose($f);
				}
				if(isset($_GET['text'])){
					write($_GET['name'], $_GET['text']);
					echo "<script>setTimeout(get_answer, 1500)</script>";
				}
			?>
		</form>
	</div>


	<div id="chat">
			ГЛОБАЛЬНЫЙ ЧАТ:
		<div id="chat_text">
			text
		</div>
	</div>
</body>
</html>