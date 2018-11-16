$(document).ready(function(){
	setInterval('bnnotifi()',1000);
});

function bnnotifi(consulta2){
	$.ajax({
		url: 'real/bnnotifi.php',
		type: 'POST',
		dataType: 'html',
		data: { consulta2: consulta2},
	})
	.done(function(respuesta2){
		$("#bnnotifi").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}