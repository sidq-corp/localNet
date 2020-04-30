function init(){
	document.getElementById("password").addEventListener("focus", () => check_focus_password(), true);
	document.getElementById("password").addEventListener("blur", () => check_blur_password(), true);
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