$(document).ready(function(){
	setInterval('bnm2()',1000);
});

function bnm2(consulta2){
	$.ajax({
		url: 'real/bnm-sidebar.php',
		type: 'POST',
		dataType: 'html',
		data: { consulta2: consulta2},
	})
	.done(function(respuesta2){
		$("#bnm2").html(respuesta2);
	})
	.fail(function(respuesta2){
		console.log('error');
	})
}