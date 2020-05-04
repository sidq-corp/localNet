function init_main_js(){
	lchat_check()
	center_article_text()
}
function center_article_text(){
	elems = document.getElementsByClassName('article')
	msg=''
	for (var i = 0; i < elems.length; i++) {
		h1 = document.getElementsByClassName('article-picker')[i].offsetHeight
		h2 = elems[i].offsetHeight
		msg = msg+'block='+h1+' text='+h2+'\n'
		h = h2 - h1
		h = h / 2
		h = h +'px'

		document.getElementsByClassName('article-picker')[i].style.marginTop = h
	}
	alert(msg)
}

function error(){
	document.location.href='../index.php';
}
// Article
// function article_watch(i){
// 	document.getElementsByClassName('article-watch')[i].style.width = '20%'
// 	document.getElementsByClassName('article-watch')[i].style.color = 'red'
// }
// Gchat
shown = 0
function check_gchat_if_disabled(){
	function back_gchat_but(){
		document.getElementById('glb').style.opacity = '1'
	}
	document.getElementById('glb').style.opacity = '0.5'
	setTimeout(back_gchat_but, 3000)
	if (shown == 0){
		function set_gchat_text(){
			document.getElementById('help_div').innerHTML = html
		}
		var but = document.getElementById('glb');
		html = "<b>Tip: Кнопка блокируется на 3 секунды</b><br><b>после отправки сообщения</b>"
		shown = 1
		setTimeout(set_gchat_text, 1000)
	}
}

gchat_shown = 1
lchat_shown = 1
function gchat_check(){
	if (gchat_shown == 1){
		chat_hide(0, 'global_chat', 'gchat-hide')
		gchat_shown = 0
	}else if (gchat_shown == 0){
		chat_show(0, 'global_chat', 'gchat-hide', '70%')
		chat_hide(1, 'local_chat', 'lchat-hide')
		gchat_shown = 1
		lchat_shown = 0
		// alert('show')
	}else{
		display_error('Ошибка. Код ошибки: gchat_shown != (1 or 0)');
	}
}
function lchat_check(){
	if (lchat_shown == 1){
		chat_hide(1, 'local_chat', 'lchat-hide')
		lchat_shown = 0
	}else if (lchat_shown == 0){
		hght = document.getElementById('cepochka').innerHTML
		chat_show(1, 'local_chat', 'lchat-hide', hght)
		chat_hide(0, 'global_chat', 'gchat-hide')
		lchat_shown = 1
		gchat_shown = 0
		// alert('show')
	}else{
		display_error('Ошибка. Код ошибки: lchat_shown != (1 or 0)');
	}
}
function chat_hide(tit_id, c_handl, hide_hanl){
	document.getElementById(hide_hanl).style.display = 'none'
	document.getElementById(c_handl).style.height = 'auto'
	document.getElementsByClassName('gchat-title')[tit_id].style.lineHeight = '400%'
}
function chat_show(tit_id, c_handl, hide_hanl, hei){
	document.getElementById(hide_hanl).style.display = 'block'
	document.getElementById(c_handl).style.height = hei
	document.getElementsByClassName('gchat-title')[tit_id].style.lineHeight = '100%'
}

// Gui
gui_account_opened = 0;
function gui_account_check(){
	if (gui_account_opened == 0){
		document.getElementById('header-login').style.backgroundColor = "#333"
		document.getElementById('header-login').style.color = "#fff"
		gui_account_opened = 1
		gui_account_open()
	}else if(gui_account_opened == 1){
		document.getElementById('header-login').style.backgroundColor = "#f8f8f8"
		document.getElementById('header-login').style.color = "#000"
		gui_account_opened = 0
		gui_account_close()
	}else{
		display_error('Ошибка. Код ошибки: gui_account_open != (1 or 0)');
	}
}
function gui_account_open(){
	document.getElementById('gui-bg').style.display = "block"
	document.getElementById('gui-account').style.display = "block"
}
function gui_account_close(){
	document.getElementById('gui-bg').style.display = "none"
	document.getElementById('gui-account').style.display = "none"
}

// Generic errors
// Display errors