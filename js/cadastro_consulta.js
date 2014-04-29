
$(document).ready(function(){
	
//$(".sbtn").click(function(){
	$(".sbtn").click(function(){
		$.ajax({
		  url: 'cadastro_pesq.php',
		  data: { valor: $('#procurar').val() },
		  beforeSend: function(){
		  //	$("#loading").show();
		  },
		  success: function(html){
		  	$("#resultado").html(html);
		  }
	});
	});
});
