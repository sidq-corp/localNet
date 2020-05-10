
function insert_players(jsstring){
	console.log(jsstring)
	// arr = JSON.parse(jsstring)
	// for (var i = 0; i < arr.length; i++) {
	// 	// arr[i]
	// 	document.getElementById('audio-container').innerHTML = container
	// }

	container = ''
	for (var i = 0; i < jsstring.length; i++) {
		container = container + `   
		<p>${jsstring[i][2]} - ${jsstring[i][1]}</p>
		<audio controls>
			<source src="audio/${jsstring[i][0]}" type="audio/mpeg">
			Тег audio не поддерживается вашим браузером. 
			<a href="audio/${jsstring[i][0]}">Скачайте музыку</a>.
		</audio>`;
		
	}
	document.getElementById('wrapper').innerHTML = container
}

