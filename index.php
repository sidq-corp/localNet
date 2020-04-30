<!DOCTYPE html>
<html>
<head>
	<title>LocalNet</title>
	<link rel="stylesheet" href="css/main.css">
	<script src="js/main.js"></script>
</head>
<body>
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
	<div id="login">
		<div class="title">
			ВХОД В АККАУНТ
		</div>
		<div id="login_form">
			<form action="php/login.php" method="get">
				Логин: <input  type="text" name="user_login">
				Пароль: <input type="text" name="user_pass">
				<input type="submit" name="submit" value="Войти">
			</form>
		</div>
	</div>
</body>
</html>