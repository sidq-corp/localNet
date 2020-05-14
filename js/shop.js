// 
// [1] Инициализация
// 
function __init__(){
	build_wrapper_color()
	build_wrapper_nameplate()
	pick_col_and_pref()
	buy_gui_build('none',10000,'none',-1)
	buy_gui_close()
}


//* nameplate == np == prefix

// 
// [2] Хаб
// 
wrappers = ['wrapper-base','wrapper-color','wrapper-prefix']
function switch_wrapper(arg){
	for (var i = 0; i < wrappers.length; i++) {
		if (arg == wrappers[i]){
			document.getElementById(arg).style.display = 'block';
		}else{
			document.getElementById(wrappers[i]).style.display = 'none';
		}
	}
}

// 
// [3] Массивы
// 
class item{
	constructor(name,price,color,np) {
		this.name = name;
		this.price = price;
		this.color = color;
		this.np = np;
	}
	get_name() {
		return this.name;
	}
	get_price() {
		return this.price;
	}

	get_color() {
		return this.color;
	}

}
// let user = new ite
let items_colors = [new item('Золотой',15,'#fcba03'),new item('Лазуритовый',10,'#0c7ef7'),new item('Призмариновый',10,'#32a89d'),new item('Аркадий',10,'#36bf17'),
new item('Коралловый',10,'#FF6F61'), new item('Хорусовый', 15, '#8a43cc')]

let items_np = [new item('Орден ТКК',10,'#fcba03','<i class="fas fa-toilet-paper"></i>'),
				new item('Орден ПСР',20,'#eb8034','<i class="fas fa-compass"></i>'),
				new item('Нашивка COVID',50,'#cc4343','<i class="fas fa-virus"></i>'),
				new item('Офицер',10,'#fcba03','<i class="fas fa-angle-up"></i>'),
				new item('Генерал',20,'#eb8034','<i class="fas fa-angle-double-up"></i>'), 
				new item('Фельдмаршалл', 50, '#cc4343','<i class="fas fa-star"></i>')
				]

// 
// [4] Gui покупки
// 
buy_gui_opened = 0
function buy_gui(arg){
	gui_account_close()
	if (buy_gui_opened){
		buy_gui_close()
	}else{
		arg = arg.split('_')
		index = parseInt(arg[1])
		if (arg[0]=='c'){
			array = items_colors
		}else if(arg[0]=='n'){
			array = items_np
		}
		obj = array[index]
		buy_gui_build(obj.get_name(),obj.get_price(),obj.get_color(),index,arg[0])

		buy_gui_open()
	}
}
function buy_gui_build(name,price,color,id,arg){
	ex_inner =''
	if (arg=='c'){
		ico = visual_prefix
		ico = ico.substring(0,2) +` style="color: ${color}" `+ ico.substring(3)
		ex_inner = `
			<div id='local_chat'>
				<div class="chat-my-header" style="color: ${color} !important;">${ico} ${getCookie('name')}</div><br>
            	<div class="chat-my-msg" style="border-left: 3px ${color} solid">Я ахуенный/ая</div><br>
			</div>
		`
	}else if(arg=='n'){
		ico = items_np[id].np
		ico = ico.substring(0,2) +` style="color: ${visual_color}" `+ ico.substring(3)
		ex_inner = `
			<div id='local_chat'>
				<div class="chat-my-header" style="color: ${visual_color}">${ico} ${getCookie('name')}</div><br>
            	<div class="chat-my-msg" style="border-left: 3px ${visual_color} solid">Я соска</div><br>
			</div>
		`
	}
	buy_gui_html = `	
			<div id="gui-buy" class = 'gui'>
				<div class="gui_title">
					Покупка
				</div>

				<div class = "generic_form" id='gui-buy-edit'>
					<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
						<b>В чате это будет смотрется так:</b>
							${ex_inner}
						<br>
						<b>Вы действительно хотите купить <strong style='color: ${color};'>${name}</strong> за ${price} <i class="fas fa-coins"></i> ?</b>
					</div>

					<button onclick="check_item(${id},'${arg}')" class="gui-but gui-but-small">Да</button>
					<div id="help_div" style = "margin-top: 3%;">
						<a onclick="close_gui()"><p>Вернуться</p></a>
					</div>
				</div>
			</div>`

	document.getElementById('gui-shop-container').innerHTML = buy_gui_html
}
function buy_gui_edit(text){
	document.getElementById('gui-buy-edit').innerHTML = text
}
function buy_gui_open(){
	document.getElementById('gui-bg').style.display = "block"
	document.getElementById('gui-buy').style.display = 'block'
	buy_gui_opened = 1
}
function buy_gui_close(){
	document.getElementById('gui-buy').style.display = 'none'
	buy_gui_opened = 0
}

