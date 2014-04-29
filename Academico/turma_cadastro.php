<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";

$codigo = $_REQUEST ['codigo'];

$query = "Select * from turma where nCdTurma = $codigo";
$turmas = consulta ( "athenas", $query );
$turma = $turmas [0];
$nCdCurso = $turma ["nCdCurso"];

$query_curso = "SELECT * FROM cursos";
$cursos = consulta ( "athenas", $query_curso );

$query_matriz = "SELECT * FROM matriz where nCdCurso = $nCdCurso and dValidade > CURDATE()";
$matrizes = consulta ( "athenas", $query_matriz );

$query_turmas = "SELECT * FROM turma where dFim > CURDATE() and nCdTurma != " . $turma ["nCdTurma"] . " order by cNmTurma";
$nxtTurmas = consulta ( "athenas", $query_turmas );

$html_curso = "<option value='0'>Selecionar</option>";
foreach ( $cursos as $curso ) {
	$curso_codigo = $curso ["nCdCurso"];
	$curso_nome = $curso ["cNmCurso"];
	$selecionado = "";
	if ($curso_codigo == $turma ["nCdCurso"]) {
		$selecionado = "selected='selected'";
	}
	$html_curso .= "<option value='$curso_codigo' $selecionado >$curso_nome</option>";
}

$html_matriz = "<option value='0'>Selecionar</option>";
foreach ( $matrizes as $matriz ) {
	$matriz_codigo = $matriz ["nCdMatriz"];
	$matriz_nome = $matriz ["cNmMatriz"];
	$selecionado = "";
	if ($matriz_codigo == $turma ["nCdMatriz"]) {
		$selecionado = "selected='selected'";
	}
	$html_matriz .= "<option value='$matriz_codigo' $selecionado >$matriz_nome</option>";
}

