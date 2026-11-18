var scrollSpeed = 100;
var current = 0;
var direction = 'h';
function bgscroll(){
	current -= 1;
	$('div.clouds').css("backgroundPosition", (direction == 'h') ? current+"px 0" : "0 " + current+"px");
}
setInterval("bgscroll()", scrollSpeed);	