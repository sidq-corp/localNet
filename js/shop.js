function __init__(){
	build_wrapper_color()
}

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

class item{
	constructor(name,price,color) {
		this.name = name;
		this.price = price;
		this.color = color;
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
// let user = new item("Вася");
let items_colors = [new item('Золотой',15,'#fcba03'),new item('Лазуритовый',10,'#0c7ef7'),new item('Призмариновый',10,'#32a89d'),new item('Аркадий',10,'#36bf17'),
new item('Коралловый',10,'#FF6F61'), new item('Удар лайма', 15, '#D6ED17FF')]

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
		}
		obj = array[index]
		buy_gui_build(obj.get_name(),obj.get_price(),obj.get_color(),index)

		buy_gui_open()
	}
}
function buy_color_to(id){
	$.ajax({

                type: "POST",
                url: "../php/shop_handler.php",
                data: {"id" : id},
                success: function(data){
                    title = data;
                    console.log(title)

                }
            });
}
function buy_gui_build(name,price,color,id){
	buy_gui_html = `	
			<div id="gui-buy" class = 'gui'>
				<div class="gui_title">
					Покупка
				</div>

				<div class = "generic_form">
					<div id="help_div" style = "margin-top: 3%; margin-bottom: 17%">
						<b>Вы действительно хотите купить <strong style='color: ${color};'>${name}</strong> за ${price} <i class="fas fa-coins"></i> ?</b>
					</div>

					<button onclick="buy_color_to(${id})" class="gui-but gui-but-small">Да</button>
					<div id="help_div" style = "margin-top: 3%;">
						<a onclick="close_gui()"><p>Вернуться</p></a>
					</div>
				</div>
			</div>`

	document.getElementById('gui-shop-container').innerHTML = buy_gui_html
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