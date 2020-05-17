<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		?>
<!DOCTYPE html>
<html>
<head>
	<title>О проэкте - <?php echo $name; ?></title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">

	<meta name="description" content="Сайт для общения и залипания, который может работать без постоянного подключения к Интернету"> 
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="icon" type="image/png" href="../favicon-media.png">

	<link rel="stylesheet" href="../css/article.css">
	<link rel="stylesheet" href="../css/media.css">
	<link rel="stylesheet" href="../css/global.css">

	<script src="../js/media.js"></script>
	<script src="../js/global.js"></script>
	<script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body onload="global_init();">
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


	<div id = 'wrapper'>
		<h2><b id = 'wrapper-logo'>Локалmedia</b></h2>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-one-separator'><br></div>

		<div class = 'article-one article article-card'>
			<div class = 'article-content'>
				<div class = 'article-picker'>
					<h1>Хочешь добавить своё фото?</h1>
					<p class = 'article-sub-text'>Тыкай сюда!</p>
				</div>
			</div>
		</div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков? вдывдыдвыдвыд вдыв дывылвыдв ыдлывдылвдыл</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-one-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-triple-separator'><br></div>

		<div class = 'article article-triple article-card' onclick = 'goto_link("media-photo.php?id=1")'>
			<div class = 'article-content'>
				<div class = 'article-card-image' style = 'background-image: url(../css/images/art1.jpg);'>
					<br>
				</div>
				<div class = 'article-picker'>
					<h1>Почему птенцы детей рожают узбеков?</h1>
					<p class = 'article-sub-text'>Или как мир несправедлив</p>
				</div>
			</div>
		</div>
		<div class = 'article-one-separator'><br></div>

		<!-- <h1>Контакты:</h1>
		<p>
			Telegram: <a  href = 'https://t.me/sidqdev'>@restylesidq</a> или <a  href = 'https://t.me/depozzyx'>@depozzyx</a><br>
			Наш телеграм канал: <a  href = 'https://t.me/deposidqdev'>../dev</a><br>
			Нет телеграма – скачай!<br>
			<b style = 'font-size: 110%;' id = 'changelog-open'>Changelog / История изменений: <a  onclick="show_changelog()" >открыть</a></b>
		</p> -->
		
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