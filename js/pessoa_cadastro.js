function camposPF(){
	$.ajax({
		  url: 'cadastrogeralpf.php',		  
		  beforeSend: function(){
		  //	$("#loading").show();
		  },
		  success: function(html){
		  	$("#cadastrogeral").html(html);
		  }
	});
}
function camposPJ(){
	$.ajax({
		  url: 'cadastrogeralpj.php',		  
		  beforeSend: function(){
		  //	$("#loading").show();
		  },
		  success: function(html){
		  	$("#cadastrogeral").html(html);
		  }
	});
}
$(document).ready(function(){
	$("#tpPessoa").val('F');
	camposPF();
	$("#tpPessoa").change(function(){
		if ($("#tpPessoa").val() == "F"){
			 camposPF();
		}else{
			camposPJ();
		}
	});
	$(".sbtn").click(function(){
		alert($("#ifvalue").val());
	});
});
