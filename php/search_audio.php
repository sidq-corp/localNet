<?php 
	include("audio_handler.php");
	if(isset($_GET['rhythm']) and isset($_GET['melody']) and isset($_GET['bass']) and
	isset($_GET['adequacy']) and isset($_GET['ringing'])){
		$sounds = search_sound($_GET['rhythm'], $_GET['melody'], $_GET['bass'], $_GET['adequacy'], $_GET['ringing']);
	echo json_encode($sounds);
	}else{
		header ('Location: ../main/main.php');  // перенаправление на нужную страницу
   		exit();
	}
?>