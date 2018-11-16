$(document).ready(function(){
	setInterval('buscar_mensajes()',3000);
});

function buscar_mensajes(consulta2){
	$.ajax({
		type: "POST",
        url: "real/cargarmensajes.php",
        dataType:"html",
        asycn:false,
        data: {consulta2 : consulta2},
	})
	.done(function(respuesta2){
		$("#mensajes").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}