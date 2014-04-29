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
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


<script>
	function monta_lista_nota(){
		if ( $("#nCdDisciplina").val() == 0 ){
			$("#lista_nota").empty();
		}else{
			$("#lista_nota").load('monta_lista_notas.php?turma='+$("#nCdTurma").val()+'&mes_ano='+$("#Mes").val()+'&disciplina='+$("#nCdDisciplina").val() );
		}
	}
	function carrega_disciplina(){
		$("#nCdDisciplina").load('listas.php?consulta=disciplina&param1='+$("#Mes").val()+'&param2='+$("#nCdTurma").val(),function(){
				if ($(this).find('option').length == 2){
					monta_lista_nota();
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
		$(".nota").live('change',function(){ 
			var campo_media = $("#media"+$(this).attr('matricula'));
			$.ajax({
				  url: 'nota_update.php',
				  data: { matricula: $(this).attr('matricula')
					  	, disciplina: $("#nCdDisciplina").val()
						, turma: $("#nCdTurma").val()
						, nota1 : $("#nota1"+$(this).attr('matricula')).val()
						, nota2 : $("#nota2"+$(this).attr('matricula')).val()
					    },
				  
				  success: function(html){
				
				 	campo_media.val(html);
				  }
				  
				});
		
		});
		$("#Mes").load('listas.php?consulta=mes');
		$("#nCdCurso").load('listas.php?consulta=cursos&param1=0',function(){
				if ($(this).find('option').length == 2){
					carrega_turma();
				}
			}
		);
		
		$("#nCdCurso").change(function(){
			carrega_turma();
		});
		$("#nCdTurma").change(function(){
			carrega_disciplina();
		});
		$("#Mes").change(function(){
			$("#nCdCurso").empty();
			$("#nCdTurma").empty();
			$("#nCdDisciplina").empty();
			$("#lista_nota").empty();
			
			$("#nCdCurso").load('listas.php?consulta=cursos&mes_ano='+$(this).val());	
			
		});
		$("#nCdDisciplina").change(function(){
			monta_lista_nota();
			
		});
		
		$( "#tabs" ).tabs();
		
        	
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
						<li><a href="#geral">Notas</a></li>

					</ul>

					<div id="geral"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label>Mes</label> <select id='Mes' name='Mes'>
						</select> <label>Curso</label> <select id='nCdCurso'
							name='nCdCurso'>
						</select> <label>Turma</label> <select id='nCdTurma'
							name='nCdTurma'>
						</select> <label>Disciplina</label> <select id='nCdDisciplina'
							name='nCdDisciplina'>
						</select>


						<div id='lista_nota'></div>
					</div>


				</div>


			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
