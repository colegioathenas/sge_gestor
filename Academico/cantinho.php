<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iEscola - Cantinho da Lousa</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>


<script>
	function monta_diario(){
		$("#diario").load('monta_diario.php?turma='+$("#nCdTurma").val()+'&mes_ano='+$("#Mes").val()+'&disciplina='+$("#nCdDisciplina").val() );
	}
	function carrega_disciplina(){
		$("#nCdDisciplina").load('listas.php?consulta=disciplina&param1='+$("#Mes").val()+'&param2='+$("#nCdTurma").val(),function(){
				if ($(this).find('option').length == 2){
					monta_diario();
				}
			
			}
		);
	}
	function carrega_turma(){
		$("#nCdTurma").load('listas.php?consulta=turmas&param1='+$("#Mes").val()+'&param2='+$("#nCdCurso").val(),function(){
			if ($(this).find('option').length == 2){
				carrega_disciplina();
			}
		}
		);
	}
	$(document).ready(function(){
		
		
		$( "#tabs" ).tabs();
		$("#data").mask("99/99/9999");
	
		$("#btnpesq").click(function(){
			
	
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
						<li><a href="#geral">Cantinho da Lousa</a></li>

					</ul>

					<div id="geral"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label>Data</label> <input name='data' id='data' type='text'
							size=11 /> <img src="../image/search-icon.png" name="btnpesq"
							id="btnpesq" height="15px">

							<div id='cantinhos'></div>
					
					</div>


				</div>


			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
