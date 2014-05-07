<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
session_start ();
$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$_SESSION ['cpf'] = $cpf;

$query = "Select * from pessoa where nCdPessoa = $cpf";
$registro = consulta ( "athenas", $query );
$registro = $registro [0];

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
  	$(function() {
  		$( "#tabs" ).tabs();
  		<?php
				
include ("../Pessoa/dados_gerais_script.inc");
				include ("../Pessoa/comunicacao_script.inc");
				?>
		$("#disponibilidade_dialog").dialog({modal: true, autoOpen: false,width: 500, heigth: 800} );
		$("#disponibilidade_add").click(function(){
					$("#disponibilidade_dialog").dialog("open");
		});
		$("#disciplina_dialog").dialog({modal: true, autoOpen: false,width: 500, heigth: 800} );
		$("#disciplina_add").click(function(){
			$("#disciplina_dialog").dialog("open");
		});
		$("#disponibilidade_add_inicio").mask("99/99/9999");
		$("#disponibilidade_add_fim").mask("99/99/9999");
		$(".horario").mask("99:99");
		$("#transf_ter").click(function(){
			$("#disponibilidade_ter_inicio").val($("#disponibilidade_seg_inicio").val());
			$("#disponibilidade_ter_fim").val($("#disponibilidade_seg_fim").val());
		});
		$("#transf_qua").click(function(){
			$("#disponibilidade_qua_inicio").val($("#disponibilidade_ter_inicio").val());
			$("#disponibilidade_qua_fim").val($("#disponibilidade_ter_fim").val());
		});
		$("#transf_qui").click(function(){
			$("#disponibilidade_qui_inicio").val($("#disponibilidade_qua_inicio").val());
			$("#disponibilidade_qui_fim").val($("#disponibilidade_qua_fim").val());
		});
		$("#transf_sex").click(function(){
			$("#disponibilidade_sex_inicio").val($("#disponibilidade_qui_inicio").val());
			$("#disponibilidade_sex_fim").val($("#disponibilidade_qui_fim").val());
		});
		$("#disponibilidade_gravar").click(function(){
			$.ajax({
				  url: 'professor_disponibilidade_add.php',
				
				  data: { disponibilidade_add_inicio: $("#disponibilidade_add_inicio").val()
					    , disponibilidade_add_fim: $("#disponibilidade_add_fim").val()
						, disponibilidade_par_impar: $("#disponibilidade_par_impar").val()
						, disponibilidade_turno:$("#disponibilidade_turno").val()
						, disponibilidade_seg_inicio:$("#disponibilidade_seg_inicio").val()
						, disponibilidade_seg_fim:$("#disponibilidade_seg_fim").val()
						, disponibilidade_ter_inicio:$("#disponibilidade_ter_inicio").val()
						, disponibilidade_ter_fim:$("#disponibilidade_ter_fim").val()
						, disponibilidade_qua_inicio:$("#disponibilidade_qua_inicio").val()
						, disponibilidade_qua_fim:$("#disponibilidade_qua_fim").val()
						, disponibilidade_qui_inicio:$("#disponibilidade_qui_inicio").val()
						, disponibilidade_qui_fim:$("#disponibilidade_qui_fim").val()
						, disponibilidade_sex_inicio:$("#disponibilidade_sex_inicio").val()
						, disponibilidade_sex_fim:$("#disponibilidade_sex_fim").val()
					  	},
				  
				  success: function(data){
					  alert('Incluido com Sucesso');
						$.get('professor_disponibilidade.php', function(html) {
							  $("#disponibilidade_resultado").html(html);
							});
						$("#disponibilidade_dialog").dialog("close");
				  },
				beforeSend:function(){
				  		$("#div_loading").show();
				},
				complete: function(data){
				  		$("#div_loading").hide();
				}	  
			});
			return false;
			
		});
		 $("img[name=disponibilidade_remover]").click(function(){
			 	
			 	var url = $(this).attr("url"); 
		    	$("<div title='Aviso'></div>").appendTo('body')
				.html("<center><span style='font-size:small'>Deseja Remover Disponibilidade?</span></center>")
				.dialog({ modal: true
						, title: 'Aviso'
						, zIndex: 10000
						, autoOpen: true
						, width: 'auto'
						, resizable: false
						, buttons: { Sim: function () {
											$.get(url, function(data) {
												$.get('professor_disponibilidade.php', function(html) {
													  $("#disponibilidade_resultado").html(html);
													});
											});
											
											$(this).dialog("close");
		                           		  }
		                           , Nao: function () {
		                               	 	$(this).dialog("close");
		                            	  }
	                    },
	                    close: function (event, ui) {
	                        $(this).remove();
	                    },
	    				beforeSend:function(){
	    				 	$("#div_loading").show();
	    				},
	    				complete: function(data){
	    				 	$("#div_loading").hide();
	    				}
						}); 
				return false;
		 });

		 $("#disciplina_gravar").click(function(){
				$.ajax({
					  url: 'professor_disciplina_add.php',
					
					  data: { disciplina_disciplina: $("#disciplina_disciplina").val()
						  	},
					  
					  success: function(data){
						  alert('Incluido com Sucesso');
							$.get('professor_disciplina.php', function(html) {
								  $("#disciplina_resultado").html(html);
								});
							$("#disciplina_dialog").dialog("close");
					  },
					beforeSend:function(){
					  		$("#div_loading").show();
					},
					complete: function(data){
					  		$("#div_loading").hide();
					}
							  
				});
				return false;
				
			});
			 $("img[name=disciplina_remover]").live('click',function(){
				 	
				 	var url = $(this).attr("url"); 
			    	$("<div title='Aviso'></div>").appendTo('body')
					.html("<center><span style='font-size:small'>Deseja Remover Disciplina?</span></center>")
					.dialog({ modal: true
							, title: 'Aviso'
							, zIndex: 10000
							, autoOpen: true
							, width: 'auto'
							, resizable: false
							, buttons: { Sim: function () {
												$.get(url, function(data) {
													$.get('professor_disciplina.php', function(html) {
														  $("#disciplina_resultado").html(html);
														});
												});
												
												$(this).dialog("close");
			                           		  }
			                           , Nao: function () {
			                               	 	$(this).dialog("close");
			                            	  }
		                    },
		                    close: function (event, ui) {
		                        $(this).remove();
		                    },
		    				beforeSend:function(){
		    				 	$("#div_loading").show();
		    				},
		    				complete: function(data){
		    				 	$("#div_loading").hide();
		    				}
							}); 
					return false;
			 });
  	});
  </script>

