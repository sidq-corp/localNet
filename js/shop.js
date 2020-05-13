function init_games(){
	// document.cookie = "lox="+getRandomInt(100)+";path=/;"
	// console.log(document.cookie)
	// alert(getCookie('lox'))
}

wrappers = ['wrapper-base','wrapper-color','wrapper-prefix']
function switch_wrapper(arg){
	for (var i = 0; i < wrappers.length; i++) {
		if (arg == wrappers[i]){
			document.getElementById(arg).style.display = 'block';
		}else{
			document.getElementById(wrappers[i]).style.display = 'none';
		}
	}
}