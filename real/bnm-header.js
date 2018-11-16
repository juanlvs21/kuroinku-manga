$(document).ready(function(){
	setInterval('bnm1()',1000);
});

function bnm1(consulta2){
	$.ajax({
		url: 'real/bnm-header.php',
		type: 'POST',
		dataType: 'html',
		data: { consulta2: consulta2},
	})
	.done(function(respuesta2){
		$("#bnm").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}