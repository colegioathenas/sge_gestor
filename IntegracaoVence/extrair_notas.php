<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Integração Vence]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
		
		
		$( "#tabs" ).tabs();
		$("#btnExtrair").click(function(){
			if($("#turma option:selected").val() == "0"){
				alert("Selecione uma turma");
				return false
			}
		});
		$("#curso").change(function(){
			if($("#curso option:selected").val() == "C"){
				$.ajax({
					  url: 'cursos_turma_processar.php',					
					  data: { idopcao: $("#edicao").val()
						    , opcao: "curso" },					  
					  success: function(data){
						  $("#curso").empty()
						  	.append(data);					  				
					  }					  
					});
			}else{
				$.ajax({
					  url: 'cursos_turma_processar.php',					
					  data: { idopcao: $("#curso option:selected").attr("idcurso")
						    , opcao: "turma" },					  
					  success: function(data){						  						  
						  $("#turma")
						  	.empty()
						  	.append(data);						  				
					  }					  
					});
			}
		});
		
        $("#turma").change(function(){
            if ($("#curso option:selected").val() == "0"){
                alert("Nenhum Curso Foi Escolhido");
                $("#tdTurma").attr("selected", true);
        	}else{
        		if($("#turma option:selected").val() == "C"){
        		$.ajax({
					  url: 'cursos_turma_processar.php',					
					  data: { idopcao: $("#curso option:selected").attr("idcurso")
						    , opcao: "turma" },					  
					  success: function(data){
						  $("#turma")
						  	.empty()
						  	.append(data);			  				
					  }					  
					});
        		}else{
            		$("#btnExtrair").attr("href","extrair_notas_processar.php?idturma="+$("#turma option:selected").val());
        		}
        	}
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
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Extrair Notas</a></li>

					</ul>

					<div id="consulta"
						style='height: 270px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Edição</label> <input id="edicao"
							name="edicao" type="text" size="3" value="0" /> 0 - Para todos <br />
						<label style="margin-top: 15px">Cursos</label> <select id="curso"
							name="curso">
							<option value="0" id="tdcurso">Selecione</option>
							<option value="C">Consultar Cursos da Edição</option>
						</select> <br /> <label style="margin-top: 15px">Turmas</label> <select
							id="turma" name="turma">
							<option value="0" id="tdTurma">Selecione</option>
							<option value="C">Consultar Turmas do Curso</option>
						</select> <br /> <br /> <a href="" id="btnExtrair" class="sbtn"
							disabled="disabled">Extrair</a>
						<div id="resultado"></div>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
