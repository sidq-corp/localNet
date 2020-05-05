function dir(path){
	var directory = path;
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open('GET', directory, false); // false for synchronous request
	xmlHttp.send(null);
	var ret = xmlHttp.responseText;
	var fileList = ret.split('\n');
	for (i = 0; i < fileList.length; i++) {
	    var fileinfo = fileList[i].split(' ');
	    if (fileinfo[0] == '201:') {
	        console.log(fileinfo[1] + "<br>");
	        console.log('<img src=\"' + directory + fileinfo[1] + '\"/>');
	    }
	}
}