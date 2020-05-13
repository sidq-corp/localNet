function init(){
	// cookie_check()
	// center_form()
	input_setup()
	blur_setup()
}
function input_setup(){
	check_blur_log("user_pass")
	check_blur_log("user_login")
	check_blur_reg("reg_pass")
	check_blur_reg("reg_login")
	check_blur_reg("reg_name")
}
// function center_form(){
// 	per = Math.floor(( 100 - document.getElementById('wrapper').offsetHeight / screen.height * 100) /2.5)
// 	alert(per+'% !important')
// 	per = per+'%'
// 	// alert(document.getElementById('wrapper').style.top)
// 	document.getElementById('wrapper').style.top = per;
// }
// Cookie
/*function cookie_check(){
	ck = getCookie("err")
	document.cookie = "user=PIDORS"
	// alert(document.cookie)
	if (ck == 'login_not_found'){
		alert('Нет логина')
	}
}*/
// Blur
var oks = new Map();
oks.set("user_pass", 0).set("user_login", 0);
let standingby = 0

var oks_reg = new Map();
oks_reg.set("reg_pass", 0).set("reg_login", 0).set("reg_name", 0);

function blur_setup(){
	document.getElementById("user_pass").addEventListener("focus", () => check_focus("user_pass"), true);
	document.getElementById("user_pass").addEventListener("blur", () => check_blur_log("user_pass"), true);
	document.getElementById("user_pass").addEventListener("input", () => check_blur_log("user_pass"), true);

	document.getElementById("user_login").addEventListener("focus", () => check_focus("user_login"), true);
	document.getElementById("user_login").addEventListener("blur", () => check_blur_log("user_login"), true);
	document.getElementById("user_login").addEventListener("input", () => check_blur_log("user_login"), true);

	document.getElementById("reg_pass").addEventListener("focus", () => check_focus("reg_pass"), true);
	document.getElementById("reg_pass").addEventListener("blur", () => check_blur_reg("reg_pass"), true);
	document.getElementById("reg_pass").addEventListener("input", () => check_blur_reg("reg_pass"), true);

	document.getElementById("reg_login").addEventListener("focus", () => check_focus("reg_login"), true);
	document.getElementById("reg_login").addEventListener("blur", () => check_blur_reg("reg_login"), true);
	document.getElementById("reg_login").addEventListener("input", () => check_blur_reg("reg_login"), true);

	document.getElementById("reg_name").addEventListener("focus", () => check_focus("reg_name"), true);
	document.getElementById("reg_name").addEventListener("blur", () => check_blur_reg("reg_name"), true);
	document.getElementById("reg_name").addEventListener("input", () => check_blur_reg("reg_name"), true);
}

function check_focus(elem){
	// document.getElementById('fake_check_log').style.opacity = '0.5';
	// document.getElementById('check_log').style.display = 'none';
	// document.getElementById('check_log').style.opacity = '0.5';
	// document.getElementById('fake_check_log').style.display = 'block';

	// document.getElementById('fake_check_reg').style.opacity = '0.5';
	// document.getElementById('check_reg').style.display = 'none';
	// document.getElementById('check_reg').style.opacity = '0.5';
	// document.getElementById('fake_check_reg').style.display = 'block';
	standingby = 0
}
function check_blur_log(elem){
	str = document.getElementById(elem).value
	if (str.length >= 6) {
		oks.set(elem, 1);
		check_all_oks_log()
	}else{
		oks.set(elem, 0);
		check_all_oks_log()
	}
}	
function check_all_oks_log(){
	for (var [key, value] of oks) {
		if (value == 0){
			document.getElementById('fake_check_log').style.opacity = '0.5';
			document.getElementById('check_log').style.display = 'none';
			document.getElementById('check_log').style.opacity = '0.5';
			document.getElementById('fake_check_log').style.display = 'block';
			standingby = 0
			return
		}
	}
	console.log('ok')
	document.getElementById('fake_check_log').style.opacity = '1';
	document.getElementById('check_log').style.display = 'block';
	document.getElementById('check_log').style.opacity = '1';
	document.getElementById('fake_check_log').style.display = 'none';
	standingby = 1
}
function check_blur_reg(elem){
	str = document.getElementById(elem).value
	if (((str.length >= 6) || ((elem == 'reg_name') && (str.length >= 3))) && (str.search(':') == -1)) {
		oks_reg.set(elem, 1);
		check_all_oks_reg()
	}else{
		oks_reg.set(elem, 0);
		check_all_oks_reg()
	}
}	
function check_all_oks_reg(){
	for (var [key, value] of oks_reg) {
		if (value == 0){
			document.getElementById('fake_check_reg').style.opacity = '0.5';
			document.getElementById('check_reg').style.display = 'none';
			document.getElementById('check_reg').style.opacity = '0.5';
			document.getElementById('fake_check_reg').style.display = 'block';
			standingby = 0
			return
		}
	}
	console.log('ok')
	document.getElementById('fake_check_reg').style.opacity = '1';
	document.getElementById('check_reg').style.display = 'block';
	document.getElementById('check_reg').style.opacity = '1';
	document.getElementById('fake_check_reg').style.display = 'none';
}

// Display errors
function display_error(arg1,arg2){
	msg = '<br><p>'
	document.getElementById('error_div').style.backgroundColor = 'rgba(245, 70, 12, 0.7)';

	if (arg1){
		msg = msg + ''+arg1+''
	}
	if (arg2 == 1){
		document.getElementById('error_div').style.backgroundColor = 'rgba(31, 173, 34, 0.7)';
	}else if (arg2){
		msg = msg + ' '+arg2+''
	}
	msg = msg + '</p><br>	'
	document.getElementById('error_div').innerHTML = msg;
	document.getElementById('error_div').style.opacity = '1';
	document.getElementById('error_div').style.transform = 'translateX(0px)';
}
function dismiss_error(){
	document.getElementById('error_div').style.opacity = '0';
	document.getElementById('error_div').style.transform = 'translateX(-30px)';
}
function throw_error_by_id(arg){
	console.log('losj '+arg)
	if (arg == 'error_pass'){
		setTimeout(display_error,50,'Пароль неверный!','Вы хакер!?')
	}else if (arg == 'login_not_found'){
		setTimeout(display_error,50,'Такого логина нет!')
	}else if (arg == 'no_error'){
		setTimeout(display_error,50,'Вы успешно зарегистрировались!<br> p.s.: пробелы в конце удаляются',1)
	}else if (arg=='reg_error'){
		setTimeout(display_error,50,'Вы не зарегистрировались.','Скорее всего ваш логин занят')
	}
}
// Login - Register link
function show_reg_form(){
	dismiss_error()	
	document.getElementById('login').style.display = 'none';
	document.getElementById('registr').style.display = 'block';
}
function show_log_form(){
	dismiss_error()	
	document.getElementById('login').style.display = 'block';
	document.getElementById('registr').style.display = 'none';
}

// Animations
function logo_drop(){
	console.log('los')
	sdrop(document.getElementById('logo'));
}	

function shake(elem) {
	elem.classList.add("apply-shake");
	elem.addEventListener("animationend", (e) => {
	    elem.classList.remove("apply-shake");
	});
}
function sdrop(elem) {
	elem.classList.add("apply-drop");
	elem.addEventListener("animationend", (e) => {
	    elem.classList.add("apply-drop-end");
	});
}

// SHIT
function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}