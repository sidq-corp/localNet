function init_games(){
	// document.cookie = "lox="+getRandomInt(100)+";path=/;"
	// console.log(document.cookie)
	// alert(getCookie('lox'))
}
var links = ['../games/2048/index.html', '../games/AlienInvasion/index.html', 'audio.php'];
function link(arg){
	window.location.href = links[arg]
}

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}