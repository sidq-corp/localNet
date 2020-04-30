<?php
	if (isset($_POST["mess"])) { 
		$mess = $_POST["mess"];
		if($mess != ''){
			if($mess == '/clear'){
				$f = fopen("messlog/globalchat.log", "w");
				fwrite($f, "");
				fclose($f);
			}else if(explode(" ", $mess)[1] == '/ban'){
				echo json_encode("ban");
			}else{
				$name = $_POST['name'];
			    $f = fopen("messlog/globalchat.log", "r");
				$all = fread($f,  filesize("messlog/globalchat.log"));
				fclose($f);

				$f = fopen("messlog/globalchat.log", "w");
				$name .=": $mess";
				$name.= "<br>$all";
				fwrite($f, $name);
				fclose($f);

			    // Переводим массив в JSON
			    echo json_encode($name);
		    }

		}else{
			echo json_encode(''); 
		}
	}	

?>