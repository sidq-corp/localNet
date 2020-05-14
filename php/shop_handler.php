<?php
	include("account_handler.php");
	$ids = array(array(15, '#fcba03'), array(10, '#0c7ef7'), array(10, '#32a89d'),
		  		 array(10, '#36bf17'), array(10, '#FF6F61'), array(15, '#D6ED17FF'));
	if(isset($_POST['id']) and isset($_COOKIE['login'])){
		$login = $_COOKIE['login'];
		$id = $_POST['id'];
		$money = get_money($login);
		if($money >= $ids[$id][0]){
			set_money($login, $money-$ids[$id][0]);
			set_money("localshop", get_money("localshop") + $ids[$id][0]);
			set_color($login, $ids[$id][1]);
			echo json_encode("good");
		}else{
			echo json_encode("false");
		}

	}else{
		// header ('Location: ../main/main.php');  
   		// exit();
	}
?>