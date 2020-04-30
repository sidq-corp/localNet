function login_not_found(){
	document.location.href='../index.php';
}
function correct_login(sk, login, id){
	document.location.href='../main/main.php?secret=' + sk + '&login=' + login + '&id=' + id;
}
function error_pass(){
	document.location.href='../index.php';
	
}