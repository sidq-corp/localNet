let cepochka;
$( document ).ready(function() {
    $("#lcl").click(
		function(){
            local_handler();
			return false; 
		}
	);
});

function local_handler(){
	cepochka = true;
	name = document.getElementById("user_name").innerHTML;
    login = document.getElementById("user_login").innerHTML;
	mess = document.getElementById("messloc").value;
	to = document.getElementById("goto").value;
	me = login + '(' + name + ')';
	$.ajax({

                type: "GET",
                url: "../php/local_chat_handler.php",
                data: {"me" : me, "to" : to, "mess" : mess},
                success: function(data){
                    title = data;
                    document.getElementById("local_answer").innerHTML = title;
                    // console.log(title)

                }
            });
	document.getElementById("messloc").value = "";
	update();
}
function reader_file(url){
	var request = new XMLHttpRequest;

	request.open('GET', url, true);

	request.onload = function () {
	    // console.log(request.responseText);

	    document.getElementById("local_answer").innerHTML = request.responseText;


	};

	request.send(null);

}
function get_file(url){
	return $.get(url)
    .done(function() { 
        reader_file(url);
        return true;
    }).fail(function() { 
    	return false;
    })
}
function stop_c(){
	cepochka = false;
	document.getElementById('cepochka').innerHTML = '30%'
	document.getElementById('local_answer').innerHTML = 'Загрузка...';
	document.getElementById('lchat-start').style.display = 'block';
	document.getElementById('lchat-end').style.display = 'none';
	document.getElementById('local_chat').style.height = '30%'
}
function start_c(){
	inh = 'получатель - '+document.getElementById("goto").value
	document.getElementById('cepochka').innerHTML = '70%'
	document.getElementById('c_usr').innerHTML = inh
	document.getElementById('lchat-start').style.display = 'none';
	document.getElementById('lchat-end').style.display = 'block';
	document.getElementById('local_chat').style.height = '70%'
	cepochka = true;
	setTimeout(check_c, 1500);
	update();
}
function clean_c(){
	document.getElementById("goto").value = ''
}
function check_c(){
	if (document.getElementById('local_answer').innerHTML == 'Загрузка...') {
		document.getElementById('local_answer').innerHTML = 'Скорее всего в этой цепочке нет сообщений и вы ни разу друг другу не писали. Прояви инициативу!';
	}
	
}
function update(){
	if (cepochka == true){
		name = document.getElementById("user_name").innerHTML;
	    login = document.getElementById("user_login").innerHTML;
		to = document.getElementById("goto").value;
		me = login + '(' + name + ')';
		get_file("../php/messlog/localchat/" + me + "-" + to + '.log');
		get_file("../php/messlog/localchat/" + to + "-" + me + '.log');
		setTimeout(update, 1500);
	}
}