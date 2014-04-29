$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_metodo = $("#metodo").val();
		_valor    = $("#valor").val();
		_captcha =  $("#captcha").val();
		
		$.ajax({
		  url: 'consulta_dados_cadastrais.php',
		  dataType: 'json',
		  data: { metodo: _metodo, valor: _valor, captcha: _captcha, completa: 'SIM' },
		  beforeSend: function() {
			  	$("#cpf").val("Consultando...");		  	
			  	$("#orgao").val("Consultando...");
			  	$("#matricula").val("Consultando...");
			  	$("#nome").val("Consultando...");
			  	$("#mae").val("Consultando...");
			  	$("#dtnasc").val("Consultando...");
			  	$("#sexo").val("Consultando...");
			  	$("#cep").val("Consultando...");
			  	$("#endereco").val("Consultando...");
			  	$("#bairro").val("Consultando...");
			  	$("#cidade").val("Consultando...");
			  	$("#uf").val("Consultando...");
			  	$("#ddd").val("Consultando...");
			  	$("#telefone").val("Consultando...");
			  	$("#email").val("Consultando...");
			  	$("#restricao").val("Consultando...");
			  	$("#descontos").html("<b>Descontos</b> Consultando...");
			  	$("#margem").val("Consultando...");
			  },
		  success: function(json){
		  	_matricula = json.matricula;
		  	$("#cpf").val(json.cpf);		  	
		  	$("#orgao").val(json.orgao);
		  	$("#matricula").val(json.matricula);
		  	$("#nome").val(json.nome);
		  	$("#mae").val(json.mae);
		  	$("#dtnasc").val(json.dtnasc);
		  	$("#sexo").val(json.sexo);
		  	$("#cep").val(json.cep);
		  	$("#endereco").val(json.endereco);
		  	$("#bairro").val(json.bairro);
		  	$("#cidade").val(json.municipio);
		  	$("#uf").val(json.uf);
		  	$("#ddd").val(json.ddd);
		  	$("#telefone").val(json.fone);
		  	$("#email").val(json.email);
		  	
		  	$.ajax({
			    url: 'consulta_restricao.php',
				  data: { metodo: _metodo, valor: _valor, captcha: _captcha, completa: 'SIM'  },
				  beforeSend: function(){
				  	$("#restricoes").html("<b>Restricoes</b> Consultando...");
				  },
				  success: function(html){
			  $("#restricoes").html(html);
			  	$.ajax({
					  url: 'consulta_descontos.php',
	
					  data: {  metodo: 'matricula', valor: _matricula, captcha: _captcha, completa: 'SIM'  },
					  success: function(html){
					  	$("#descontos").html(html);
					  	$.ajax({
						  url: 'consulta_margem.php',
						  dataType: 'json',
						  data: {  metodo: 'matricula', valor: _matricula, captcha: _captcha, completa: 'SIM'  },
						  success: function(json){
						  	margem = json.margem;
						  	$("#margem").val(margem);
						  	$("#img_capthca").attr("src", "../../captcha.php?"+new Date().getTime());
						  }
						});
					  	
					  }
					  
				});
			  }
			});
		  	
		  	
		  	
		  }
		});
		
		

		

		
		
		
		
		
		$("#captcha").val("");	 
		
	});
});
