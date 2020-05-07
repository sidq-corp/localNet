<?php
		if(isset($_GET['login'])){ // siski
			$login = $_GET['login'];
			setcookie("login", $login, time() + 172800, '/');
			setcookie("login", $login, time() + 172800);
		}elseif (isset($_COOKIE['login'])) {
			$login = $_COOKIE['login'];
			setcookie("login", $login, time() + 172800, '/');
			setcookie("login", $login, time() + 172800);
		}else{
			header ('Location: ../index.php');  // перенаправление на нужную страницу
   			exit();
		}

		if(!file_exists("../php/account/$login.id")){
			header ('Location: ../index.php');  // перенаправление на нужную страницу
	   		exit();
		}	
	
		// phpinfo(32);
			$f = fopen("../php/account/$login.id", "r");
			$all = fread($f,  filesize("../php/account/$login.id"));
			list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			if($ip != $lip or $user_agent != $luser_agent){
				header ('Location: ../index.php');
	   			exit();
			}
			setcookie("name", $name, time() + 172800, '/');
			setcookie("name", $name, time() + 172800);


			echo "<script src='../js/main.js'></script>";

		
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">
	<title><?php echo $name; ?></title>
	
	<link rel="stylesheet" href="../css/global.css">
	<link rel="stylesheet" href="../css/main.css">
	<script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script type="text/javascript" src="../js/ajax_script.js"></script>
  	<script type="text/javascript" src="../js/ajax.js"></script>
  	<script type="text/javascript" src="../js/main.js"></script>
  	<script type="text/javascript" src="../js/global.js"></script>
  	<script type="text/javascript" src="../js/local.js"></script>
  	<script type="text/javascript" src="../js/audio.js"></script>
</head>
<body onload="global_init(); update(); init(); init_main_js(); dir('/js')">
	<div id = 'loading-wrapper'>
		<div id = 'loading-wrapper-gradient'>

		</div>
	</div>
	<div id = 'header'>

	</div>
	<!-- a -->
	<div id = 'wrapper-content'>
		<div id = 'wrapper-left'>
			<!-- <a href = '#global_chat'>
				<div class = 'article article-one' id = 'article-tp-to-chat' style = 'background-color: #333; background-image: none; height: 8%;'>
					<div class = 'article-content' style = "background: none;">
						<br>
						<div class = 'article-picker'>
							<h1 style = "color: #fff;">Перейти к чатам <i style = 'transform: skewX(-12deg);' class="fas fa-caret-down"></i></h1>
						</div>
					</div>
				</div>
			</a> -->
			<?php 
			$f = fopen("artic.txt", "r");
			echo fread($f, filesize("artic.txt"));
			?>
		</div>
		<div id = 'wrapper-right'>
			<div id="global_chat">
				<div class='gchat-title' onclick = 'gchat_check()'>
					Общий чат
				</div>

				<div id = 'gchat-hide'>
					<div id="help_div" style = "margin-top: 3%; margin-bottom: 3%;">
						<b>Ваши сообщения увидят вce пользователи сайта</b>
					</div>
					<form method="post" id="global_chat_form" action="" >
				        <input placeholder="Сообщение" type="text" maxlength="100" name="mess" id="messin"><br>
				        <button id="glb" style="margin-top: 3%;" onclick = "check_gchat_if_disabled()" class = 'gui-but gui-but-small'>Отправить</button>
				    </form>

				    <div id="result_form"></div> 
				</div>
			</div>

			<div id="local_chat" style = "height: auto;">
				<div class='gchat-title' style = 'line-height: 400%;' onclick = 'lchat_check()'>
					Локал Чат
				</div>
				<div id = 'lchat-hide' style = "display: none;">
					<form method="post" id="ajax_form" action="" >
						<div id = 'lchat-start'>
							<div id="help_div" style = "margin-top: 3%; margin-bottom: 3%;">
								<b>Выберите цепочку сообщений</b><br>

							</div>
							<!-- <input list="guys" type="text" name="goto" id="goto" > -->
							<select id="goto" name="goto">
								<?php 
									$files = scandir("../php/account");
									foreach ($files as $file) {
										if($file == '.' or $file == '..'){
											continue;
										}else{
											$f = fopen("../php/account/$file", "r");
											$all = fread($f,  filesize("../php/account/$file"));
											fclose($f);
											list($id_, $login_, $name_, $pass_) = explode("\n", $all);
											echo "<option>$login_($name_)</option>";
										}
									}
								?>
			   				</select> 
			   				<button style="margin-top: 3%;" type = 'button' onclick="start_c()" class = 'gui-but gui-but-small'>Выбрать</button>
			   				<div id="help_div">
								<p type = "button" onclick="clean_c()">Очистить поле ввода</p>
							</div>	
			   			</div>
			   			<div id = 'lchat-end' style = 'display: none;'>
			   				<div type = "button" onclick="stop_c()" id="help_div" style = "margin-top: 0%; margin-bottom: 0%;">
								<p>Выйти из цепочки</p>
							</div>	
			   				<div id="help_div" style = "margin-top: 3%; margin-bottom: 3%;">
								<b>Ваши сообщения увидет только</b><br>
								<b id = "c_usr">получатель -</b>
							</div>
					        <input type="text" name="messloc" id="messloc"><br>
					        <!-- <input type="button" id="lcl" value="Отправить">  -->
					        <!-- ывывы -->
					        <button id="lcl" style="margin-top: 3%;" onclick="local_handler()" class = 'gui-but gui-but-small'>Отправить</button>
					        <div id="local_answer">Загрузка...</div>
					    </div>
				    </form>
				</div>
			</div>

		</div>
	</div>

	
	<div id = 'gui-container' class = 'hidden-on-start'>
		<b>Ваш никнейм: <i><?php echo $name; ?></i></b><br>
		<b>Ваш логин: <i><?php echo $login; ?></i></b><br>
		<b>Ваш пароль: <i>Хз, у нас хэши</i></b><br>
		<b>Ваш баланс: <i><?php echo $money; ?></i> <i class="fas fa-coins"></i></b><br>
		<b>Ваш id: <i><?php echo $id; ?></i></b><br>
		<b>Ваш юзер агент: <i><?php echo $user_agent; ?></i></b>
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
