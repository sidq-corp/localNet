<!DOCTYPE html>
<html>
<head>
	<title>LocalNet</title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" name="viewport">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/main.js"></script>
</head>
<body onload="init()">
	<?php 
		if(isset($_GET['error'])){
			$err = $_GET['error'];
			echo "<script>throw_error_by_id('$err')</script>";
		}
		?>
	<div id='wrapper'>
		<div id = 'logo' onclick="logo_drop()"><br><br><br></div>
		<div id="registr" class = 'input_form'>
			<div class="title">
				Регистрация
			</div>
			<div id="reg_form" class = "generic_form">
				<form action="php/reg.php" method="get">
					<input type="text" placeholder="Никнейм" id = "reg_name" name="reg_name">
					<input  type="text" placeholder="Логин" id = "reg_login" name="reg_login">
					<input type="text" placeholder="Пароль" id = "reg_pass" name="reg_pass">
					<button name="submit" id="check_reg" class="check_but">Зарегистрироваться</button>
				</form>
				<button onclick="display_error('Вы ввели логин или пароль','длинна которого меньше 6 символов')" class="check_but" id="fake_check_reg" style="display: block;">Зарегистрироваться</button>
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
					<input type="text" name="user_pass" id="user_pass" placeholder="Пароль">
					<button name="submit" id="check_log" class="check_but" style="display: none;">Войти</button>
				</form>
				<button onclick="display_error('Вы ввели логин или пароль','длинна которого меньше 6 символов')" class="check_but" id="fake_check_log" style="display: block;">Войти</button>
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