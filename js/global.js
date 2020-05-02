function global_init(){
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