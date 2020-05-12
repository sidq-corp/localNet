<?php
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
				$name .=": $mess";
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