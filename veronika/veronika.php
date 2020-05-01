<!DOCTYPE html>
<html>
<head>
	<title>Вероника младшая</title>
	<link rel="stylesheet" href="main.css">
	<script src="main.js"></script>

</head>
<body onload="chat()">
	<div id="main">
		<form method="get" id="form" action="veronika.php">
			<input type="text" name="text" id="input">
			<div id="answer">Ответ...</div>
			<input type="submit" name="submit" value="Отправить" id="enter">
			<?php
				function write($text){
					$f = fopen("input.txt", "w");
					fwrite($f, $text);
					fclose($f);
				}
				if(isset($_GET)){
					write($_GET['text']);
					echo "<script>setTimeout(get_answer, 1500)</script>";
				}
			?>
		</form>
	</div>

	<div id="contact">
		<a href="https://telegram.me/depozzya_bot">
			<img src="telegram.png" id="telegram">
		</a>
		<a href="https://discord.gg/Dpj2nVZ">
			<img src="discord.png" id="discord">
		</a>

	</div>

	<div id="chat">
			ГЛОБАЛЬНЫЙ ЧАТ:
		<div id="chat_text">
			text
		</div>
	</div>
</body>
</html>