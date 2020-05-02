<?php

	$me = $_GET['me'];
	$to = $_GET['to'];
	$mess = $_GET['mess'];
	if(file_exists("messlog/localchat/$me-$to.log")){

		$f = fopen("messlog/localchat/$me-$to.log", "a");
		fwrite($f, "$me: $mess<br> \n");
		fclose($f);
		
		$f = fopen("messlog/localchat/$me-$to.log", "r");
		$text = fread($f, filesize("messlog/localchat/$me-$to.log"));
		fclose($f);

	}elseif(file_exists("messlog/localchat/$to-$me.log")){

		$f = fopen("messlog/localchat/$to-$me.log", "a");
		fwrite($f, "$me: $mess<br> \n");
		fclose($f);

		$f = fopen("messlog/localchat/$to-$me.log", "r");
		$text = fread($f, filesize("messlog/localchat/$to-$me.log"));
		fclose($f);

	}else{

		$f = fopen("messlog/localchat/$me-$to.log", "w");
		fwrite($f, "$me: $mess<br> \n");
		fclose($f);

		$f = fopen("messlog/localchat/$me-$to.log", "r");
		$text = fread($f, filesize("messlog/localchat/$me-$to.log"));
		fclose($f);

	}

	echo json_encode($text); 

?>