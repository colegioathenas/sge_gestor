$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_metodo  = $("#metodo").val();
		_valor   = $("#valor").val();		
		_captcha = $("#captcha").val();

		
		
		$.ajax({
		  url: 'consulta_restricao.php',
		  data: { metodo: _metodo, valor: _valor, captcha: _captcha },
		  dataType: "html",
		  beforeSend: function(){
		  	$("#restricao").html("Consultando...");
		  },
		  success: function(html){
		  	$("#restricoes").html(html);
		  	$("#img_capthca").attr("src", "../../captcha.php?"+new Date().getTime());
		  }
		});
		$("#captcha").val("");	 
		
	});
});
