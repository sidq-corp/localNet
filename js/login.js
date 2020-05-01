function login_not_found(){
	document.location.href='../index.php?error=login';
}
function correct_login(sk, login, id, name){
	document.location.href='../main/main.php?secret=' + sk + '&login=' + login + '&id=' + id + '&name=' + name;
}
function error_pass(){
	document.location.href='../index.php?error=pass';
	
}