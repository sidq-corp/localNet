<?php

	$me = $_GET['me'];
	$to = $_GET['to'];
	$mess = $_GET['mess'];
	if(file_exists("messlog/localchat/$me-$to.log")){

		$f = fopen("messlog/localchat/$me-$to.log", "a");
		fwrite($f, "$me: $mess \n");
		fclose($f);

	}elseif(file_exists("messlog/localchat/$to-$me.log")){

		$f = fopen("messlog/localchat/$to-$me.log", "a");
		fwrite($f, "$me: $mess \n");
		fclose($f);

	}else{

		$f = fopen("messlog/localchat/$me-$to.log", "w");
		fwrite($f, "$me: $mess \n");
		fclose($f);

	}

	echo json_encode("none"); 

?>