function login_not_found(){

}
function correct_login(sk, login, id){
	document.location.href='../main/main.php?secret=' + sk + '&login=' + login + '&id=' + id;
}
function error_pass(){
	
}