$(function(){
	$("#map_navigation #area_btn_list li a:first").css("color","red");
	
	$("#map_navigation #area_btn_list li").mouseover(function(){
		var imageIndex = $(this).index();
		$("#map_navigation #area_btn_list li a").each(function(index){
			if(index == imageIndex){
				$(this).css("color","red");
			}else{
				$(this).css("color","#19296A");
			}
		});
		var sel = "#map_navigation #map_image ";
		if($(sel + "img:eq(" + imageIndex + "):visible:not(:animated)").length == 0){
			$(sel + "img:animated").stop();
			if($.support['opacity'] == false) {
			$(sel + "img:visible").hide();
				$(sel + "img:eq(" + imageIndex + ")").show();
			} else {
				$(sel + "img:visible").fadeOut('fast');
				$(sel + "img:eq(" + imageIndex + ")").fadeIn("fast");
			}
		}
	});
});