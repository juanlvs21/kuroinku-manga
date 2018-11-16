/*$(document).ready(function(){
	setInterval('muro()',3000);
	//muro();
});

function muro(consulta2){
	var ultima = document.getElementById('nropublic').value;
	var dato = 'ultima='+ultima;
	
	$.ajax({
		//url: 'publicaciones.php',
		type: "POST",
        url: "muro.php",
        data: dato,
        dataType:"html",
        asycn:false,
	})
	.done(function(respuesta2){
		$("#nuevaspublic").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}*/