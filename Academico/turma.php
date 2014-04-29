<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Turma]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>

<script>
	function consultarTurma(){
		_valor = $("#consulta_valor").val();
    	$.ajax({
		  url: 'turma_consultar.php',
		
		  data: { valor: _valor },
		  
		  success: function(data){
		  	$("#resultado").html(data);
		 
		  }
		  
		});
	}
	$(document).on("click","a[name=turma_duplicar]", function(){
		$("#turmaDuplicar_codigo").val($(this).attr("codigo"));
		$("#dlgTurmaDuplicar").dialog("open");    
	});	
	$(document).ready(function(){
		
		
		$( "#tabs" ).tabs();
		$("#dlgTurmaDuplicar").dialog({modal: true, autoOpen: false,width: 710, heigth: 810} );		
		$( "#btnConsultar" ).click(function(){
			consultarTurma();
			return false;
        	
        });
        $("#btnDuplicar").click(function(){
        	$.ajax({
  			  url: 'turma_duplicar.php',
  			
  			  data: { turma: $("#turmaDuplicar_codigo").val()
  	  			  	, nome:  $("#turmaDuplicar_nome").val()
  	  			  	},  			  
  			  success: function(data){
  				$("#dlgTurmaDuplicar").dialog("close");   
  			  	alert("Turma Duplicada com Sucesso");  	
  			  	consultarTurma();		  	
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
				<div id="dlgTurmaDuplicar" title="Duplicar Turma">
					<input id="turmaDuplicar_codigo" type="hidden" /> <label
						style="margin-top: 5px; width: 100px">Nome da Turma</label> <input
						id="turmaDuplicar_nome" type="text" size='80' /> <br /> <br />
					<div style="text-align: right">
						<a href="" id="btnDuplicar" class="sbtn">Gravar</a>
					</div>
				</div>

				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Consultar Turma</a></li>
					</ul>
					<div id="consulta"
						style='height: 410px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Consultar</label> <input
							id="consulta_valor" name="consulta_valor" type="text" size="50"
							title="CPF / Nome" />
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