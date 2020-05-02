function local_handler(){
	name = document.getElementById("user_name").innerHTML;
    login = document.getElementById("user_login").innerHTML;
	mess = document.getElementById("messloc").value;
	to = document.getElementById("goto").value;
	console.log(mess);
	me = login + '(' + name + ')';
	$.ajax({

                type: "GET",
                url: "../php/local_chat_handler.php",
                data: {"me" : me, "to" : to, "mess" : mess},
                success: function(data){
                    title = data;
                    console.log(title)

                }
            });
}


