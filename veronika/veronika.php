<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Вероника младшая</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="../css/global.css">
	<script src="main.js"></script>
	<script src="../js/global.js"></script>
	<script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body onload="global_init(); chat()">
	<div style = "display: none;">
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = 'loading-wrapper'>
		<div id = 'loading-wrapper-gradient'>

		</div>
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

	<div id = 'gui-container' class = 'hidden-on-start'>
		<b>Ваш никнейм: <i><?php echo $name; ?></i></b><br>
		<b>Ваш логин: <i><?php echo $login; ?></i></b><br>
		<b>Ваш пароль: <i>Хз, у нас хэши</i></b><br>
		<b>Ваш баланс: <i><?php echo $money; ?></i> <i class="fas fa-coins"></i></b><br>
		<b>Ваш id: <i><?php echo $id; ?></i></b><br>
		<b>Ваш юзер агент: <i><?php echo $user_agent; ?></i></b>
	</div>

	<div id="error_div" onclick="dismiss_error()">
		<br>
		<p>Вы хуйло!</p>
		<p>Блять</p>
		<br>
	</div>
</body>
</html>