<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
$nCdCurso = $_REQUEST ['codigo'];
$query = "Select * from Cursos where nCdCurso = $nCdCurso";
$registro = consulta ( "athenas", $query );
$registro = $registro [0];
$cTpCurso = $registro ["cTpCurso"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>




<script>
             function carrega_divisoes(){
                _valor = <?php echo $_REQUEST['codigo']; ?>
                
        	$.ajax({
			  url: 'curso_divisao_carregar.php',
			
			  data: { curso: _valor },
			  
			  success: function(data){
			  	$("#divisoes").html(data);
			 
			  }
			  
			});
                
            }
	$(document).ready(function(){
		carrega_divisoes();
                
		$( "#tabs" ).tabs();
                $("#divisao_dt_inicio").mask("99/99/9999");
                $("#divisao_dt_fim").mask("99/99/9999");
                $("#divisoes_dialog").dialog({modal: true, autoOpen: false,width: 330, heigth: 800} );
                $("a[name=btnIncluir],a[name=btnEditar]").live('click',function(){
                    $("#divisao_codigo").val($(this).attr("codigo"));
                    $("#divisao_nome").val($(this).attr("nome"));
                    $("#divisao_dt_inicio").val($(this).attr("dtinicio"));
                    $("#divisao_dt_fim").val($(this).attr("dtfim"));
                    $("#divisoes_dialog").dialog("open");                    
                    return false;
                });
                $("#divisao_gravar").click(function(){
                    _codigo = $("#divisao_codigo").val();
                    _nome = $("#divisao_nome").val();
                    _inicio = $("#divisao_dt_inicio").val();
                    _fim = $("#divisao_dt_fim").val();
                    $.ajax({
			  url: 'curso_divisao_update.php',
			
			  data: { codigo: _codigo                              
                                , curso: <?php echo $_REQUEST['codigo']; ?>
                                
                                , nome: _nome
                                , inicio: _inicio
                                , fim :_fim
                                },
			  
			  success: function(){
			  	alert("Registro Atualizado");
                                 $("#divisoes_dialog").dialog("close");
                                carrega_divisoes();
			 
			  }
			  
			});
                    return false;
               });
               $("a[name=btnExcluir]").live('click',function(){
		_codigo = $(this).attr("codigo");
		$("<div title='Aviso'></div>").appendTo('body')
		.html("<center><span style='font-size:small'>Deseja exlcuir Divis&atilde;o?</span></center>")
		.dialog({ modal: true
				, title: 'Aviso'
				, zIndex: 10000
				, autoOpen: true
				, width: 'auto'
				, resizable: false
				, buttons: { Sim: function () {
									
									$.ajax({
										  url: 'curso_divisao_remove.php',
										  data: { codigo: _codigo
											    },
										  
										  success: function(data){
											  
										  }
									});
									$(this).dialog("close");
                                                                        carrega_divisoes();
									
                           		  }
                           , Nao: function () {
                               	 	$(this).dialog("close");
                            	  }
                },
                close: function (event, ui) {   
                     $(this).remove();
                    
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
				<div id="divisoes_dialog" title="Divisão">
					<input id="divisao_codigo" type="hidden" /> <label
						style="margin-top: 5px">Nome</label> <input id="divisao_nome"
						type="text" size='20' /> <br /> <label style="margin-top: 5px">Dt.
						Inicial</label> <input id="divisao_dt_inicio" type="text"
						size='10' /> <br /> <label style="margin-top: 5px">Dt. Final</label>
					<input id="divisao_dt_fim" type="text" size='10' /> <br />
					<div style="text-align: right">
						<a href="" id="divisao_gravar" class="sbtn">Gravar</a>
					</div>
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral">Cadastro de Cursos</a></li>
						<li><a href="#financeiro">Dados Financeiros</a></li>
					</ul>

					<div id="geral" style='height: 345px; padding-left: 5px'>
						<label style="margin-top: 5px">Nome</label> <input id="nome"
							name="nome" type="text" size='50'
							value='<?php echo $registro['cNmCurso']; ?>' /> <br /> <label
							style="margin-top: 5px">Tipo</label> <select name="cTpCurso">
							<option>Selecione...</option>
							<option value="R"
								<?php if ($cTpCurso == "R") { echo  " selected='selected' "; } ?>>Regular</option>
							<option value="T"
								<?php if ($cTpCurso == "T") { echo  " selected='selected' "; } ?>>Tecnico</option>
						</select> <br /> <label style="margin-top: 5px">Ordem</label> <input
							id="ordem" name="ordem" size='2' type="text"
							value='<?php echo $registro['cOrdem']; ?>' /> <br />
						<div class="divisao">
							<b>Divis&atilde;o</b>
						</div>
						<div id="divisoes"></div>
					</div>
					<div id="financeiro" style='height: 345px; padding-left: 5px'>
						<label style="margin-top: 5px; width: 130px">Valor Curso</label> <input
							id="endereco_nr" name="endereco_nr" size='10' type="text"
							value='<?php echo $registro['nVlrCurso']; ?>' /> <label
							style="margin-top: 5px; width: 130px">Valor Rematricula</label> <input
							id="endereco_complemento" name="endereco_complemento" size='10'
							type="text" value='<?php echo $registro['nVlrRematricula']; ?>' />
						<label style="margin-top: 5px; width: 130px">Prazo Maximo</label>
						<input id="cidade" name="cidade" type="text" size='10'
							value='<?php echo $registro['nPrazoMaximo']; ?>' /> <br /> <label
							style="margin-top: 5px; width: 130px">Valor Material</label> <input
							id="bairro" name="bairro" type="text" size='10'
							value='<?php echo $registro['nVlrMaterial']; ?>' /> <label
							style="margin-top: 5px; width: 130px">Prazo Maximo</label> <input
							id="cidade" name="cidade" type="text" size='10'
							value='<?php echo $registro['nPrazoMaximo']; ?>' /> <br />


					</div>


				</div>
				<input type="button" value="Atualizar" class="sbtn" />

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>