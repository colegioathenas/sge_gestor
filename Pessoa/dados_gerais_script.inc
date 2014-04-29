function consulta_telefone(){
		$("#telefones tr").each(function(){
				$(this).remove();
			 });
			$.get('../Pessoa/pessoa_telefone_consultar.php?cpf='+$("#nCdPessoa").val(), function(data) {
			  $("#telefones").last().append(data);
			});
	}
$("#incluir_tel").click(function(){
	$.ajax({
		  url: '../Pessoa/pessoa_telefone_incluir.php',
		
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
$("#resp_financeiro").mask("999.999.999-99");
$("#cep").mask("99999-999");
$("#dt_nasc").mask("99/99/9999");
consulta_telefone();
$("#btnEnviarSenha").click(function(){
	$.ajax({
		url: '../Util/envia_senha.php',                                               
        data: { codigo : <?php echo $_REQUEST['cpf'];?>                                
              },

                        success: function(data){                            
                         alert("Senha Enviada com Sucesso");                                                   
                             $.get("../rh/consulta_comunicacao.php", function(html) {
						  		$("#comunicacao_resultado").html(html);
                            	});
                        }
                    });
});	