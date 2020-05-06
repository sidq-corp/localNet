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
