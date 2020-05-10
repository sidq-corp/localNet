<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">
	<title>Audio</title>
</head>
<body>
	<?php 
		include("audio_handler.php");
		if(isset($_GET['rhythm']) and isset($_GET['melody']) and isset($_GET['bass']) and
		isset($_GET['adequacy']) and isset($_GET['ringing'])){
			$sounds = search_sound($_GET['rhythm'], $_GET['melody'], $_GET['bass'], $_GET['adequacy'], $_GET['ringing']);
		echo json_encode($sounds, JSON_UNESCAPED_UNICODE);
		}else{
			header ('Location: ../main/main.php');  // перенаправление на нужную страницу
	   		exit();
		}
	?>
</body>
</html>
