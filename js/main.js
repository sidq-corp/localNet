<<<<<<< HEAD
function initjs(){
	center_button_text()
}
function center_button_text(){
	elems = document.getElementsByClassName('header-item')
	for (var i = 0; i < elems.length; i++) {
		h1 = document.getElementsByClassName('header-picker')[i].clientHeight
		h2 = elems[i].clientHeight
		h = h2 - h1
		h = h / 2
		h = h +'px'

		document.getElementsByClassName('header-picker')[i].style.marginTop = h
	}
}
=======
>>>>>>> 179b7b163088f59af5976412b3564b9af5e27a2f
function error(){
	document.location.href='../index.php';
}