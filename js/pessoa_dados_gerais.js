function consulta_telefone(){
		$("#telefones tr").each(function(){
				$(this).remove();
			 });
			$.get('pessoa_telefone_consultar.php?cpf='+$("#nCdPessoa").val(), function(data) {
			  $("#telefones").last().append(data);
			});
	}
$("#incluir_tel").click(function(){
	$.ajax({
		  url: 'pessoa_telefone_incluir.php',
		
		  data: { cpf: $("#nCdPessoa").val()
			  	, ddd: $("#ddd").val()
			  	, telefone:$("#telefone").val()
			  	},
		  
		  success: function(data){
			  consulta_telefone();
			  alert('Incluido com Sucesso');
			  $("#ddd").val("");
			  $("#telefone").val("");
		 
		  }
	});
	return false;
	
});
$("#nCdPessoa").mask("999.999.999-99");
$("#cep").mask("99999-999");
consulta_telefone();	