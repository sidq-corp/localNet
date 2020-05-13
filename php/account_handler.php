<?php
	function get_money($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			return $money;
		}
	}
	function get_color($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			return $color;
		}
	}
	function get_prefix($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			return $prefix;
		}
	}

	function set_money($login, $mon){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			$f = fopen("account/$login.id", "w");
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			fwrite($f, "$id\n");
			fwrite($f, "$login\n");
			fwrite($f, "$name\n");
			fwrite($f, "$pass\n");
			fwrite($f, "$mon\n");
			fwrite($f, "$color\n");
			fwrite($f, "$prefix\n");
			fwrite($f, "$ip\n");
			fwrite($f, $user_agent);
			fclose($f);
		}
	}
	function set_color($login, $col){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			$f = fopen("account/$login.id", "w");
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			fwrite($f, "$id\n");
			fwrite($f, "$login\n");
			fwrite($f, "$name\n");
			fwrite($f, "$pass\n");
			fwrite($f, "$money\n");
			fwrite($f, "$col\n");
			fwrite($f, "$prefix\n");
			fwrite($f, "$ip\n");
			fwrite($f, $user_agent);
			fclose($f);
		}
	}
	function set_prefix($login, $pref){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($ip != $lip or $user_agent != $luser_agent){
			header ('Location: ../index.php');
   			exit();
		}else{
			$f = fopen("account/$login.id", "w");
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			fwrite($f, "$id\n");
			fwrite($f, "$login\n");
			fwrite($f, "$name\n");
			fwrite($f, "$pass\n");
			fwrite($f, "$money\n");
			fwrite($f, "$color\n");
			fwrite($f, "$pref\n");
			fwrite($f, "$ip\n");
			fwrite($f, $user_agent);
			fclose($f);
		}
	}

?>