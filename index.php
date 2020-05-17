<!DOCTYPE html>
<html>
<head>
	<title>localnet</title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" name="viewport">

	<meta name="description" content="Сайт для общения и залипания, который может работать без постоянного подключения к Интернету"> 
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" type="image/png" href="favicon.png">

	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/stars.css">
	<script src="js/index.js"></script>
</head>
<body onload="init()">
	<?php 
		if(isset($_GET['error'])){
			$err = $_GET['error'];
			echo "<script>throw_error_by_id('$err')</script>";
		}
		?>
	<div id='stars'></div>
	<div id='stars2'></div>
	<div id='stars3'></div>
	<div id='wrapper'>
		<div id = 'logo' onclick="logo_drop()"><br><br><br></div>
		<div id="registr" class = 'input_form'>
			<div class="title">
				Регистрация
			</div>
			<div id="reg_form" class = "generic_form">
				<form action="php/reg.php" method="get">
					<input type="text" placeholder="Никнейм" id = "reg_name" name="reg_name"  maxlength="20">
					<input  type="text" placeholder="Логин" id = "reg_login" name="reg_login" maxlength="20">
					<input type="text" placeholder="Пароль" id = "reg_pass" name="reg_pass" maxlength="20">
					<button name="submit" id="check_reg" class="check_but">Зарегистрироваться</button>
				</form>
				<button onclick="display_error('Вы ввели логин или пароль, который:<br>или меньше 6 символов <br>или в себе содержит ``:``')" class="check_but" id="fake_check_reg" style="display: block;">Зарегистрироваться</button>
				<div id="help_div" style='margin-top: 10%'>
					<p onclick='show_log_form()'>Уже зарегестрированы? Вход.</p>
					<!-- <p>Как это работает?</p> -->
				</div>
			</div>
		</div>
		<div id="login" class = 'input_form'>
			
			<div class="title">
				Вход
			</div>
			<div id="login_form" class = "generic_form">
				<form action="php/login.php" method="get">
					<input  type="text" name="user_login" id="user_login"  placeholder="Логин">
					<input type="password" name="user_pass" id="user_pass" placeholder="Пароль">
					<button name="submit" id="check_log" class="check_but" style="display: none;">Войти</button>
				</form>
				<button onclick="display_error('Вы ввели логин или пароль, длинна которого меньше 6 символов')" class="check_but" id="fake_check_log" style="display: block;">Войти</button>
				<div id="help_div">
					<p onclick='show_reg_form()'>Нет аккаунта? Регистрация.</p>
					<!-- <p>Как это работает?</p> -->
				</div>
			</div>
			
		</div>
		<div id="error_div" onclick="dismiss_error()">
			<br>
			<p>Вы хуйло!</p>
			<p>Блять</p>
			<br>
		</div>
	</div>

	
</body>
</html>