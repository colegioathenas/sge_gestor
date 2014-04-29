$(document).ready(function(){
	
	$(".sbtn").click(function(){
		
		_valor    = $("#procurar").val();
		
		
		$.ajax({
		  url: 'consulta_lista.php',
		  
		  data: { valor:_valor },
		  success: function(html){
		  	$("#resultado").html(html);
		  	
		  }
		  
		});
			 
	});
});
