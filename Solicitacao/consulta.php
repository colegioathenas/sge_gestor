<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
z?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Solicitação]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
		
		
		$( "#tabs" ).tabs();		
		$( "#btnConsultar" ).click(function(){
        	_valor = $("#consulta_valor").val();
        	_option = $("#tpConsultaFiltro option:selected").val();
        	$.ajax({
			  url: 'solicitacao_listar.php',			
			  data: { valor: _valor 
				  	, opcao: _option},			  
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
			<form method="post">


				<div id="tabs">
					Pessoa
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Consultar Protocolo</a></li>

					</ul>

					<div id="consulta"
						style='height: 410px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Consultar</label> <input
							id="consulta_valor" name="consulta_valor" type="text" size="50"
							title="Protocolo / Requerente" /> <select id="tpConsultaFiltro">
							<option value="ABT">Protocolos Abertos</option>
							<option value="FLA">Somente Fila de Atuação</option>
							<option value="TDS">Todos</option>
						</select>
						<button id="btnConsultar">Consultar</button>
						<div id="resultado"></div>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
