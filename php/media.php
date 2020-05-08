<!DOCTYPE html>
<html>
<head>
	<title>Медиа</title>
</head>
<body>
	<form action="search_audio.php" method="get" enctype="multipart/form-data">
		  Ритм: <input name="rhythm" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Мелодия: <input name="melody" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Басс: <input name="bass" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Адекватность: <input name="adequacy" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  Звучность: <input name="ringing" type="range" min="1" max="100" value="50" class="slider" id="myRange"><br>
		  <input type="submit" name="submit">
	</form>
</body>
</html>