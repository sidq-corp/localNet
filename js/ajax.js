function init(){
    document.getElementById("goto").addEventListener("input", () => check_local(), true);
    reader();
}
function check_local(){
    name = document.getElementById("user_name").innerHTML;
    to = document.getElementById("user_login").innerHTML;

}
function ginputgo(){
    document.getElementById('glb').disabled = 0;
    document.getElementById('glb').value = "Отправить";


}

$( document ).ready(function() {
    $("#glb").click(
		function(){
            name = document.getElementById("user_name").innerHTML;
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
        	$('#result_form').html(result);
    	},
    	error: function(response) { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}

function reader(){
    var request = new XMLHttpRequest;

    request.open('GET', '/php/messlog/globalchat.log', true);

    request.onload = function () {
        console.log(request.responseText);
                document.getElementById('result_form').innerHTML = request.responseText;
    };

    request.send(null);
    setTimeout(reader, 1500);
    
}