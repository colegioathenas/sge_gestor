$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_valor    = $("#valor").val();
		_metodo   = $("#metodo").val();
		
		
			$("#matricula").val("");
		  	$("#cpf").val("");		  	
		  	$("#nome").val("");		
		 
		  	$("#banco").val("");		
		  	$("#agencia").val("");		
		  	$("#conta").val("");		
	
		  	$("#lancamentos").html("");
		  	
		
		$.ajax({
		  url: 'consulta_marinha.php',
		  dataType: 'json',
		  data: { valor: _valor, metodo: _metodo },
		  success: function(json){
		  	$("#matricula").val(json.matricula);
		  	$("#cpf").val(json.cpf);		  	
		  	$("#nome").val(json.nome);		
		 
		  	$("#banco").val(json.banco);		
		  	$("#agencia").val(json.agencia);		
		  	$("#conta").val(json.conta);
		  		
		  	$.ajax({
		  		url: 'consulta_marinha_lancamentos.php',
		  		
		  		data: {matricula: json.matricula},
		  		success: function(html){
		  			$("#lancamentos").html(html);
		  			
		  		}
		  	});			  	
		  }
		}); 
		
	});
});
