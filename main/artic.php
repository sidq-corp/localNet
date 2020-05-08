<?php $login = $_COOKIE['login']; 
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $lip, $luser_agent) = explode("\n", $all);
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Запись - <?php echo $login; ?></title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">

	<link rel="stylesheet" href="../css/artic.css">
	<link rel="stylesheet" href="../css/global.css">

	<script src="../js/artic.js"></script>
	<script src="../js/global.js"></script>
	<script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body onload="global_init();">
	<div id = 'header'>
		
	</div>


	<div id = 'wrapper'>
		<?php 
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$f = fopen("cont/$id.txt", 'r');
				$all = fread($f, filesize("cont/$id.txt"));
				fclose($f);
				list($title, $subtitle, $imgs, $text) = explode("\n", $all);
				$imgs = explode(" ", $imgs);
				// $imgs = str_replace("\n", '', $imgs);
				// echo "<script>load_images('$imgs')</script>";
				echo "<h1>$title</h1><h3>$subtitle</h3><p>$text</p>";
				// echo "<img>$title</h1><h3>$subtitle</h3><p>$text</p>";
				foreach ($imgs as &$value) {
					// echo "<h1>$value</h1>";
				    // echo "<img src='contimg/$value'>";
				    echo "<div id = 'wrapper-img' style='background-image: url(contimg/$value)'><br></div>";
				    // $img = ';
				    // $img = $img
				    // echo "<h1>$img</h1>";
				    // echo "<div class = 'artic-img' style = 'background-image: url(\"contimg/$value\")'>dsdsdsds</div>";
				}
			} 
		?>
		<!-- <h3>
			<a  href = 'main.php'>Назад...</a>
		</h3> -->


		<h2>Больше в нашем телеграмме: <a  href = 'https://t.me/deposidqdev'>../dev</a><br></h2>
	</div>

	

	<div style = "display: none;">
		<div id="user_name"><?php echo $name; ?></div>
		<div id="user_login"><?php echo $login; ?></div>
	</div>
	<div id = 'loading-wrapper'>
		<div id = 'loading-wrapper-gradient'>

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