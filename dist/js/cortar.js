$(document).ready(function(){

	var img_full_div_top = $(".image-full-div").position().top;
	var img_full_div_left = $(".image-full-div").position().left;

	$(".herramienta").css("top", img_full_div_top + 50).css("left", img_full_div_left + 50);

});