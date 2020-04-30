<?php
	$secret = $_GET['secret'];
	$login = $_GET['login'];
	$id = $_GET['id'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$secretkey = hash("sha256", "$login$id$ip");
	if($secretkey == $secret){
		echo"correct";
	}else{
		echo"error";
	}
?>