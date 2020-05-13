function __init__(){
	console.log('__init__')
}
function show_changelog(){
	document.getElementById('changelog-open').innerHTML = 'Changelog / История изменений: <a  onclick="close_changelog()" >закрыть</a>';
	document.getElementById('changelog').style.display = 'block';
}
function close_changelog(){
	document.getElementById('changelog-open').innerHTML = 'Changelog / История изменений: <a  onclick="show_changelog()" >открыть</a>';
	document.getElementById('changelog').style.display = 'none';
}