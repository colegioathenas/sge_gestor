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
<style type="text/css" media="all">
td {
	font-size: 12px;
}
</style>

<script>
	$(document).ready(function(){
		$("#nCdCurso").load('listas.php?consulta=cursos_tecnicos');
		$("#Mes").load('listas.php?consulta=mes');
		$("#nCdCurso").change(function(){
			$("#nCdTurma").load('listas.php?consulta=turmas_curso&param1='+$(this).val());
		});
		
		$("#Mes").change(function(){
			$("#calendario").load('monta_calendario.php?mes_ano='+$(this).val()+'&turma='+$("#nCdTurma").val() );
		});
		$( "#tabs" ).tabs();

		$(".cmbDisciplina").live('change',function(){
			$("#professor"+$(this).attr('dia')).load('calendario_carrega_professor.php?disciplina='+$(this).val()
													+'&dia='+$(this).attr('dia')
													+'&mes_ano='+$("#Mes").val()
													+'&turma='+$("#nCdTurma").val()  
													+'&turno='+$("#nCdTurma option:selected").attr('turno')
													);
		});
		$(".cmbProfessor").live('change',function(){
			$.ajax({
				  url: 'calendario_inserir_alterar.php',
				  data: { mes_ano: $("#Mes").val()
					  	, professor: $(this).val()
					  	, disciplina: $("#disciplina"+$(this).attr('dia')).val()
					  	, turma: $("#nCdTurma").val()
					  	, dia: $(this).attr('dia')
					  	
					    },
				  
				  success: function(json){
				 
				  }
				  
				});
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
						<li><a href="#geral">Consultar</a></li>

					</ul>

					<div id="geral"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label>Curso</label> <select id='nCdCurso' name='nCdCurso'>

						</select> <label>Turma</label> <select id='nCdTurma'
							name='nCdTurma'>

						</select> <label>Mes</label> <select id='Mes' name='Mes'>

						</select>
						<div id='calendario'></div>
					</div>


				</div>


			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
