$(document).ready(function(){
	
	$(".sbtn").click(function(){
		
		_metodo    = $("#metodo").val();
		_valor     = $("#valor").val();
		_captcha   = $("#captcha").val();
		
		$("#cpf").val("");		  	
	  	$("#orgao").val("");
	  	$("#matricula").val("");
	  	$("#nome").val("");
	  	$("#mae").val("");
	  	$("#dtnasc").val("");
	  	$("#sexo").val("");
	  	$("#cep").val("");
	  	$("#endereco").val("");
	  	$("#bairro").val("");
	  	$("#cidade").val("");
	  	$("#uf").val("");
	  	$("#ddd").val("");
	  	$("#telefone").val("");
	  	$("#email").val("");
		
		$.ajax({
		  url: 'consulta_dados_cadastrais.php',
		  dataType: 'json',
		  data: { metodo: _metodo, valor: _valor, captcha: _captcha },
		  beforeSend: function(){
		  	$("#loading").show();
		  },
		  success: function(json){
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
		  	
		  	$("#img_capthca").attr("src", "../../captcha.php?"+new Date().getTime());
		  	$("#loading").hide();
		  }
		});
		$("#captcha").val("");	 
		
	});
});
