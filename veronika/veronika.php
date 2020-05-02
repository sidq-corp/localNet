<?php $name = $_GET['name']; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Вероника младшая</title>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="../css/global.css">
	<script src="main.js"></script>
	<script src="../js/global.js"></script>
</head>
<body onload="global_init(); chat()">
	<div id = 'header-placeholder'>
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = "header-menu">
		<!-- <div id = 'header-items'> -->
			<a href="/main/main.php?login=<?php echo $login; ?>"><div id = 'header-logo'><br></div></a>
			<div class = 'header-item header-item-a' >
				<div class = 'header-picker'>
					<a href="../veronika/veronika.php?name=<?php echo $login; ?>">
						<b>[</b>NEW<b>]</b> Вероника
					</a>
				</div>
			</div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
		<!-- </div> -->
		<div class = 'header-item header-item-a' id = 'header-login' onclick = 'gui_account_check()'>
			<div class = 'header-picker'>Никнейм: <?php echo $name; ?>,<br> Логин: <?php echo $login; ?></div>
		</div>
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