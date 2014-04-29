$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_nb    = $("#nb").val();
		
		$("#esp").val("");
	  	$("#cpf").val("");		  	
	  	$("#nome").val("");		
	  	$("#dtnasc").val("");		
	  	$("#cep").val("");		
	  	$("#endereco").val("");		
	  	$("#bairro").val("");		
	  	$("#cidade").val("");		
	  	$("#uf").val("");		
	  	$("#ddd").val("");		
	  	$("#telefone").val("");		
	  	$("#email").val("");		
	  	$("#descontos").html("");
		  	
		$.ajax({
		  url: 'consulta_inss.php',
		  dataType: 'json',
		  data: { nb: _nb },
		  success: function(json){
		  	$("#esp").val(json.esp);
		  	$("#cpf").val(json.cpf_formatado);		  	
		  	$("#nome").val(json.nome);
		  	$("#dtnasc").val(json.dtnasc_formatado);
		  	$("#cep").val(json.cep);
		  	$("#endereco").val(json.endereco);
		  	$("#bairro").val(json.bairro);
		  	$("#cidade").val(json.cidade);
		  	$("#uf").val(json.uf);
		  	$("#ddd").val(json.ddd);
		  	$("#telefone").val(json.telefone);
		  	$("#email").val(json.email);
		  }
		  
		}); 
		$.ajax({
		  		url: 'consulta_historico.php',
		  		
		  		data: {nb: _nb},
		  		success: function(html){
		  			$("#descontos").html(html);
		  			
		  		}
		  		
		  	});
	});
	$("#captcha").val("");	 
});
