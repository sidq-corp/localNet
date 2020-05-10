<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		?>
<!DOCTYPE html>
<html>
<head>
	<title>О проэкте</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">

	<link rel="stylesheet" href="../css/about.css">
	<link rel="stylesheet" href="../css/global.css">

	<script src="../js/about.js"></script>
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
		<h1>Для чего нужен localNet?</h1>
		<p>
			Этот сайт нужен для локального общения в сети без доступа к интернету. Помимо своей главной функции мы добаили на него достаточно много контента и функционала, что-бы можно было себя занять. Пентест, мирное сосуществование и анархия в одной wifi сети стало возможным благодаря нам. Для запуска достаточно просто скачать OpenServer и запустить сайт.

		</p>
		<h1>Кому говорить спасибо?</h1>
		<p>
			Спасибо нужно говорить @depozzyx и @sidq. Сайт был написал полностью с нуля, и мы воплощали в нем все свои идеи( на самом деле нет depozzyx 06/05/20 ). Перед нами вставало множество трудностей, багов, ошибок( ну это уже да ). Не одна сотня нервных клеток были похоронены на этом сайте. Мы ахуенные.
			
		</p>
		<h1>Контакты:</h1>
		<p>
			Telegram: <a  href = 'https://t.me/sidqdev'>@restylesidq</a> или <a  href = 'https://t.me/depozzyx'>@depozzyx</a><br>
			Наш телеграм канал: <a  href = 'https://t.me/deposidqdev'>../dev</a><br>
			Нет телеграма – скачай!<br>
			<b style = 'font-size: 110%;' id = 'changelog-open'>Changelog / История изменений: <a  onclick="show_changelog()" >открыть</a></b>
		</p>
		<div id = 'changelog'>
			<h1>May 10, 2020</h1>
			<p>
				Закончен бекэнд поиска и добаления музыки.<br>
				Начало разработки его дизайна. 
			</p>
			<h1>May 9, 2020</h1>
			<p>
				Написан changelog.<br>
				Система музыки добавлена в залипалки.
			</p>
			<h1>May 8, 2020</h1>
			<p>
				Пентест #3 - неудачный.<br>
				Добавлена вкладка с играми, которая превратится позже в залипалки.<br>
				Пишется система поиска вудио по параметрам.
			</p>
			<h1>May 6 - May 7, 2020</h1>
			<p>
				Теперь на артиклы можно заходить. Система унифицирована.<br>
				Адаптация вероники.<br>
				Модифицирован gui.<br>
				Добавлена анимация localnet при загрузке. Сасно.
			</p>
			<h1>May 5, 2020</h1>
			<p>
				Дизайн главной страницы допилен.<br>
				Хэдэр, гуи и некоторые другие универсальные блоки перенесены в global.js.<br>
				Начало дизайна Вероники.<br>
				Написание хэндлера под аудио.
			</p>
			<h1>May 4, 2020</h1>
			<p>
				Добавлены игры +- в это время, однако на них пока что нельзя зайти.<br>
				Адаптация главной страницы.<br>
				Какая-то х**ня с бэкэндом. Хз что там.
			</p>
			<h1>May 3, 2020</h1>
			<p>
				Главная страница почти сделана на пк. Адаптация.<br>
				Начало системы денег. Баги.<br>
				Заплатки дыр от пентестов. <br>
				Добавлена +- в это время Вероника на сайт.
			</p>
			<h1>May 2, 2020</h1>
			<p>
				Пентест #2 - удачный.<br>
				Заплатки дыр от пентестов. <br>
				Чаты вероятно уже допилены.<br>
				Первый gui аккаунта.<br>
				Логин полностью сделан.
			</p>
			<h1>May 1, 2020</h1>
			<p>
				Первый пентест - удачный.<br>
				Дизайн логина на пк допилен. Адаптация под телефоны.<br>
				Начало дизайна чатов.
			</p>
			<h1>Apr 30, 2020</h1>
			<p>
				Первый коммит.<br>
				Бэкэнд логина, начало его дизайна.<br>
				Начало бэкэнда чатов.
			</p>
		</div>
		<h2>С *сердечко* <b id = 'wrapper-logo'>localnet</b></h2>
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