<?php
	function get_money($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		return $money;
	}
	function get_color($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		return $color;
	}
	function get_prefix($login){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		return $prefix;
	}

	function set_money($login, $mon){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$f = fopen("account/$login.id", "w");
		fwrite($f, "$id\n");
		fwrite($f, "$login\n");
		fwrite($f, "$name\n");
		fwrite($f, "$pass\n");
		fwrite($f, "$mon\n");
		fwrite($f, "$color\n");
		fwrite($f, "$prefix\n");
		fwrite($f, "$lip\n");
		fwrite($f, $luser_agent);
		fclose($f);
	}
	function set_color($login, $col){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$f = fopen("account/$login.id", "w");
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
	function set_prefix($login, $pref){
		$f = fopen("../php/account/$login.id", "r");
		$all = fread($f,  filesize("../php/account/$login.id"));
		list($id, $login, $name, $pass, $money, $color, $prefix, $lip, $luser_agent) = explode("\n", $all);
		$f = fopen("account/$login.id", "w");
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

?>