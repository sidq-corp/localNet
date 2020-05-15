<?php
	include("account_handler.php");
	$ids = array(array(10, '<i class="fas fa-toilet-paper"></i>'), array(30, '<i class="fas fa-toilet-paper"></i>'), array(50, '<i class="fas fa-toilet-paper"></i>'),
		  		 array(10, '<i class="fas fa-angle-up"></i>'), array(20, '<i class="fas fa-angle-double-up"></i>'), array(50, '<i class="fas fa-star"></i>'));
	if(isset($_POST['id']) and isset($_COOKIE['login'])){
		$login = $_COOKIE['login'];
		$id = $_POST['id'];
		$money = get_money($login);
		if($money >= $ids[$id][0]){
			set_money($login, $money-$ids[$id][0]);
			// set_money("localshop", get_money("localshop") + $ids[$id][0]);
			set_prefix($login, $ids[$id][1]);
			echo json_encode("good");
		}else{
			echo json_encode("false");
		}

	}else{
		// header ('Location: ../main/main.php');  
   		// exit();
	}
?>