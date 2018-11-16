$(document).ready(function(){
	setInterval('cargarnotificaciones()',3000);
});

function cargarnotificaciones(consulta2){
	$.ajax({
		type: "POST",
        url: "real/cargarnotificaciones.php",
        dataType:"html",
        asycn:false,
        data: {consulta2 : consulta2},
	})
	.done(function(respuesta2){
		$("#notificaciones").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}