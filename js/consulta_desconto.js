$(document).ready(function(){
	
	$(".sbtn").click(function(){
		_metodo = $("#metodo").val();
		_valor  = $("#valor").val();
		_captcha = $("#captcha").val();
		
		
		$.ajax({
		  url: 'consulta_descontos.php',
		  data: { metodo: _metodo, valor: _valor, captcha: _captcha },
		  beforeSend:function(){
		  	$("#resultado").html("Consultando...");
		  },
		  success: function(html){
		  	$("#resultado").html(html);
		 
		  	$("#img_capthca").attr("src", "../../captcha.php?"+new Date().getTime());
		  }
		  
		});
			 
		$("#captcha").val("");	 
	});
});
