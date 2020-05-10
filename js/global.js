function global_init(){
	header_insert()
	gui_insert()
	center_button_text()
	player_update()
	show_hidden_on_start()
	document.getElementById('loading-wrapper').style.visibility = 'invisible'
	document.getElementById('loading-wrapper').style.opacity = '0'
	setTimeout("document.getElementById('loading-wrapper').style.display = 'none'",500) 
	// alert(getCookie('lox'))
}
function show_hidden_on_start(){
	// class = 'hidden-on-start'
	elems = document.getElementsByClassName('hidden-on-start')
	for (var i = 0; i < elems.length; i++) {
		elems[i].style.display = 'block'
	}
}	
function center_button_text(){
	elems = document.getElementsByClassName('header-item')
	for (var i = 0; i < elems.length; i++) {
		h1 = document.getElementsByClassName('header-picker')[i].clientHeight
		h2 = elems[i].clientHeight
		h = h2 - h1
		h = h / 2
		h = h +'px'

		document.getElementsByClassName('header-picker')[i].style.marginTop = h
	}
	elems = document.getElementsByClassName('header-item-p')
	for (var i = 0; i < elems.length; i++) {
		h = elems[i].clientHeight
		h = h / 2
		h = h +'px'
		document.getElementsByClassName('header-picker-p')[i].style.marginTop = h
	}
}

phone_menu_open = 0
function phone_switch_menu(){
	if (phone_menu_open == 0){
		phone_show_menu()
		phone_menu_open = 1
	}else if(phone_menu_open == 1){
		phone_hide_menu()
		phone_menu_open = 0
	}
}
function phone_show_menu(){
	document.getElementById('phone-header-menu').style.top = '0%';
	document.getElementById('phone-i-rotate').style.transform = 'rotate(180deg)';
}
function phone_hide_menu(){
	document.getElementById('phone-header-menu').style.top = '-54%';
	document.getElementById('phone-i-rotate').style.transform = 'rotate(360deg)';
}


// Error
function display_error(arg1,arg2){
	msg = '<br><p>'
	document.getElementById('error_div').style.backgroundColor = 'rgba(245, 70, 12, 0.7)';

	if (arg1){
		msg = msg + ''+arg1+''
	}
	if (arg2 == 1){
		document.getElementById('error_div').style.backgroundColor = 'rgba(31, 173, 34, 0.7)';
	}else if (arg2){
		msg = msg + ' '+arg2+''
	}
	msg = msg + '</p><br>	'
	document.getElementById('error_div').innerHTML = msg;
	document.getElementById('error_div').style.opacity = '1';
	document.getElementById('error_div').style.transform = 'translateX(0px)';

	setTimeout(dismiss_error, 5000)
}
function dismiss_error(){
	document.getElementById('error_div').style.opacity = '0';
	document.getElementById('error_div').style.transform = 'translateX(-30px)';
}
// Gui
gui_account_opened = 0;
function gui_account_check(){
	if (gui_account_opened == 0){
		document.getElementById('header-login').style.backgroundColor = "#333"
		document.getElementById('header-login').style.color = "#fff"
		gui_account_opened = 1
		gui_account_open()
	}else if(gui_account_opened == 1){
		document.getElementById('header-login').style.backgroundColor = "#f8f8f8"
		document.getElementById('header-login').style.color = "#000"
		gui_account_opened = 0
		gui_account_close()
	}else{
		display_error('Ошибка. Код ошибки: gui_account_open != (1 or 0)');
	}
}
function gui_account_open(){
	document.getElementById('gui-bg').style.display = "block"
	document.getElementById('gui-account').style.display = "block"
}
function gui_account_close(){
	document.getElementById('gui-bg').style.display = "none"
	document.getElementById('gui-account').style.display = "none"
}

// Player
function player_add_audio(file,name,author){
	document.cookie = "current_audio_path="+file+";path=/;"
	document.cookie = "current_audio_name="+name+";path=/;"
	document.cookie = "current_audio_author="+author+";path=/;"
	document.cookie = "current_audio_time=0;path=/;"
	document.cookie = "current_audio_pause=0;path=/;"
	// alert(document.cookie)
	player_update()
}	
let audio_playing = 0
function player_update(){
	file = getCookie('current_audio_path')
	pathhtml = location.pathname.split('?')
	pre_audio = ''
	if ((pathhtml[0] != '/main/main.php') || (pathhtml[0] != '/veronika/veronika.php')){
		pre_audio = '../php/'
	}

	
	document.getElementById('player').innerHTML = `
		<h1>${getCookie('current_audio_name')} <b>by ${getCookie('current_audio_author')}</b></h1>
		<div id = 'player-wrap'>
			<audio id="player-object" src="${pre_audio}audio/${getCookie('current_audio_path')}"></audio>
			<a onclick='player_switch_audio()' id='player-button-object'>Стоп</a>
		</div>
	`
	if (getCookie('current_audio_pause') == 0){
		audio_playing = 0
		document.getElementById('player-object').play()
		document.getElementById('player-button-object').innerHTML = 'Пауза'
		
	}else if (getCookie('current_audio_pause') == 1){
		audio_playing = 1
		document.getElementById('player-object').pause()
		document.getElementById('player-button-object').innerHTML = 'Играть'
	}

	// if (getCookie('current_audio_time') != 'undefined'){
		// alert(getCookie('current_audio_time'))
	time = getCookie('current_audio_time')
	// alert(time)
	// alert(time)
	document.getElementById('player-object').currentTime = time;
	// alert(document.getElementById('player-object').currentTime)
	// }
	player_loop()
}

