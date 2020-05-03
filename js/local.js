let cepochka;
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
}
function start_c(){
	cepochka = true;
	update();
}
function update(){
	name = document.getElementById("user_name").innerHTML;
    login = document.getElementById("user_login").innerHTML;
	to = document.getElementById("goto").value;
	me = login + '(' + name + ')';
	get_file("../php/messlog/localchat/" + me + "-" + to + '.log');
	get_file("../php/messlog/localchat/" + to + "-" + me + '.log');
	if(cepochka){
		setTimeout(update, 1500);
	}
}