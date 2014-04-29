<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Grade Horaria - Regular]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>

<script>
        function carrega_disciplina(){
             $("#horario_disciplina").load('listas.php?consulta=disciplina_turma&param1='+$("#nCdTurma").val());              
        }   
        
        function carrega_professor(){
            $("#horario_professor").load('listas.php?consulta=professor_disciplina&param1='+$("#horario_disciplina").val());
        }
       
        function carrega_grade(){
             $.ajax({    
                        url: 'grade_regular_montar.php',
                        async: false,
                        data: {  turma:       $("#nCdTurma").val()
                             
                              },

                        success: function(data){
                          $("#grade").html(data);
                        }
                    });
        }
         
	$(document).ready(function(){
                
                $("#editar_horario_dialog").dialog({modal: true, autoOpen: false,width: 500, heigth: 800} );
                $(".timetable").live('click',function(){
                    $("#horario_professor").empty();
                    $("#horario_disciplina").empty();
                    $("#aulaid").val($(this).attr("id"));
                    $("#horario_codigo").val($(this).attr("codigo"));
                    carrega_disciplina();                    
                    $("#editar_horario_dialog").dialog("open");                    
                });
		
                $("#nCdCurso").load('listas.php?consulta=cursos_regular');
                
		$("#nCdCurso").change(function(){
                    $("#nCdTurma").load('listas.php?consulta=turmas_curso&param1='+$(this).val(),function(){  
                        carrega_grade();
                    });
                    
		});
                $("#nCdTurma").change(function(){
                  carrega_grade();
		});
                $("#horario_disciplina").change(function(){
                    carrega_professor();
                });
		
		$("#disciplina_gravar").click(function(){
                    var _disciplina =  $("#horario_disciplina  option:selected").text(); 
                    var _professor =  $("#horario_professor  option:selected").text();
                    $("#"+$("#aulaid").val()).html("<span style='font-size:22px'>"+_disciplina+"</span><br/>"+_professor);
                    $("#"+$("#aulaid").val()).attr("disciplina",$("#horario_disciplina").val());
                    $("#"+$("#aulaid").val()).attr("professor",$("#horario_professor").val());
                    
                    $.ajax({    
                        url: 'grade_regular_update.php',
                        async: false,
                        data: { codigo:      $("#horario_codigo").val()
                              , turma:       $("#nCdTurma").val()
                              , dia:         $("#"+$("#aulaid").val()).attr("dia")
                              , aula:        $("#"+$("#aulaid").val()).attr("aula")
                              , professor :  $("#horario_professor").val()
                              , disciplina : $("#horario_disciplina").val()
                              },

                        success: function(data){
                           $("#"+$("#aulaid").val()).attr("codigo",data);
                        }
                    });
    
    
    
                    $("#editar_horario_dialog").dialog("close");
                    return false;
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
				<div id="editar_horario_dialog" title="Editar Aula">
					<input id='horario_codigo' type='hidden' /> <input id='aulaid'
						type='hidden' /> <label style='margin-top: 5px; width: 100px'>Disciplina</label>
					<select id="horario_disciplina">
					</select> <br /> <label style='margin-top: 5px; width: 100px'>Professor</label>
					<select id="horario_professor">

					</select> <br /> <a href='' id="disciplina_gravar" class="sbtn">Gravar</a>
				</div>

				<div id="tabs">
					<ul>
						<li><a href="#geral">Consultar</a></li>

					</ul>
					<div id="geral"
						style='height: 400px; padding-left: 5px; overflow: auto'>
						<label>Curso</label> <select id='nCdCurso' name='nCdCurso'></select>
						<label>Turma</label> <select id='nCdTurma' name='nCdTurma'></select>
						<div id='grade' style="padding-top: 10px">
                                           <?php include("grade_regular_montar.php"); ?>
                                        </div>
					</div>


				</div>


			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
