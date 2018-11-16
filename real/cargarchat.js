$(document).ready(function(){
	setInterval('cargarchat()',1000);
});

function cargarchat(consulta2){
	var us =document.getElementById("userm").value;
	var user = 'usuario=' + us; 

	$.ajax({
		type: "POST",
        url: "real/cargarchat.php",
        data: user,
        dataType:"html",
        asycn:false,
	})
	.done(function(respuesta2){
		$("#chatrt").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}