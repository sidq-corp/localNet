function init(){
	blur_setup()
}
// Blur
var oks = new Map();
oks.set("user_pass", 0).set("user_login", 0);
let standingby = 0

function blur_setup(){
	document.getElementById("user_pass").addEventListener("focus", () => check_focus("user_pass"), true);
	document.getElementById("user_pass").addEventListener("blur", () => check_blur("user_pass"), true);

	document.getElementById("user_login").addEventListener("focus", () => check_focus("user_login"), true);
	document.getElementById("user_login").addEventListener("blur", () => check_blur("user_login"), true);
}

function check_focus(elem){
	document.getElementById(elem).style.opacity = '0.7';
	standingby = 0
}
function check_blur(elem){
	str = document.getElementById(elem).value
	if (str.length >= 6) {
		oks.set(elem, 1);
		check_all_oks()
	}else{
		oks.set(elem, 0);
		check_all_oks()
	}
}	
function check_all_oks(){
	for (var [key, value] of oks) {
		if (value == 0){
			document.getElementById('check').style.opacity = '0.7';
			standingby = 0
			return
		}
	}
	console.log('ok')
	document.getElementById('check').style.opacity = '1';
	standingby = 1
}





function logo_drop(){
	console.log('los')
	sdrop(document.getElementById('logo'));
	setTimeout(logo_drop_f2,1000)
}	
function logo_drop_f2(){
	// document.getElementById('logo').style.transtion = "transform 3s linear"
	// document.getElementById('logo').style.transform = "translateY(500%)"
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