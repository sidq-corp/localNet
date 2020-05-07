function get_answer(){
	var request = new XMLHttpRequest;

	request.open('GET', 'output.txt', true);

	request.onload = function () {
	    text = request.responseText;
	    console.log(text);
	    document.getElementById('answer').innerHTML = text;

	}
	request.send(null);
	chat()
}
function chat(){
	var request = new XMLHttpRequest;

	request.open('GET', 'chat.txt', true);

	request.onload = function () {
	    text = request.responseText;
	    console.log(text);
	    document.getElementById('chat_text').innerHTML = text;

	}
	request.send(null);
}
function start(){
	setTimeout(get_answer, 1500);
	document.getElementById('input').value = "";
}

chat_shown = 1
function chat_switch(){
	if (chat_shown == 1){
		chat_hide(2, 'bot-log', 'bot-log-hide')
		chat_shown = 0
	}else if (chat_shown == 0){
		chat_show(2, 'bot-log', 'bot-log-hide', '70%');
		chat_shown = 1
		// alert('show')
	}else{
		display_error('Ошибка. Код ошибки: gchat_shown != (1 or 0)');
	}
}

function chat_hide(tit_id, c_handl, hide_hanl){
	document.getElementById(hide_hanl).style.display = 'none'
	document.getElementById(c_handl).style.height = 'auto'
	document.getElementsByClassName('side-tab')[tit_id].style.lineHeight = '400%'
}
function chat_show(tit_id, c_handl, hide_hanl, hei){
	document.getElementById(hide_hanl).style.display = 'block'
	document.getElementById(c_handl).style.height = hei
	document.getElementsByClassName('side-tab')[tit_id].style.lineHeight = '100%'
}
