<?php
include ("../verifica_logado.php");
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
	$(document).ready(function(){
		$("a[name=aterarSituacao]").live("click", function(){
			
			_cpf 	   = $(this).attr("cpf");
			_situacao = $(this).attr("situacao");
			_texto = "";
			
			if (_situacao == "1"){
				_situacao = "0";
				
				
			}else{
				_situacao = "1";
				
			}
			
			 $.ajax({
			  url: 'altera_restricao.php',
			
			  data: { cpf: _cpf, situacao: _situacao },
			  
			  success: function(data){
			  	alert(data);		
			  	_valor = $("#consulta_valor").val()
	        	$.ajax({
				  url: 'consultar_pessoa_restricao.php',
				
				  data: { valor: _valor },
				  
				  success: function(data){
				  	$("#resultado").html(data);
				 
				  }
				  
				});
			  }
			  
			});
			
			return false;
			
		});      
		
		$( "#tabs" ).tabs();
		$( "#btnConsultar" ).click(function(){
        	_valor = $("#consulta_valor").val()
        	$.ajax({
			  url: 'consultar_pessoa_restricao.php',
			
			  data: { valor: _valor },
			  
			  success: function(data){
			  	$("#resultado").html(data);
			 
			  }
			  
			});
			return false;
        	
        });
	});
	</script>

</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<p>
				<h2>RESTRICAO - CONSULTAR</h2>
			</p>
			<form method="post">


				<div id="tabs">
					<ul>
						<li><a href="#geral">Consultar</a></li>

					</ul>

					<div id="consulta"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Consultar</label> <input
							id="consulta_valor" name="consulta_valor" type="text" size="50"
							title="CPF / Nome" />
						<button id="btnConsultar">Consultar</button>
						<div id="resultado"></div>
					</div>


				</div>

				</p>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>