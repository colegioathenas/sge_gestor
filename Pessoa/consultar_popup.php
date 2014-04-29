<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css">
	</script>
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
		</script>
		<script src="/js/jquery.js" type="text/javascript"></script>
		<script src="/js/jquery-ui.js" type="text/javascript"></script>
		<script src="/js/jquery_masc.js" type="text/javascript"></script>
		<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


		<script>
	function seleciona(valor,text){
	
		parent.selectitem('cpf',valor,'pessoa_nome',text);
		
	}
	$(document).ready(function(){
		
		$( "#btnConsultar" ).click(function(){
        	_valor = $("#consulta_valor").val()
        	$.ajax({
			  url: 'consultar_pessoas.php',
			
			  data: { valor: _valor, popup: "sim"},
			  
			  success: function(data){
			  	$("#resultado").html(data);
			 
			  }
			  
			});
			return false;
        	
        });
       $("a[name=selecionar]").live("click",function(){
        	seleciona($(this).attr("cpf"),$(this).attr("nome"));
        });
	});
	</script>

</head>

<body>

	<label style="margin-top: 5px">Consultar</label>
	<input id="consulta_valor" name="consulta_valor" type="text" size="50"
		title="CPF / Nome" />
	<button id="btnConsultar">Consultar</button>
	<div id="resultado"></div>


</body>