</head>


<body>
	<div id="container">
            <?php include "../loading.inc"?>
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">
			<form id="frm1" action='incluir_acordo.php' target="_blank"
				method="post">
				<div id="tabs">
					<ul>
						<li><a href="#cadastro">Dados Cadastrais</a></li>
						<li><a href="#disponibilidade">Disponibilidade</a></li>
						<li><a href="#disciplinas">Disciplinas</a></li>
						<li><a href="#comunicacao">Comunicacao</a></li>
					</ul>
					<div id="cadastro"
						style='height: 400px; padding-left: 5px; overflow: auto'>
							<?php include("../Pessoa/dados_gerais.php")?>
	            		</div>
					<div id="disponibilidade"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<div id="disponibilidade_dialog">
							<label style='margin-top: 5px; width: 100px'>Inicio</label> <input
								type='text' id='disponibilidade_add_inicio' size='12' /> <label
								style='margin-top: 5px; width: 100px'>Fim</label> <input
								type='text' id='disponibilidade_add_fim' size='12' /> <br /> <label
								style='margin-top: 5px; width: 100px'>Dias Semana</label> <select
								id="disponibilidade_par_impar">
								<option value="0">Todos</option>
								<option value="1">Pares</option>
								<option value="2">Impares</option>
							</select> <label style='margin-top: 5px; width: 100px'>Turno</label>
							<select id="disponibilidade_turno">
								<option value="M">Manh&atilde;</option>
								<option value="T">Tarde</option>
								<option value="N">Noite</option>
							</select> <br />
							<table>
								<tr>
									<td>Seg</td>
									<td></td>
									<td>Ter</td>
									<td></td>
									<td>Qua</td>
									<td></td>
									<td>Qui</td>
									<td></td>
									<td>Sex</td>
								</tr>
								<tr>
									<td><input type='text' id='disponibilidade_seg_inicio' size='5'
										class='horario' /></td>
									<td rowspan='2'><span class='ui-icon ui-icon-arrowthick-1-e'
										id='transf_ter'></span></td>
									<td><input type='text' id='disponibilidade_ter_inicio' size='5'
										class='horario' /></td>
									<td rowspan='2'><span class='ui-icon ui-icon-arrowthick-1-e'
										id='transf_qua'></span></td>
									<td><input type='text' id='disponibilidade_qua_inicio' size='5'
										class='horario' /></td>
									<td rowspan='2'><span class='ui-icon ui-icon-arrowthick-1-e'
										id='transf_qui'></span></td>
									<td><input type='text' id='disponibilidade_qui_inicio' size='5'
										class='horario' /></td>
									<td rowspan='2'><span class='ui-icon ui-icon-arrowthick-1-e'
										id='transf_sex'></span></td>
									<td><input type='text' id='disponibilidade_sex_inicio' size='5'
										class='horario' /></td>
								</tr>
								<tr>
									<td><input type='text' id='disponibilidade_seg_fim' size='5'
										class='horario' /></td>
									<td><input type='text' id='disponibilidade_ter_fim' size='5'
										class='horario' /></td>
									<td><input type='text' id='disponibilidade_qua_fim' size='5'
										class='horario' /></td>
									<td><input type='text' id='disponibilidade_qui_fim' size='5'
										class='horario' /></td>
									<td><input type='text' id='disponibilidade_sex_fim' size='5'
										class='horario' /></td>
								</tr>
							</table>
							<a href='' id="disponibilidade_gravar" style='margin-left: 400px'>Gravar</a>
						</div>
						<a href="#" id="disponibilidade_add">[Adicionar Disponibilidade]</a>
						<br /> <br />
						<table>
							<thead>
								<tr>
									<td width='20px'></td>
									<td width='150px'>Inicio</td>
									<td width='150px'>Fim</td>
									<td width='100px'>Turno</td>
									<td width='100px'>Seg</td>
									<td width='100px'>Ter</td>
									<td width='100px'>Qua</td>
									<td width='100px'>Qui</td>
									<td width='100px'>Sex</td>
									<td width='250px'>Observacao</td>
								</tr>
							</thead>
						</table>

						<div id="disponibilidade_resultado"
							style="height: 290px; overflow: auto">
								<?php include "professor_disponibilidade.php"?>
							</div>
					</div>
					<div id="disciplinas"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<div id="disciplina_dialog">
							<label style='margin-top: 5px; width: 100px'>Disciplina</label> <select
								id="disciplina_disciplina">
		                	 	 	<?php
																							$query = "Select * from disciplina order by cNmDisciplina";
																							$disciplinas = consulta ( "athenas", $query );
																							foreach ( $disciplinas as $disciplina ) {
																								echo "<option value='" . $disciplina ['nCdDisciplina'] . "'>" . $disciplina ['cNmDisciplina'] . " (" . $disciplina ['cSigla'] . ")</option>";
																							}
																							?>
		                	 	 </select> <a href='' id="disciplina_gravar"
								style='margin-left: 400px'>Gravar</a>
						</div>
						<a href="#" id="disciplina_add">[Adicionar Disciplina]</a> <br />
						<br />
						<table>
							<thead>
								<tr>
									<td width='20px'></td>
									<td width='250px'>Disciplina</td>
									<td width='150px'>Sigla</td>
								</tr>
							</thead>
						</table>
						<div id="disciplina_resultado"
							style="height: 290px; overflow: auto">
								<?php include "professor_disciplina.php"?>
							</div>
					</div>
					<div id="comunicacao"
						style='height: 400px; padding-left: 5px; overflow: auto'>
							<?php
							include ("../Pessoa/comunicacao_dialog.php");
							include ("../Pessoa/comunicacao.php");
							?>
	                     </div>
				</div>
				<button id="btnImprimir">Imprimir</button>
			</form>
		</div>
            <?php include "../footer.inc" ?>	
     </div>
</body>
</html>