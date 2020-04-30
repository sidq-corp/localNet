<!DOCTYPE html>
<html>
<head>
	<title>LocalNet</title>
	<link rel="stylesheet" href="css/main.css">
	<script src="js/main.js"></script>
</head>
<body onload="init()">
	<div id="registr">
		<div class="title">
			РЕГИСТРАЦИЯ
		</div>
		<div id="reg_form">
			<form action="php/reg.php" method="get">
				<p>Логин:</p> <input  type="text" name="reg_login">
				<p>Имя: </p>   <input type="text" name="reg_name">
				<p>Пароль:</p> <input type="text" name="reg_pass">
				<input type="submit" name="submit" value="Зарегистрироваться">
			</form>
		</div>
	</div>
	<div id = 'logo' onclick="logo_drop()"tooltip = "О нас"></div>
	<div id="login" class = 'input_form'>
		
		<div class="title">
			Вход
		</div>
		<div id="login_form">
			<form action="php/login.php" method="get">
				<input  type="text" name="user_login" placeholder="Логин">
				<input type="text" name="user_pass" placeholder="Пароль">
				<button name="submit">Войти</button>
			</form>
		</div>
	</div>
</body>
</html>