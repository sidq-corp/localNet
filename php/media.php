<!DOCTYPE html>
<html>
<head>
	<title>Медиа</title>
</head>
<body>
	<form enctype="multipart/form-data" action="media.php" method="POST">
		  Ритм: <input name="rhythm" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Мелодия: <input name="melody" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Басс: <input name="bass" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Адекватность: <input name="adequacy" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Звучность: <input name="ringing" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Исполнитель: <input type="text" name="singer"><br>
		  Название: <input type="text" name="name">
   		  Отправить этот файл: <input name="userfile" type="file"><br>

		  <input type="submit" name="submit">
	</form>
	<?php
	include("audio_handler.php");
	$uploaddir =  getcwd() . "/audio/";
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	if(explode('/', $_FILES['userfile']['type'])[0] == 'audio'){
		// while(1){
			if(!file_exists($uploadfile)){
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			    	echo "Файл корректен и был успешно загружен.\n";
			    	add_sound($uploadfile, $_POST['name'], $_POST['singer'], $_GET['rhythm'], $_GET['melody'], $_GET['bass'], $_GET['adequacy'], $_GET['ringing']);
			    // break;
				} else {
					echo "Ошибка";
				}
			} else {
				    echo "Файл сущвствует";
			}
		// }
		// print_r($_FILES);

	}
	?>
</body>
</html>