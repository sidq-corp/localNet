function __init__(){
	console.log('__init__')
}
var links = ['../games/2048/index.html', '../games/AlienInvasion/index.html', 'audio.php'];
function link(arg){
	window.location.href = links[arg]
}

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}