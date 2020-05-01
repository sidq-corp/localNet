<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
	<script src="../js/main_login.js"></script>
	<link rel="stylesheet" href="../css/main_login.css">
	<script src="../js/ajax_script.js"></script>
  	<script src="../js/ajax.js"></script>
</head>
<body onload="reader()">
	<?php
		$name = $_GET['name'];
		$secret = $_GET['secret'];
		$login = $_GET['login'];
		$id = $_GET['id'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$secretkey = hash("sha256", "$login$id$ip");
		if($secretkey == $secret){
			echo"correct";
		}else{
			echo"error";
			echo"<script>error()</script>";
		}
	?>
					<?php 
						$files = scandir("../php/account");

						foreach ($files as $file) {
							echo "<script>console.log('$file')</script>";
						}
					?>

	<div id="local_chat">
		<div id="local_chat_1">
			<form method="post" id="ajax_form" action="" >
				<input list="guys" type="text" name="goto" id="goto"><br>
				<datalist id="guys">
					
   				</datalist> 
		        <input type="text" name="messloc" id="messloc"><br>
		        <input type="text" name="name" value="<?php echo $name; ?>">
		        <input type="button" id="lcl" value="Отправить" />
		    </form>
		</div>
	</div>






<!-- Глобальный чат -->
	<div id="global_chat">
		<div id="global_chat_1">
			<form method="post" id="global_chat_form" action="" >
		        <input type="text" name="mess" id="messin"><br>
		        <input type="text" name="name" value="<?php echo $name; ?>">
		        <input type="button" id="glb" value="Отправить" />
		    </form>

		    <div id="result_form"></div> 
		</div>
	</div>
<!-- Глобальный чал -->
</body>
</html>