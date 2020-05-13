<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		?>
<!DOCTYPE html>
<html lang="en">
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
		<!-- <input type="text" name="name" style='display: none;' value="<?php echo $name; ?>"> -->
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = 'loading-wrapper'>
		<div id = 'loading-wrapper-gradient'>

		</div>
	</div>
	<div id = 'header'>
		
	</div>

	<div id = 'wrapper'>
		<div id = 'wrapper-left'>
			<div class = 'side-tab'>
				<div class = 'side-tab-b'>Вероника: <b>Работает</b></div>
			</div>

			<div class = 'side-tab side-tab-small side-hide' style = 'margin-top: 5%;'>
				<div class = 'side-tab-b' >Последний ответ: <b style = 'background-color: #333; color: #e8e8e8;' id="answer"></b></div>
			</div>
			<!-- <div class = 'side-tab side-tab-small'>
				<div class = 'side-tab-b' >Как это работает?</div>
			</div> -->
		</div>
		<div id = 'wrapper-right'>
			<div id = 'bot-log'>
				<div class = 'side-tab' onclick = 'chat_switch()' id = 'side-tab-log'>
					<div class = 'side-tab-b' >Чат</div>
				</div>
				<div id = 'bot-log-hide'>
					<div id="help_div" style = "margin-top: 3%; margin-bottom: 3%;">
						<b>Вашу переписку увидят вce пользователи сайта</b>
					</div>
					<form method="get" id="form" action="veronika.php">
						<input type="text" name="name" style='display: none;' value="<?php echo $name; ?>">
						<input type="text" name="text" id="input" placeholder="Сообщение Веронике">
						<button style="margin-top: 3%;" class = 'gui-but gui-but-small' type="submit" name="submit" id="enter">Отправить</button>
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
						<div id="chat_text">
							text
						</div>
					</form>

				    <!-- <div id="result_form"></div>  -->
				</div>
			</div>
		</div>
	</div>


	<div id = 'gui-container' class = 'hidden-on-start'>
		<b>Ваш никнейм: <i><?php echo $name; ?></i></b><br>
		<b>Ваш логин: <i><?php echo $login; ?></i></b><br>
		<b>Ваш id: <i><?php echo $id; ?></i></b><br>
		<b>Ваш пароль: <i>Хз, у нас хэши</i></b><br>
		<b>Ваш баланс: <i><?php echo $money; ?></i> <i class="fas fa-coins"></i></b><br>
		<b>Ваш цвет: <i><?php echo $color; ?></i></b><br>
		<b>Ваш префикс: <i><?php echo $prefix; ?></i></b><br>
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