function player_loop(){
	setTimeout(function() { 
		display_error(document.getElementById('player-object').currentTime)
		// document.cookie = "current_audio_time="+document.getElementById('player-object').currentTime+";path=/;"
		// display_error(getCookie('current_audio_time'))
		if (audio_playing == 0){
			player_loop()
			// display_error(getCookie('current_audio_time'))
		}
	}, 1000)
}

function player_switch_audio(){
	if (audio_playing == 0){
		audio_playing = 1
		document.getElementById('player-object').pause()
		document.getElementById('player-button-object').innerHTML = 'Играть'
		document.cookie = "current_audio_pause=1;path=/;"
		
	}else if (audio_playing == 1){
		audio_playing = 0
		time = getCookie('current_audio_time')
		document.getElementById('player-object').startTime = time;
		document.getElementById('player-object').play()
		document.getElementById('player-object').startTime = time;
		document.getElementById('player-button-object').innerHTML = 'Пауза'
		document.cookie = "current_audio_pause=0;path=/;"
		player_loop()	
	}
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}


function header_insert(){
	document.getElementById('header').innerHTML = header
	path = location.pathname.split('?')
	if (path[0] != '/main/main.php'){
		document.getElementById('article-tp-to-chat').style.display = 'none'
	}
}
function gui_insert(){
	existing = document.getElementById('gui-container').innerHTML
	newhtml = gui + existing + gui2
	document.getElementById('gui-container').innerHTML = newhtml

}
gui = `	<div id="gui-bg" onclick="gui_account_check()"></div>
		<div id="gui-account" class = 'gui' style = "display: none;">
			<div class="gui_title">
				Аккаунт
			</div>

			<div class = "generic_form">
				<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">`
					
gui2 = `		</div>

				<button onclick="gui_account_check()" class="gui-but gui-but-small">Вернуться</button>
				<div id="help_div" style = "margin-top: 3%;">
					<a href='/'><p>Выйти</p></a>
				</div>
			</div>
		</div>`

header =`<div id = "header-placeholder">
			<div style = "display: none;">
				<p id = "cepochka">30%</p>
			</div>
		</div>
		<div id = "phone-header-menu">
			<div id = "phone-header-top">
				<a href="../veronika/veronika.php">
					<div class = "phone-header-top-item">
						<!-- <b>[</b>NEW<b>]</b> --> Вероника
					</div>
				</a>
				
				<div class = "phone-header-top-item ">
					Медиа
				</div>
				<a href="../php/games.php">
					<div class = "phone-header-top-item">
						Залипалки
					</div>
				</a>
				<a href="../php/about.php">
					<div class = "phone-header-top-item">
						О проэкте
					</div>
				</a>
				<div class = "phone-header-top-item" id = "header-login" onclick = "phone_switch_menu(); gui_account_check();">
					<!-- <div class = "header-picker">Никнейм: <?php echo $name; ?>,<br> Логин: <?php echo $login; ?></div> -->
					Аккаунт
				</div>
			</div>
			<div id = "phone-header-bot">
				<!-- ?login=<?php echo $login; ?> -->
				<a href="/main/main.php"><div id = "header-logo"></div></a>
				<div class = "header-item header-item-a" onclick = "phone_switch_menu()">
					<div class = "header-picker">
						Меню <i id = "phone-i-rotate" style = "transform: skewX(-12deg) rotate(0deg); transition: all 1s ease;" class="fas fa-caret-down"></i>
					</div>
					
				</div>
				<a href = "#global_chat" id = "article-tp-to-chat">
					<div class = "header-item header-item-a" style = "margin-right: 3%;">
						<div class = "header-picker">
							Чаты <i id = "phone-i-rotate" style = "transform: skewX(-12deg) rotate(0deg); transition: all 1s ease; margin-left: 6.6px;" class="fas fa-caret-down"></i>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div id = "header-menu">
			<!-- <div id = "header-items"> -->
				<a href="/main/main.php"><div id = "header-logo"></div></a>
				<a href="../veronika/veronika.php">
					<div class = "header-item header-item-a">
						<div class = "header-picker">
							Вероника
						</div>
					</div>
				</a>
				<div class = "header-item header-item-a" onclick = "display_error('Недоступно (')"><div class = "header-picker">Медиа</div></div>
				<a href="../php/games.php">
					<div class = "header-item header-item-a">
						<div class = "header-picker">
							Залипалки
						</div>
					</div>
				</a>
				<a href="../php/about.php">
					<div class = "header-item header-item-a">
						<div class = "header-picker">
							О проэкте
						</div>
					</div>
				</a>
				<div class = "header-item header-item-a" id = "header-login" onclick = "gui_account_check()">
				<!-- <div class = "header-picker">Никнейм: <?php echo $name; ?>,<br> Логин: <?php echo $login; ?></div> -->
					<div class = "header-picker">Аккаунт</div>
				</div>
			<!-- </div> -->
		</div>
		<div id = 'player'>
			<h1>Жопа коня <b>by sidq</b></h1>
			<div id = 'player-wrap'>
				<a onclick='player_stop_audio()'>Стоп</a>
			</div>
		</div>
	</div>	`