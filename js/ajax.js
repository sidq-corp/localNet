function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

let nick_color = '#333'
let nick_prefix = ''
function init(){
    arg = document.getElementById('header').innerHTML.split('<br>')
    nick_color = arg[1]
    nick_prefix = arg[3]
    document.getElementById('header').innerHTML = ''
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
            insert_chat(result)
    	},
    	error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}

function stripHtml(html){
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}

function reader(){
    var request = new XMLHttpRequest;

    request.open('GET', '/php/messlog/globalchat.log', true);

    /*request.onload = function () {
        console.log(request.responseText);
                document.getElementById('result_form').innerHTML = request.responseText;
    };*/

    request.onload = function () {
        insert_chat(request.responseText)
    };

    request.send(null);
    setTimeout(reader, 1500);
    
}

function insert_chat(respone){
    reqsplt = respone.split('<br>')
    me = getCookie('name');

    inner = ''
    lastme = ''
    for (var i = 0; i < reqsplt.length-1; i++) {
        m = reqsplt[i].split(': ')
        tempme = m[0].split('||')
        tempcolor = tempme[1]
        orgme = tempme[0]
        tempme = stripHtml(tempme[0])
        m.shift()
        message = m.join(': ')
        if ((tempme == lastme) && (tempcolor == lastcolor)){

            if (tempme == me){
                inner = inner + '<div class="chat-my-msg" style="border-left: 3px '+tempcolor+' solid">'+message+'</div><br>'
            }else{
                inner = inner + '<div class="chat-companion-msg" style="border-right: 3px '+tempcolor+' solid">'+message+'</div><br>'
            }
            // console.log(inner)
        }else{
            lastme = tempme
            lastcolor = tempcolor
            if (tempme == me){
                inner = inner + '<br><div class="chat-my-header" style="color: '+tempcolor+'">'+orgme+'</div><br>'
                inner = inner + '<div class="chat-my-msg" style="border-left: 3px '+tempcolor+' solid">'+message+'</div><br>'
            }else{
                inner = inner + '<br><div class="chat-companion-header" style="color: '+tempcolor+'">'+orgme+'</div><br>'
                inner = inner + '<div class="chat-companion-msg " style="border-right: 3px '+tempcolor+' solid">'+message+'</div><br>'
            }
            
        }

    }
    // console.log(inner)
    document.getElementById('result_form').innerHTML = inner;
}