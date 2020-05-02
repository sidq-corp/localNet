<?php
		echo "<script src='../js/main.js'></script>";
		$login = $_GET['login'];
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			echo"<script>error()</script>";
		}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $name; ?></title>
	<link rel="stylesheet" href="../css/main.css">
	<script src="../js/ajax_script.js"></script>
  	<script src="../js/ajax.js"></script>
  	<script src="../js/main.js"></script>
</head>
<body onload="initjs(); init()">
	<div id = 'header-placeholder'>
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = "header-menu">
		<div id = 'header-items'>
			<a href="/main/main.php?login=<?php echo $login; ?>"><div id = 'header-logo'></div></a>
			<div class = 'header-item header-item-a' >
				<div class = 'header-picker'>
					<a href="../veronika/veronika.php?name=<?php echo $login; ?>">
						<b>[</b>NEW<b>]</b> Вероника
					</a>
				</div>
			</div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
			<div class = 'header-item header-item-a'><div class = 'header-picker'>Чат</div></div>
		</div>
		<div class = 'header-item header-item-a' id = 'header-login' onclick = 'gui_account_check()'>
			<div class = 'header-picker'>Никнейм: <?php echo $name; ?>,<br> Логин: <?php echo $login; ?></div>
		</div>
	</div>
	<div id = 'wrapper-content'>
		<div id="local_chat">
			<div id="local_chat_1">
				<form method="post" id="ajax_form" action="" >
					<input list="guys" type="text" name="goto" id="goto"><br>
					<datalist id="guys">
						<?php 
							$files = scandir("../php/account");
							foreach ($files as $file) {
								if($file == '.' or $file == '..'){
									continue;
								}else{
									$f = fopen("../php/account/$file", "r");
									$all = fread($f,  filesize("../php/account/$file"));
									fclose($f);
									list($id, $login, $name, $pass) = explode("\n", $all);
									echo "<option>$login($name)</option>";
								}
							}
						?>
	   				</datalist> 
			        <input type="text" name="messloc" id="messloc"><br>
			        <input type="button" id="lcl" value="Отправить" />

			    </form>
			</div>
		</div>
		<div id="global_chat">
			<div id="global_chat_1">
				<form method="post" id="global_chat_form" action="" >
			        <input type="text" maxlength="50" name="mess" id="messin"><br>
			        <input type="button" id="glb" value="Отправить" />
			    </form>

			    <div id="result_form"></div> 
			</div>
		</div>
	</div>
	
	<div id="error_div" onclick="dismiss_error()">
		<br>
		<p>Вы хуйло!</p>
		<p>Блять</p>
		<br>
	</div>
<!-- Глобальный чал -->
</body>
</html>