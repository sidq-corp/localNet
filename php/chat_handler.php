<?php
			if (isset($_COOKIE['login'])) {
				$login = $_COOKIE['login'];
			}else{
				header ('Location: ../index.php');  // перенаправление на нужную страницу
	   			exit();
			}

			$f = fopen("../php/account/$login.id", "r");
			$all = fread($f,  filesize("../php/account/$login.id"));
			list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			if($ip != $lip or $user_agent != $luser_agent){
				header ('Location: ../index.php');
	   			exit();
			}

	function fulllog($mess_1)
	{
		$l = fopen("messlog/fullGlobal.log", 'a');
		$today = date("[Y-m-d H:i:s] ");    
		fwrite($l, $today . $mess_1);
		fclose($l);
	}

	if (isset($_POST["mess"])) { 
		$mess = strip_tags($_POST["mess"]);
		if($mess != '' and strlen($mess) <= 100){
			if($mess == '/clear'){
				$name = $_POST['name'];
				$f = fopen("messlog/globalchat.log", "w");
				fwrite($f, "$name очистил чат!");
				fclose($f);
				fulllog("$name очистил чат!");
				echo json_encode("$name очистил чат!");
			}else{
				$name = $_POST['name'];
				fulllog("$name: $mess\n");
			    $f = fopen("messlog/globalchat.log", "r");
				$all = fread($f,  filesize("messlog/globalchat.log"));
				fclose($f);

				$f = fopen("messlog/globalchat.log", "w");
				$name ="$prefix$name||$color: $mess";
				$name.= "<br>$all";
				fwrite($f, $name);
				fclose($f);

			    // Переводим массив в JSON
			    echo json_encode("$name");
		    }

		}else{
			echo json_encode("none"); 
		}
	}	

?>