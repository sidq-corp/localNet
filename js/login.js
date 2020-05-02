function login_not_found(){
	document.location.href='../index.php?error=login_not_found';
}
function correct_login(login){
	document.location.href='../main/main.php?login=' + login;
}
function error_pass(){
	document.location.href='../index.php?error=error_pass';	
}