// 
// [5] Покупка
// 
function check_item(id,arg){
	buy_edit_response('load')
	if (arg=='c'){
		buy_call_to_php("../php/color_handler.php",id,arg)
	}else if(arg=='n'){
		buy_call_to_php("../php/prefix_handler.php",id,arg)
	}
}
function buy_call_to_php(path,id,arg){
	$.ajax({
        type: "POST",
        url: path,
        data: {"id" : id},
        success: function(data){
        	buy_edit_response(data)
        	buy_edit_visual(data,[arg,id])
        }
    });
}
function buy_edit_response(data){
	title = data.replace('"','').replace('"','')
	console.log(title)
    if (title == 'good'){
    	buy_gui_edit(`
			<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
				<b>Покупка успешна. Вы молодец.</b>
			</div>
			<div id="help_div">
				<a onclick="close_gui()"><p>Ок</p></a>
			</div>`)
    }else if (title == 'load'){
    	buy_gui_edit(`
			<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
				<b>Обработка...</b>
			</div>`)
    }
    else if (title == 'false'){
    	buy_gui_edit(`
			<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
				<b>Вы не купили! Скорее всего у вас не хватает монет.</b>
			</div>
			<div id="help_div">
				<a onclick="close_gui()"><p>Вернуться</p></a>
			</div>`)
    }else{
    	buy_gui_edit(`
			<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
				<b>Непредвиденный ответ! Сообщите @depozzyx или @sidq! Ответ:</b>
				<div style='font-family: sans-serif;padding: 10px;padding-top: 0.5px;background-color: #f3f3f3;color: #333;'>${data}</div>
			</div>
			<div id="help_div">
				<a onclick="close_gui()"><p>Вернуться</p></a>
			</div>`)
    }
}
function buy_edit_visual(data,args){
	title = data.replace('"','').replace('"','')
    if (title == 'good'){
		if (arg[0]=='c'){
			visual_color = items_colors[arg[1]].color
		}else if(arg[0]=='n'){
			visual_prefix = items_np[arg[1]].np
		}
	}
}

// 
// [6] Функции __init__
// 
visual_color = '#333'
visual_prefix = ''
function pick_col_and_pref(){
	visual_color = document.getElementById('user_color').innerHTML
	visual_prefix = document.getElementById('user_prefix').innerHTML
}

function build_wrapper_color(){
	inner = ''
	for (var i = 0; i < items_colors.length; i++) {
		obj = items_colors[i]
		inner = inner + `
			<div class = 'article article-triple' onclick="buy_gui('c_${i}')" style = 'height: 20%; background-image: none; background-color: ${obj.get_color()};'>
				<div class = 'article-content'>
					<div class = 'article-picker article-shadow'>
						<h1>${obj.get_name()}</h1>
						<p class = 'article-sub-text article-sub-money'><b>${obj.get_price()} <i class="fas fa-coins"></i></b></p>
						<br>
					</div>
				</div>
			</div>
		`
		if ((i+1) % 3 != 0){
			inner = inner + `<div class = 'article-triple-separator'><br></div>`
		}else{
			inner = inner + `<div class = 'article-one-separator'><br></div>`
		}
	}
	document.getElementById('wrapper-color-container').innerHTML = inner
}
function build_wrapper_nameplate(){
	inner = ''
	for (var i = 0; i < items_np.length; i++) {
		obj = items_np[i]
		inner = inner + `
			<div class = 'article article-triple' onclick="buy_gui('n_${i}')" style = 'height: 20%; background-image: none; background-color: ${obj.color};'>
				<div class = 'article-content'>
					<div class = 'article-picker article-shadow'>
						<h1>${obj.name}</h1>
						<h1 style ='color:${obj.color} !important'>${obj.np}</h1>
						<p class = 'article-sub-text article-sub-money'><b>${obj.price} <i class="fas fa-coins"></i></b></p>
						<br>
					</div>
				</div>
			</div>
		`
		if ((i+1) % 3 != 0){
			inner = inner + `<div class = 'article-triple-separator'><br></div>`
		}else{
			inner = inner + `<div class = 'article-one-separator'><br></div>`
		}
	}
	document.getElementById('wrapper-np-container').innerHTML = inner
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}