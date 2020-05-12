function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function init(){
    document.getElementById("goto").addEventListener("input", () => check_local(), true);
    reader();
}
function check_local(){
    name = getCookie('name');
    to = getCookie('login');

}
function ginputgo(){
    document.getElementById('glb').disabled = 0;
    document.getElementById('glb').value = "Отправить";


}

$( document ).ready(function() {
    $("#glb").click(
		function(){
            name = getCookie('name');
			sendAjaxForm('result_form', '../php/chat_handler.php', name);
            document.getElementById('messin').value = '';
            document.getElementById('glb').disabled = 1;
            document.getElementById('glb').value = "Блокировка 3 секунды";
            setTimeout(ginputgo, 3000);
			return false; 
		}
	);
});
 
function sendAjaxForm(result_form, url, name) {
    console.log(name);
    console.log(document.getElementById('messin').value);
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: {"mess" : document.getElementById('messin').value, "name" : name},  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	result = $.parseJSON(response);
            reqsplt = result.split('<br>')
            me = getCookie('name');
            inner = ''
            lastme = ''
            for (var i = 0; i < reqsplt.length-1; i++) {
                m = reqsplt[i].split(': ')
                tempme = m[0]
                m[0] = ''
                message = m.join(' ')
                if (tempme == lastme){
                    if (tempme == me){
                        inner = inner + '<div class="chat-my-msg">'+message+'</div><br>'
                    }else{
                        inner = inner + '<div class="chat-companion-msg">'+message+'</div><br>'
                    }
                    console.log(inner)
                }else{
                    lastme = tempme
                    if (tempme == me){
                        inner = inner + '<br><div class="chat-my-header">'+tempme+'</div><br>'
                        inner = inner + '<div class="chat-my-msg">'+message+'</div><br>'
                    }else{
                        inner = inner + '<br><div class="chat-companion-header">'+tempme+'</div><br>'
                        inner = inner + '<div class="chat-companion-msg ">'+message+'</div><br>'
                    }
                    
                }

            }
        	$('#result_form').html(inner);
    	},
    	error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}

function reader(){
    var request = new XMLHttpRequest;

    request.open('GET', '/php/messlog/globalchat.log', true);

    /*request.onload = function () {
        console.log(request.responseText);
                document.getElementById('result_form').innerHTML = request.responseText;
    };*/

    request.onload = function () {
        reqsplt = request.responseText.split('<br>')
        me = getCookie('name');
        inner = ''
        lastme = ''
        for (var i = 0; i < reqsplt.length-1; i++) {
            m = reqsplt[i].split(': ')
            tempme = m[0]
            m[0] = ''
            message = m.join(' ')
            if (tempme == lastme){
                if (tempme == me){
                    inner = inner + '<div class="chat-my-msg">'+message+'</div><br>'
                }else{
                    inner = inner + '<div class="chat-companion-msg">'+message+'</div><br>'
                }
                console.log(inner)
            }else{
                lastme = tempme
                if (tempme == me){
                    inner = inner + '<br><div class="chat-my-header">'+tempme+'</div><br>'
                    inner = inner + '<div class="chat-my-msg">'+message+'</div><br>'
                }else{
                    inner = inner + '<br><div class="chat-companion-header">'+tempme+'</div><br>'
                    inner = inner + '<div class="chat-companion-msg ">'+message+'</div><br>'
                }
                
            }

        }
        console.log(inner)
        document.getElementById('result_form').innerHTML = inner;   
    };

    request.send(null);
    setTimeout(reader, 1500);
    
}