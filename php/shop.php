<?php 
		include("account_handler.php");
		$login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		?>
<!DOCTYPE html>
<html>
<head>
	<title>Магазин - <?php echo $name; ?></title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">

	<link rel="stylesheet" href="../css/global.css">
	<link rel="stylesheet" href="../css/article.css">
	<link rel="stylesheet" href="../css/shop.css">
	
	<meta name="description" content="Сайт для общения и залипания, который может работать без постоянного подключения к Интернету"> 
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="icon" type="image/png" href="../favicon.png">

	<script src="../js/shop.js"></script>
	<script src="../js/global.js"></script>
	<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body onload="global_init();">
	<div id = 'only-visual-features-here--try-to-hack-=>-u-will-suck' style = "display: none;">
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
		<div id="user_color"><?php echo $color; ?></div>
		<div id="user_prefix"><?php echo $prefix; ?></div>
	</div>
	<div id = 'loading-wrapper'>
		<div id = 'loading-wrapper-gradient'>

		</div>
	</div>
	<div id = 'header'>
		
	</div>


	<div class = 'wrapper' id = 'wrapper-base'>
		<h1>Чат</h1>
		<div class = 'article article-double' onclick="switch_wrapper('wrapper-color')" style = 'height: 20%; background-image: url(../css/images/shp1.jpg);'>
			<div class = 'article-content'>
				<div class = 'article-picker article-shadow'>
					<h1>Цвет ника</h1>
					<p class = 'article-sub-text'>Хочется блевать, но ладно</p>
					<br>
					<br>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>
		<div class = 'article article-double' onclick="switch_wrapper('wrapper-prefix')" style = 'height: 20%; background-image: url(../css/images/shp2.jpg);'>
			<div class = 'article-content'>
				<div class = 'article-picker article-shadow'>
					<h1>Шильдики</h1>
					<p class = 'article-sub-text'>Префиксы-неймтеги-нп</p>
					<!-- <p class = 'article-sub-text'><i class="fas fa-toilet-paper"></i><i class="fas fa-star"></i><i class="fas fa-compass"></i><i class="fas fa-angle-up"></i><i class="fas fa-angle-double-up"></i></p> -->
					<br>
					<br>
				</div>
			</div>
		</div>

	</div>

	<div class = 'wrapper' id = 'wrapper-color' style="display: none;">
		<h1>Цвета ника</h1>
		<div id = 'wrapper-color-container'>

		</div>

		<br><br>
		<div class = 'article article-one article-text' onclick="switch_wrapper('wrapper-base')" style = 'background: none;'>
			<h1>Назад в магазин</h1>
		</div>
	</div>

	<div class = 'wrapper' id = 'wrapper-prefix' style="display: none;">
		<h1>Шильдики</h1>
		<div id = 'wrapper-np-container'>

		</div>

		<div class = 'article article-one article-text' onclick="switch_wrapper('wrapper-base')" style = 'background: none;'>
			<h1>Назад в магазин</h1>
		</div>
	</div>


	<div id = 'gui-shop-container'>

	</div>
	<div id = 'gui-container' class = 'hidden-on-start'>
		<b>Ваш никнейм: <i><?php echo $name; ?></i></b><br>
		<b>Ваш логин: <i><?php echo $login; ?></i></b><br>
		<b>Ваш id: <i><?php echo $id; ?></i></b><br>
		<b>Ваш пароль: <i>Хз, у нас хэши</i></b><br>
		<b>Ваш баланс: <i><?php echo $money; ?></i> <i class="fas fa-coins"></i></b><br>
		<b>Ваш цвет: <i style='color: <?php echo $color; ?>; background-color: <?php echo $color; ?>;'>Не смотри</i></b><br>
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