<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$query_professor = "select * from professor where nCPF = " . $_REQUEST ['cpf'];
$registros = consulta ( "athenas", $query_professor );
$registro = $registros [0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Matricula]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/jvalidacpf.js" type="text/javascript"></script>
<script>
	      	function selectitem(objecValuetId, value, objectTextId, text){		      	
	      		$("#professor").val(text);
	      		$("#professor_codigo").val(value);
	      		carregar_campos_professor(value);	      		
	    		$( "#dlgConsultaPessoa" ).dialog("close");
	    		return false;	    		
	    	}
	    	function carregar_campos_professor(codigo){
	    		$.ajax({
					  url: '../Secretaria/search.php',
					  dataType: 'json',
					  data: { consulta: 'pessoa',cpf:codigo  },
					  
					  success: function(json){
					  	$("#professor_nome").val(json.cNome);
					  	$("#professor").val(json.cNome);
					  	$("#professor_endereco_res").val(json.cLogradouro);
					  	$("#professor_codigo").val(json.nCdPessoa);
					  	$("#professor_endereco_complemento_res").val(json.cComplelemnto);
					  	$("#professor_cep_res").val(json.nCEPFormatado);
					  	$("#professor_cidade").val(json.cCidade);
					  	$("#professor_bairro").val(json.cBairro);
					  	$("#professor_uf").val(json.cUF);
					  	$("#professor_cpf").val(json.nCPFFormatado);
					  	$("#professor_rg").val(json.cRG);
					  	$("#professor_dt_nasc").val(json.dNascFormatado);
					  	$("#professor_naturalidade").val(json.cNaturalidade);
					  	$("#professor_naturalidade_uf").val(json.cNaturalidadeUf);
					  	$("#professor_nacionalidade").val(json.cNacionalidade);
					  	$("#professor_email").val(json.cEmail);
					  	$("#professor_pai").val(json.cFiliacaoPai);
					  	$("#professor_mae").val(json.cFiliacaoMae);					  	
					  	$("#professor_profissao").val(json.cProfissao);
					  	$("#professor_estcivil").val(json.nCdEstadoCivil);
					  	$("#professor_cep_com").val(json.cEnd_com_cepFormatado);
					  	$("#professor_endereco_com").val(json.cEnd_com_end);
					  	$("#professor_bairro_com").val(json.cEnd_com_bairro);
					  	$("#professor_cidade_com").val(json.cEnd_com_cidade);
					  	$("#professor_uf_com").val(json.cEnd_com_uf);					  	
					  	$("#idchange").val("0");					  	
					  },
				beforeSend:function(){
						$("#div_loading").show();
				},
				complete: function(data){
						$("#div_loading").hide();
				}
	    		});
	    	}	    		    
	    	function verifica_alteracao_professor(){
	    		if ($("#idchange").val() == "1"){
	    			if ($("#idchange").val() == "1"){		    		
      					$("<div title='Aviso'></div>").appendTo('body')
                						.html("<center><span style='font-size:small'>Os dados do Professor foram alterados <br/> Escolha uma opção:</span></center>")
                						.dialog({ modal: true
                								, title: 'Aviso'
                								, zIndex: 10000
                								, autoOpen: true
                								, width: 'auto'
                								, resizable: false
                								, buttons: { "ALTERAR Professor": function () {
                													$(this).dialog("close");
								                           		  }
								                           , "INCLUIR Professor": function () {
								                               	 	$(this).dialog("close");
								                               	 $("#professor_codigo").val("0");
								                            	  }
						                        },
						                        close: function (event, ui) {
						                            $(this).remove();
						                        }
                								});
      					
		    		}
	    		}	
		    }
	    	$(document).on("click","img[name=disponibilidade_remover]", function(){		
	    		
				var _row = $(this).parent().parent();
				var _input = $(_row).find("input");                    		 
			    $("<div title='Aviso'></div>").appendTo('body')
					.html("<center><span style='font-size:small'>Deseja Remover Disponibilidade?</span></center>")
					.dialog({ modal: true
							, title: 'Aviso'
							, zIndex: 10000
							, autoOpen: true
							, width: 'auto'
							, resizable: false
							, buttons: { Sim: function () {				
												_row.hide();
												_input.val("E");									
										  		$(this).dialog("close");													
			                           		  }
			                           , Nao: function () {
			                               	 	$(this).dialog("close");
			                           		  }
		                    			}
		                    , close: function (event, ui) {
		                       		 	$(this).remove();
		                    		 }
							}); 
				
					return false;
	    	});	    	
			$(document).ready(function() {			
				carregar_campos_professor(<?php echo $_REQUEST['cpf']; ?>);
				$("#dlgConsultaPessoa").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
				$("#dlgPessoaProfessor").dialog( {modal: true, autoOpen: false, width: 800, height: 400, close: function(event, ui) { verifica_alteracao_professor(); }} );				
				$( "#professor_btnpesq" ).click(function(){		        						
		        	$( "#dlgConsultaPessoa" ).dialog("open");		        
		        	return false;
		        });				
		        $("#btnAltProfessor").click(function(){
		        	$( "#dlgPessoaProfessor" ).dialog("open");
		        	return false;
			    });		        
				$("#professor_cpf").mask("999.999.999-99");				
				$("#professor_cep_res").mask("99999-999");
				$("#professor_cep_com").mask("99999-999");
				$("#professor_dt_nasc").mask("99/99/9999");												
				$("#professor_nome").change(function(){$("#professor").val($(this).val());});				
		        $("#tabs").tabs();		        		   		             
			    $("input").change(function(){
				    if ($(this).attr("name").substring(0,10) == "professor_"){
					    $("#idchange").val("1");
				    }
				});
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
					var _disponibilidade_add_inicio = $("#disponibilidade_add_inicio").val();
				    var _disponibilidade_add_fim = $("#disponibilidade_add_fim").val();
					var _disponibilidade_par_impar = $("#disponibilidade_par_impar").val();
					var _disponibilidade_turno = $("#disponibilidade_turno").val();
					var _disponibilidade_turno_str = $("#disponibilidade_turno option:selected").text();
					var _disponibilidade_seg_inicio = $("#disponibilidade_seg_inicio").val();
					var _disponibilidade_seg_fim = $("#disponibilidade_seg_fim").val();
					var _disponibilidade_ter_inicio =$("#disponibilidade_ter_inicio").val();
					var _disponibilidade_ter_fim = $("#disponibilidade_ter_fim").val();
					var _disponibilidade_qua_inicio = $("#disponibilidade_qua_inicio").val();
					var _disponibilidade_qua_fim = $("#disponibilidade_qua_fim").val();
					var _disponibilidade_qui_inicio = $("#disponibilidade_qui_inicio").val();
					var _disponibilidade_qui_fim = $("#disponibilidade_qui_fim").val();
					var _disponibilidade_sex_inicio = $("#disponibilidade_sex_inicio").val();
					var _disponibilidade_sex_fim = $("#disponibilidade_sex_fim").val();

					var _disponbilidade_par_impar_str = "";
					if ( _disponibilidade_par_impar == 1 ){
						_disponbilidade_par_impar_str = "Somente dias pares";
					}
					if ( _disponibilidade_par_impar == 2 ){
						_disponbilidade_par_impar_str = "Somente dias impares";
					}				
					
					 $("#tbProfessorDisponibilidade").last().append("<tr>"+
					  "<td  width='20px'><img src='../image/remove_icon.png' name='disponibilidade_remover' codigo=$codigo' height='15px' title='Excluir Disponibilidade'/></td>"+
					  "<td width='150px' valing='top'>"+_disponibilidade_add_inicio+"</td>"+
					  "<td width='150px' valing='top'>"+_disponibilidade_add_fim+"</td>"+
					  "<td width='50px' valing='top'>"+_disponibilidade_turno_str+"</td>"+
					  "<td width='100px' valing='top'>"+_disponibilidade_seg_inicio+" - "+_disponibilidade_seg_fim+"</td>"+
					  "<td width='100px' valing='top'>"+_disponibilidade_ter_inicio+" - "+_disponibilidade_ter_fim+"</td>"+
					  "<td width='100px' valing='top'>"+_disponibilidade_qua_inicio+" - "+_disponibilidade_qua_fim+"</td>"+
					  "<td width='100px' valing='top'>"+_disponibilidade_qui_inicio+" - "+_disponibilidade_qui_fim+"</td>"+
					  "<td width='100px' valing='top'>"+_disponibilidade_sex_inicio+" - "+_disponibilidade_sex_fim+"</td>"+
					  "<td width='250px' valing='top'>"+_disponbilidade_par_impar_str+"</td>"+
					  "<td><input type='hidden' name='action_disponibilidade' value='A' "+
					  " codigo = '0'"+
					  " disponibilidade_add_inicio = '"+_disponibilidade_add_inicio+"'"+
					  " disponibilidade_add_fim = '"+_disponibilidade_add_fim+"'"+
					  " disponibilidade_turno = '"+_disponibilidade_turno+"'"+
					  " disponibilidade_seg_inicio = '"+_disponibilidade_seg_inicio+"'"+
					  " disponibilidade_seg_fim = '"+_disponibilidade_seg_fim+"'"+
					  " disponibilidade_ter_inicio = '"+_disponibilidade_ter_inicio+"'"+
					  " disponibilidade_ter_fim = '"+_disponibilidade_ter_fim+"'"+
					  " disponibilidade_qua_inicio = '"+_disponibilidade_qua_inicio+"'"+
					  " disponibilidade_qua_fim = '"+_disponibilidade_qua_fim+"'"+
					  " disponibilidade_qui_inicio = '"+_disponibilidade_qui_inicio+"'"+
					  " disponibilidade_qui_fim = '"+_disponibilidade_qui_fim+"'"+
					  " disponibilidade_sex_inicio = '"+_disponibilidade_sex_inicio+"'"+
					  " disponibilidade_sex_fim = '"+_disponibilidade_sex_fim+"'"+
					  " disponibilidade_par_impar = '"+_disponibilidade_par_impar+"'"+					  				
					  "/></td>"+
					  "</tr>");  

					 return false;					
				});
				 
				 $("#disciplina_gravar").click(function(){
					 var _codigo = $("#disciplina_disciplina").val();
					 var _nome   = $("#disciplina_disciplina option:selected").text();
					 var _sigla  = $("#disciplina_disciplina option:selected").attr('sigla');
					 $("#tbProfessorDisciplina").last().append("<tr>"+
					  "<td  width='20px'><img src='../image/remove_icon.png' name='disciplina_remover' height='15px' title='Excluir Disciplina'/></td>"+
					  "<td width='250px' valing='top'>"+_nome+"</td>"+
					  "<td width='150px' valing='top'>"+_sigla+"</td>"+
					  "<td><input type='hidden' name='disciplina_action' codigo='"+_codigo+"' value='A' ></td></tr>" );

					 return false;					
					 
				 });				  
					
				$("img[name=disciplina_remover]").live('click',function(){
					var _row = $(this).parent().parent();
                    var _input = $(_row).find("input");
                    var _codigo = $(this).attr("codigo");  
					$("<div title='Aviso'></div>").appendTo('body')
						.html("<center><span style='font-size:small'>Deseja Remover Disciplina?</span></center>")
						.dialog({ modal: true
								, title: 'Aviso'
								, zIndex: 10000
								, autoOpen: true
								, width: 'auto'
								, resizable: false
								, buttons: { Sim: function () {				
													_row.hide();
													_input.val("E");									
												  	$(this).dialog("close");
					                           	  }
					                       , Nao: function () {
					                       			$(this).dialog("close");
					                              }
				                    	   }
                 	   			, close: function (event, ui) {
                     	   					$(this).remove();
				                    	 }
								}); 
					return false;
			 	});
			 	$("#btnAtualizar").click(function(){
				 	//atualizar_dados_cadastrais
				 	var _professor_param = "";		        	
					$("input[type='text'],input[type='hidden']").each(function(i){
						if ( typeof $(this).attr("name") !==  'undefined' ){
							_professor_param = _professor_param + "&" + $(this).attr("name") + "=" + $(this).val();
						}
					});
					$("input[type='checkbox']").each(function(i){
						if ( $(this).is(':checked') ){
							if ( typeof $(this).attr("name") !==  'undefined' ){
								_professor_param = _professor_param + "&" + $(this).attr("name") + "=" + $(this).val();
							}
						}
					});
					$("select").each(function(i){
						if ( typeof $(this).attr("name") !==  'undefined' ){
							_professor_param = _professor_param + "&" + $(this).attr("name") + "=" + $(this).val();
						}
					});			
					
					$.get('professor_atualiza_cadastro.php?'+_professor_param);
				 	//atualizar categoria
				 	
				 	
				 	$("input[name='disciplina_action']").each(function(){
					 	if ($(this).val() == "E"){
					 		$.ajax({
								  url: 'professor_disciplina_update.php',
								  async	: false,
								  data: { disciplina: $(this).attr("codigo")
									    , professor : $("#professor_cpf").val()
									    , action	: "E"
									  	},
									beforeSend:function(){
										$("#div_loading").show();
									},
									complete: function(data){
										$("#div_loading").hide();
									}
				 			});
					 	}
					});
				 	$("input[name='disciplina_action']").each(function(){
				 		if ($(this).val() == "A"){
				 			$.ajax({
								  url: 'professor_disciplina_update.php',
								  async	: false,
								  data: { disciplina: $(this).attr("codigo")
									  	, professor : $("#professor_cpf").val()
									  	, action	: "A"
									  	},
									beforeSend:function(){
										$("#div_loading").show();
									},
									complete: function(data){
										$("#div_loading").hide();
									}
				 			});
					 	}
				 	});					
				 	$("input[name='action_disponibilidade']").each(function(){
					 	
					 	if ($(this).val() == "E"){
					 		
					 		$.ajax({
								  url: 'professor_disponibilidade_update.php',
								  async	: false,
								  data: { codigo:$(this).attr("codigo")
									    , professor : $("#professor_cpf").val()
									    , action:"E"
									  	},
									beforeSend:function(){
										$("#div_loading").show();
									},
									complete: function(data){
										$("#div_loading").hide();
									}
									
				 			});
					 	}
					});
				 	$("input[name='action_disponibilidade']").each(function(){
				 		
				 		if ($(this).val() == "A"){
				 			
				 			$.ajax({
								  url: 'professor_disponibilidade_update.php',
								  async	: false,
								  data: { disponibilidade_add_inicio: $(this).attr("disponibilidade_add_inicio")
									    , disponibilidade_add_fim: $(this).attr("disponibilidade_add_fim")
										, disponibilidade_par_impar: $(this).attr("disponibilidade_par_impar")
										, disponibilidade_turno: $(this).attr("disponibilidade_turno")
										, disponibilidade_seg_inicio:$(this).attr("disponibilidade_seg_inicio")
										, disponibilidade_seg_fim : $(this).attr("disponibilidade_seg_fim")
										, disponibilidade_ter_inicio : $(this).attr("disponibilidade_ter_inicio")
										, disponibilidade_ter_fim : $(this).attr("disponibilidade_ter_fim")
										, disponibilidade_qua_inicio : $(this).attr("disponibilidade_qua_inicio")
										, disponibilidade_qua_fim : $(this).attr("disponibilidade_qua_fim")
										, disponibilidade_qui_inicio : $(this).attr("disponibilidade_qui_inicio")
										, disponibilidade_qui_fim : $(this).attr("disponibilidade_qui_fim")
										, disponibilidade_sex_inicio :$(this).attr("disponibilidade_sex_inicio")
										, disponibilidade_sex_fim :$(this).attr("disponibilidade_sex_fim")
										, professor : $("#professor_cpf").val()
									    , action:"A"
									  	},
									beforeSend:function(){
									 	$("#div_loading").show();
									},
									complete: function(data){
									  	$("#div_loading").hide();
									}								  								 
							});
							
						 	
					 	}
					});
				 	alert("Professor Atualizado com Sucesso");					 		
				 	window.location.replace("professor_consultar.php");
					return false;
		    });			
		});			
    	</script>
