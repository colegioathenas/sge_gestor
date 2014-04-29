$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_metodo = $("#metodo").val();
		_valor    = $("#valor").val();
		_captcha =  $("#captcha").val();
		
		$.ajax({
		  url: 'consulta_margem.php',
		  dataType: 'json',
		  data: { metodo: _metodo, valor: _valor, captcha: _captcha },
		  beforeSend: function(){
		  	$("#margem").val("Consultando..");
		  },
		  success: function(json){
		  	margem = json.margem;
		  	
		  	$("#margem").val(margem);
		  	$('#margem').priceFormat({
			    prefix: 'R$ ',
			    centsSeparator: ',',
			    thousandsSeparator: '.'
			});
		  	$("#img_capthca").attr("src", "../../captcha.php?"+new Date().getTime());
		  }
		});
		$("#captcha").val("");	 
		
	});
});
