<?php $name = $_GET['name']; ?>
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
				if(isset($_GET)){
					write($_GET['name'], $_GET['text']);
					echo "<script>setTimeout(get_answer, 1500)</script>";
				}
			?>
		</form>
	</div>

	<div id="go_back">
		<a href="../main/main.php?login=<?php echo $name; ?>">Main</a>

	</div>

	<div id="chat">
			ГЛОБАЛЬНЫЙ ЧАТ:
		<div id="chat_text">
			text
		</div>
	</div>
</body>
</html>