</head>
<body>
	<div id="container">
			<?php include "../loading.inc"?>
'			<?php include "../header.inc"?>
			<div id="menu"><?php include "../menu.inc"; ?></div>
		<div id="content">
			<div id="dlgConsultaPessoa" title="Consulta Pessoa">
				<iframe src="../Pessoa/consultar_popup.php?popup=sim"
					frameborder="0" width="680" height="300"></iframe>
			</div>

			<form name="frm1" id="frm1" method="post" action="verificafin.php">
				<div id="dlgPessoaProfessor" title="Dados Cadastrais - Professor">
					<label style="margin-top: 5px">CPF</label> <input
						id="professor_cpf" name="professor_cpf" type="text" size='21' /><img
						src="../image/search-icon.png" name="professor_btnpesq"
						id="professor_btnpesq" height="15px"> <label
						style="margin-top: 5px; width: 22px; margin-left: 15px">RG</label>
						<input id="professor_rg" name="professor_rg" type="text" size='18' />
						<br /> <label style="margin-top: 5px">Nome</label> <input
						id="professor_nome" name="professor_nome" type="text" size='50' />
						<br /> <label style="margin-top: 5px">Dt. Nasc.</label> <input
						id="professor_dt_nasc" name="professor_dt_nasc" type="text"
						size='20' /> <br /> <label style="margin-top: 5px">Naturalidade</label>
						<input id="professor_naturalidade" name="professor_naturalidade"
						type="text" size='39' /> <label
						style="margin-top: 5px; margin-left: 10px; width: 20px">UF</label>
						<input id="professor_naturalidade_uf"
						name="professor_naturalidade_uf" type="text" size='3' /> <br /> <label
						style="margin-top: 5px">Nacionalidade</label> <input
						id="professor_nacionalidade" name="professor_nacionalidade"
						type="text" size='39' /> <br /> <label style="margin-top: 5px">Profissao</label>
						<input id="professor_profissao" name="professor_profissao"
						type="text" size='20' /> <label style="margin-top: 5px"
						id="professor_estcivil">Estado Civil</label> <select
						name="professor_estcivil">
							<option value="0">SELECIONE</option>
							<option value="1">SOLTEIRO(A)</option>
							<option value="2">CASADO(A)</option>
							<option value="3">DIVORCIADO(A)</option>
							<option value="4">VIUVO(A)</option>
					</select> <br /> <label style="margin-top: 5px">Pai</label> <input
						id="professor_pai" name="professor_pai" type="text" size='50' /> <br />
						<label style="margin-top: 5px">Mae</label> <input
						id="professor_mae" name="professor_mae" type="text" size='50' /> <br />
						<label style="margin-top: 5px">Email</label> <input
						id="professor_email" name="professor_email" type="text" size='50' />
						<br />
						<div class="divisao">Endereço Residencial</div> <label
						style="margin-top: 5px">CEP</label> <input id="professor_cep_res"
						name="professor_cep_res" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="professor_endereco_res" name="professor_endereco_res"
						size='50' type="text" /> <label style="margin-top: 5px">Complemento</label>
						<input id="professor_endereco_complemento_res"
						name="professor_endereco_complemento_res" size='10' type="text" />
						<br /> <label style="margin-top: 5px">Bairro</label> <input
						id="professor_bairro" name="professor_bairro" type="text"
						size='30' /> <label style="margin-top: 5px">Cidade</label> <input
						id="professor_cidade" name="professor_cidade" type="text"
						size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="professor_uf" name="professor_uf" type="text" size='3' />
						<div class="divisao">Endereço Comercial</div> <label
						style="margin-top: 5px">CEP</label> <input id="professor_cep_com"
						name="professor_cep_com" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="professor_endereco_com" name="professor_endereco_com"
						size='50' type="text" /> <br /> <label style="margin-top: 5px">Bairro</label>
						<input id="professor_bairro_com" name="professor_bairro_com"
						type="text" size='30' /> <label style="margin-top: 5px">Cidade</label>
						<input id="professor_cidade_com" name="professor_cidade_com"
						type="text" size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="professor_uf_com" name="professor_uf_com" type="text"
						size='3' /> <br />
						<div class='divisao'>Telefones</div> <input size="6" name='ddd'
						id='professor_ddd' /> <input size="14" name='telefone'
						id='professor_telefone' /> <a href="" id='professor_incluir_tel'>[Incluir]</a>
						<table>
							<tr style="background-color: black; color: white">
								<td width="50px">DDD</td>
								<td width="150px">Telefone</td>
							</tr>
						</table>
						<div id='professor_telefone'
							style='height: 150px; width: 210px; overflow-y: auto'>
							<table id="professor_telefones"></table>
						</div>
				
				</div>

				<div id="tabs">
					<ul>
						<li><a href="#cadastro">Dados Cadastrais</a></li>
						<li><a href="#disponibilidade">Disponibilidade</a></li>
						<li><a href="#disciplinas">Disciplinas</a></li>

					</ul>
					<div id="cadastro"
						style='height: 285px; padding-left: 5px; padding-top: 0; overflow: auto'>

						<div class="divisao">Dados Cadastrais</div>
						<label>Aluno: </label> <input id="professor" size="50"
							readonly="readonly" />
						<button id="btnAltProfessor" class='sbtn2'>Alterar</button>
						<input type='hidden' id='campo_change' /> <input type='hidden'
							id='idchange' name="idchange" /> <input type='hidden'
							id='professor_codigo' name='professor_codigo' /> <br />
						<div class="divisao">Categoria</div>
						<input type="checkbox" value="1" name="catEI" id="catEI"
							<?php echo $registro["bInfantil"] == "0" ? "" : "checked='checked'" ?> />Educação
						Infantil <br /> <input type="checkbox" value="1" name="catF1"
							id="catF1"
							<?php echo $registro["bFundI"] == "0" ? "" : "checked='checked'" ?> />Fundamental
						I <br /> <input type="checkbox" value="1" name="catF2" id="catF2"
							<?php echo $registro["bFundII"] == "0" ? "" : "checked='checked'" ?> />Fundamental
						II <br /> <input type="checkbox" value="1" name="catEM" id="catEM"
							<?php echo $registro["bMedio"] == "0" ? "" : "checked='checked'" ?> />Ensino
						Médio <br /> <input type="checkbox" value="1" name="catTC"
							id="catTC"
							<?php echo $registro["bTecnico"] == "0" ? "" : "checked='checked'" ?> />Ensino
						Técnico

					</div>
					<div id="disponibilidade"
						style='height: 270px; padding-left: 5px; overflow: auto'>
						<div id="disponibilidade_dialog" title="Incluir Disponibilidade">
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
							style="height: 210px; overflow: auto">
								<?php include "professor_disponibilidade.php"?>
							</div>
					</div>
					<div id="disciplinas"
						style='height: 270px; padding-left: 5px; overflow: auto'>
						<div id="disciplina_dialog" title="Incluir Disciplina">
							<label style='margin-top: 5px; width: 100px'>Disciplina</label> <select
								id="disciplina_disciplina">
		                	 	 	<?php
																							$query = "Select * from disciplina order by cNmDisciplina";
																							$disciplinas = consulta ( "athenas", $query );
																							foreach ( $disciplinas as $disciplina ) {
																								$sigla = $disciplina ['cSigla'];
																								echo "<option value='" . $disciplina ['nCdDisciplina'] . "' sigla = '$sigla'>" . $disciplina ['cNmDisciplina'] . " (" . $disciplina ['cSigla'] . ")</option>";
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
							style="height: 210px; overflow: auto">
								<?php include "professor_disciplina.php"?>
							</div>
					</div>
				</div>
				<br />
				<button id='btnAtualizar' class="sbtn2">Atualizar</button>
			</form>
		</div>             
			<?php include "../footer.inc"?>
		</div>
</body>
</html>
