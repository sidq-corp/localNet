
function insert_players(jsstring){
	 // alert(getCookie('lox'))
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
			<audio src="audio/${jsstring[i][0]}" controls>
				<!-- <source src="audio/${jsstring[i][0]}" type="audio/mpeg"> -->
				Тег audio не поддерживается вашим браузером. 
				<a href="audio/${jsstring[i][0]}">Скачайте музыку</a>.
			</audio>`;
		// container = container + `
		// <p>${jsstring[i][2]} - ${jsstring[i][1]}</p>
		// <button onclick="player_add_audio('${jsstring[i][0]}','${jsstring[i][2]}','${jsstring[i][1]}')">Воспроизвести</button>
		// `
		
	}
	document.getElementById('wrapper').innerHTML = container
}