$html_turmas = "";
foreach ( $nxtTurmas as $nxtTurma ) {
	$turmaCodigo = $nxtTurma ['nCdTurma'];
	$turmaNome = $nxtTurma ['cNmTurma'];
	$html_turmas .= "<option value='$turmaCodigo'>$turmaNome</option>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Turma]</title>
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
           	url: 'turma_divisao_carregar.php',
           	async	: false,
			data: { curso: _valor },
			success: function(data){
			  			$("#divisoes").html(data);
			 		}
		});
                
	}
    function carregar_alunos(){
      	_valor = <?php echo $_REQUEST['codigo']; ?>   
       	$.ajax({
           	url: 'turma_aluno_carregar.php',
			data: { curso: _valor },
			success: function(data){
			  			$("#lista_alunos").html(data);
			 		}
		});
    }
    function transferir(_matricula, _turma, _status, _chamada){
    	$.ajax({
           	url: 'turma_transferir.php',
			data: { matricula: _matricula
				  , turma: _turma
				  , status: _status
				  , chamada:  _chamada},
			success: function(data){
				carregar_alunos();
			 		}
		});
    }
    $(document).on("change","select[name=atualiza_matricula]", function(){
		if ($(this).val() == "2"){
			$("#transf_matricula").val($(this).attr('matricula'));
			$("#transf_chamada").val($(this).attr('chamada'));
    		$("#dlgTransf").dialog("open");
		} else{
			transferir($(this).attr('matricula'), 0, $(this).val(), $(this).attr('chamada'));
		}
		return false;
    });
	$(document).ready(function(){
		carrega_divisoes();
		carregar_alunos();        
		$( "#tabs" ).tabs();
		$("#dlgTransf").dialog({modal: true, autoOpen: false,width: 300, heigth: 130} );
                $("#divisao_dt_inicio").mask("99/99/9999");
                $("#divisao_dt_fim").mask("99/99/9999");
                $("#divisao_dt_inicio_lcto").mask("99/99/9999");
                $("#divisao_dt_fim_lcto").mask("99/99/9999");
                $("#divisoes_dialog").dialog({modal: true, autoOpen: false,width: 710, heigth: 810} );
                $("a[name=btnIncluir],a[name=btnEditar]").live('click',function(){
                    $("#divisao_codigo").val($(this).attr("codigo"));
                    $("#divisao_nome").val($(this).attr("nome"));
                    $("#divisao_dt_inicio").val($(this).attr("dtinicio"));
                    $("#divisao_dt_fim").val($(this).attr("dtfim"));
                    $("#divisao_dt_inicio_lcto").val($(this).attr("dtinicioLcto"));
                    $("#divisao_dt_fim_lcto").val($(this).attr("dtfimLcto"));
                    $("#divisao_formula").val($(this).attr("formula"));
                    $("#divisao_formulaFalta").val($(this).attr("formulaFalta"));
                    if ($(this).attr("lanca_Nota") == "1"){
                        $("#divisao_lctoNota").attr("checked",true);
                    }else{
                    	$("#divisao_lctoNota").attr("checked",false);
                    }

                    if ($(this).attr("lanca_Falta") == "1"){
                        $("#divisao_lctoFreq").attr("checked",true);
                    }else{
                    	$("#divisao_lctoFreq").attr("checked",false);
                    }

                    if ($(this).attr("lanca_Diario") == "1"){
                        $("#divisao_lctoDiario").attr("checked",true);
                    }else{
                    	$("#divisao_lctoDiario").attr("checked",false);
                    }

                    if ($(this).attr("imprimeFalta") == "1"){
                        $("#divisao_imprimeFalta").attr("checked",true);
                    }else{
                    	$("#divisao_imprimeFalta").attr("checked",false);
                    }
                    
                    $("#divisoes_dialog").dialog("open");                    
                    return false;
                });
                $("#divisao_gravar").click(function(){
                    _codigo        = $("#divisao_codigo").val();
                    _nome 		   = $("#divisao_nome").val();
                    _inicio 	   = $("#divisao_dt_inicio").val();
                    _fim 		   = $("#divisao_dt_fim").val();
                    _inicio_lcto   = $("#divisao_dt_inicio_lcto").val();
                    _fim_lcto 	   = $("#divisao_dt_fim_lcto").val();
                    _formula 	   = $("#divisao_formula").val();
                    _notas         = $("#divisao_lctoNota:checked").val(); 
                    _diario  	   = $("#divisao_lctoDiario:checked").val(); 
                    _frequencia    = $("#divisao_lctoFreq:checked").val(); 
                    _imprimeFalta  = $("#divisao_imprimeFalta:checked").val(); 
                    _formulaFalta  = $("#divisao_formulaFalta").val(); 
                    $.ajax({
					  url: 'turma_divisao_update.php',
					  async	: false,			
					  data: { codigo: _codigo                              
		                                , turma		   : <?php echo $_REQUEST['codigo']; ?>                                
		                                , nome		   : _nome
		                                , inicio	   : _inicio
		                                , fim 		   : _fim
		                                , inicioLcto   : _inicio_lcto
		                                , fimLcto 	   : _fim_lcto
		                                , formula	   : _formula
		                                , notas		   : _notas
		                                , diario       : _diario
		                                , frequencia   : _frequencia
		                                , imprimeFalta : _imprimeFalta
		                                , formulaFalta : _formulaFalta
		                                
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
										  url: 'turma_divisao_remove.php',
										  async	: false,
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
        $("#btnAtualizar").click(function(){
			$.ajax({
				  url: 'turma_update.php',
				  async	: false,			
				  data: { turma: <?php echo $_REQUEST['codigo'];?>
					    , curso : $("#curso").val()
					    , nome  : $("#nome").val()
					    , turno : $("#turno option:selected").val()
					    , vagas : $("#vagas").val()
					    , inicio : $("#inicio").val()
					    , fim : $("#fim").val()
					    , matriz : $("#matriz_curricular").val()
					    , matriculasAbertas : $("#matriculas_abertas:checked").val()
					    , valor : $("#vlrcurso").val()
					    , valorMat : $("#vlrmaterial").val()
					    , prazo : $("#prazo_maximo ").val()
					    , prazoMat : $("#prazo_maximo_mat").val()					    
					    , vcto1 : $("#vcto1").val()
					    , ultvcto : $("#ultvcto").val() 
	                    },				  
				  success: function(){				                			 
				  }
		  
				});
 			alert("Registro Atualizado");			
			return false;
		});
		$("#numerar_automatico").click(function(){
			$.ajax({
	           	url: 'turma_numerar_automaticamente.php',
				data: { turma: <?php echo getRequest('codigo','0'); ?>},
				success: function(data){
					carregar_alunos();
				 		}
			});
			return false;
		});

		$("#transfGravar").click(function(){
			transferir($("#transf_matricula").val(),$("#transf_turma").val(),2,$("#transf_chamada").val());
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
				<div id="divisoes_dialog" title="Divisão">
					<input id="divisao_codigo" type="hidden" /> <label
						style="margin-top: 5px; width: 100px">Nome</label> <input
						id="divisao_nome" type="text" size='20' /> <br /> <label
						style="margin-top: 5px; width: 100px">Dt. Inicial</label> <input
						id="divisao_dt_inicio" type="text" size='10' /> <br /> <label
						style="margin-top: 5px; width: 100px">Dt. Final</label> <input
						id="divisao_dt_fim" type="text" size='10' /> <br /> <br /> <label
						style="margin-top: 5px; width: 100px">Inicio Lcto</label> <input
						id="divisao_dt_inicio_lcto" type="text" size='10' /> <br /> <label
						style="margin-top: 5px; width: 100px">Fim Lcto</label> <input
						id="divisao_dt_fim_lcto" type="text" size='10' /> <br /> <label
						style="margin-top: 5px; width: 100px">Formula</label> <input
						id="divisao_formula" type="text" size='80' /> <br /> <label
						style="margin-top: 5px; width: 100px">Formula Falta</label> <input
						id="divisao_formulaFalta" type="text" size='80' /> <br /> <br /> <label
						style="margin-top: 5px; width: 100px">Lcto de Notas</label> <input
						id="divisao_lctoNota" type="checkbox" value="1" /> <br /> <label
						style="margin-top: 5px; width: 100px">Lcto de Freq</label> <input
						id="divisao_lctoFreq" type="checkbox" value="1" /> <br /> <label
						style="margin-top: 5px; width: 100px">Lcto de Diario</label> <input
						id="divisao_lctoDiario" type="checkbox" value="1" /> <br /> <label
						style="margin-top: 5px; width: 100px">Imprime Falta</label> <input
						id="divisao_imprimeFalta" type="checkbox" value="1" /> <br />
					<div style="text-align: right">
						<a href="" id="divisao_gravar" class="sbtn">Gravar</a>
					</div>
				</div>
				<div id="dlgTransf" title="Transferencia">
					<input id="transf_matricula" type="hidden" /> <input
						id="transf_chamada" type="hidden" /> <label
						style="margin-top: 5px; width: 100px">Transferir Para</label> <select
						id='transf_turma'>
						<option value='0'>Outra Instituição</option>
                        	<?php echo $html_turmas; ?>
                        </select> <br /> <br /> <br /> <a href=""
						id="transfGravar" class="sbtn">Transferir</a>
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral">Cadastro da Turma</a></li>
						<li><a href="#alunos">Alunos</a></li>
						<li><a href="#financeiro">Dados Financeiros</a></li>
					</ul>



					<div id="geral" style='height: 270px; padding-left: 5px'>
						<label style="margin-top: 5px">Nome</label> <input id="nome"
							type="text" size='35' value='<?php echo $turma['cNmTurma']; ?>' />
						<br /> <label style="margin-top: 5px">Curso</label> <select
							id="curso" name="curso">
								<?php echo $html_curso; ?>
							</select> <br /> <label style="margin-top: 5px">Turno</label> <select
							id="turno">
							<option id="M" value="M"
								<?php if($turma['cTurno'] == "M") {echo "selected=selected";} ?>>
								Manh&atilde;</option>
							<option id="T" value="T"
								<?php if($turma['cTurno'] == "T") {echo "selected=selected";} ?>>
								Tarde;</option>
							<option id="N" value="N"
								<?php if($turma['cTurno'] == "N") {echo "selected=selected";} ?>>
								Noite;</option>
						</select> <label
							style="margin-top: 5px; margin-left: 65px; width: 95px">Vagas</label>
						<input id="vagas" size='2' type="text"
							value='<?php echo $turma['nVagas']; ?>' /> <br /> <label
							style="margin-top: 5px">Inicio</label> <input id="inicio"
							size='10' type="text"
							value='<?php echo date("d/m/Y", strtotime($turma['dInicio'])); ?>' />
						<label style="margin-top: 5px; margin-left: 50px; width: 30px">Fim</label>
						<input id="fim" size='10' type="text"
							value='<?php echo date("d/m/Y", strtotime($turma['dFim'])); ?>' />
						<br /> <label style="margin-top: 5px">Matriz C.</label> <select
							id="matriz_curricular" name="curso">
								<?php echo $html_matriz; ?>
							</select> <label
							style="margin-top: 5px; width: 120px; margin-left: 30px">Matriculas
							Abertas</label> <input id="matriculas_abertas" value="1"
							type="checkbox"
							<?php echo $turma['bMatriculasAbertas'] == "1" ? "checked='checked'" : "" ?> />
						<br />
							
						<?php if ($_REQUEST['codigo'] > 0) {?>
                        <div class="divisao">
							<b>Divis&atilde;o</b>
						</div>
						<div id="divisoes" style='height: 130px;'></div>
                        <?php }?>
						</div>

					<div id="alunos" style='height: 270px; padding-left: 5px'>
						<button id='numerar_automatico' class='sbtn2'>Numerar
							Automaticamente</button>
						<table class="tbGrid">
							<thead>
								<tr>
									<td width="40px"></td>
									<td width="40px">Nr</td>
									<td>Nome</td>
									<td width="120px">Matricula</td>
									<td width="10px">&nbsp;</td>
									<td width="10px">&nbsp;</td>
									<td width="100px">Situação</td>

								</tr>
							</thead>
						</table>
						<div id="lista_alunos" style='height: 250px; overflow: scroll;'></div>
					</div>
					<div id="financeiro" style='height: 270px; padding-left: 5px'>
						<label style="margin-top: 5px; width: 130px">Valor Curso</label> <input
							id="vlrcurso" name="vlrcurso" size='10' type="text"
							value='<?php echo $turma['nVlrCurso']; ?>' /> <label
							style="margin-top: 5px; width: 130px">Prazo Maximo(Curso)</label>
						<input id="prazo_maximo" name="prazo_maximo" size='10' type="text"
							value='<?php echo $turma['nCursoPrazoMax']; ?>' /> <br /> <label
							style="margin-top: 5px; width: 130px">Valor Material</label> <input
							id="vlrmaterial" name="bairro" type="text" size='10'
							value='<?php echo $turma['nVlrMaterial']; ?>' /> <label
							style="margin-top: 5px; width: 130px">Prazo Maximo(Mat)</label> <input
							id="prazo_maximo_mat" name="prazo_maximo_mat" type="text"
							size='10' value='<?php echo $turma['nMaterialPrazoMax']; ?>' /> <br />
						<br /> <br /> <label style="margin-top: 5px; width: 130px">Data 1º
							Pgto</label> <input id="vcto1" name="vcto1" type="text" size='10'
							value='<?php echo $turma['nMes1vcto']; ?>' /> <label
							style="margin-top: 5px; width: 130px">Data Ult Pgto</label> <input
							id="ultvcto" name="ultvcto" type="text" size='10'
							value='<?php echo $turma['cMesAnoUltima']; ?>' /> <br />


					</div>


				</div>
				<br />
				<button id="btnAtualizar" class="sbtn2">Atualizar</button>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>

