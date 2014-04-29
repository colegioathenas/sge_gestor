function carregaComboSexo(){
	$('#sexo').load('operacoes_comuns.php?tela=cliente&operacao=listasexo' );
}

$(document).ready(function(){
	carregaComboSexo();
	
	$.ajax({
		  url: 'cliente.php',
		  dataType: 'json',
		  data: { metodo: 'consulta', param1: $('#param1').val() },
		  beforeSend: function(){
		  //	$("#loading").show();
		  },
		  success: function(json){
		  	$("#codigo").val(json.Mat);
		  	$("#nome").val(json.Nome);
		  	$("#cpf").val(json.CPF);
		  	$("#rg").val(json.CertidaoNasc);
		  }
	});
	
	$.ajax({
		  url: 'cliente.php',
		  dataType: 'html',
		  data: { metodo: 'consulta_telefone', param1: $('#param1').val() },
		  beforeSend: function(){
		  //	$("#loading").show();
		  },
		  success: function(html){
		  	
		  }
	});
	
	
});
