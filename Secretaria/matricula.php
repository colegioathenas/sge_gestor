<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
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
		      	if ($("#campo_change").val() == "aluno"){
			      	$("#aluno").val(text);
			      	$("#aluno_codigo").val(value);
			      	carregar_campos_aluno(value);
		      	}else{
		      		$("#respfin").val(text);
		      		$("#respfin_codigo").val(value);
		      		carregar_campos_respfin(value);
		      	}
	    		$( "#dlgConsultaPessoa" ).dialog("close");
	    		return false;
	    		
	    	}
	    	function carregar_campos_aluno(codigo){
	    		$.ajax({
					  url: '../Secretaria/search.php',
					  dataType: 'json',
					  data: { consulta: 'pessoa',cpf:codigo  },
					  
					  success: function(json){
					  	$("#aluno_nome").val(json.cNome);
					  	$("#aluno_endereco_res").val(json.cLogradouro);
					  	$("#aluno_codigo").val(json.nCdPessoa);
					  	$("#aluno_endereco_complemento_res").val(json.cComplelemnto);
					  	$("#aluno_cep_res").val(json.nCEPFormatado);
					  	$("#aluno_cidade").val(json.cCidade);
					  	$("#aluno_bairro").val(json.cBairro);
					  	$("#aluno_uf").val(json.cUF);
					  	$("#aluno_cpf").val(json.nCPFFormatado);
					  	$("#aluno_rg").val(json.cRG);
					  	$("#aluno_dt_nasc").val(json.dNascFormatado);
					  	$("#aluno_naturalidade").val(json.cNaturalidade);
					  	$("#aluno_naturalidade_uf").val(json.cNaturalidadeUf);
					  	$("#aluno_nacionalidade").val(json.cNacionalidade);
					  	$("#aluno_email").val(json.cEmail);
					  	$("#aluno_pai").val(json.cFiliacaoPai);
					  	$("#aluno_mae").val(json.cFiliacaoMae);					  	
					  	$("#aluno_profissao").val(json.cProfissao);
					  	$("#aluno_estcivil").val(json.nCdEstadoCivil);
					  	$("#aluno_cep_com").val(json.cEnd_com_cepFormatado);
					  	$("#aluno_endereco_com").val(json.cEnd_com_end);
					  	$("#aluno_bairro_com").val(json.cEnd_com_bairro);
					  	$("#aluno_cidade_com").val(json.cEnd_com_cidade);
					  	$("#aluno_uf_com").val(json.cEnd_com_uf);
					  	carregar_campos_respfin(json.nCdRespFin);
					  	$("#idchange").val("0");					  	
					  }
	    		});
	    	}
	    	function carregar_campos_respfin(codigo){
	    		$.ajax({
					  url: '../Secretaria/search.php',
					  dataType: 'json',
					  data: { consulta: 'pessoa',cpf:codigo  },
					  
					  success: function(json){
					  	$("#respfin_nome").val(json.cNome);
					  	$("#respfin").val(json.cNome);
					  	$("#respfin_endereco_res").val(json.cLogradouro);
					  	$("#respfin_codigo").val(json.nCdPessoa);
					  	$("#respfin_endereco_complemento_res").val(json.cComplelemnto);
					  	$("#respfin_cep_res").val(json.nCEPFormatado);
					  	$("#respfin_cidade").val(json.cCidade);
					  	$("#respfin_bairro").val(json.cBairro);
					  	$("#respfin_uf").val(json.cUF);
					  	$("#respfin_cpf").val(json.nCPFFormatado);
					  	$("#respfin_rg").val(json.cRG);
					  	$("#respfin_dt_nasc").val(json.dNascFormatado);
					  	$("#respfin_naturalidade").val(json.cNaturalidade);
					  	$("#respfin_naturalidade_uf").val(json.cNaturalidadeUf);
					  	$("#respfin_nacionalidade").val(json.cNacionalidade);
					  	$("#respfin_email").val(json.cEmail);
					  	$("#respfin_pai").val(json.cFiliacaoPai);
					  	$("#respfin_mae").val(json.cFiliacaoMae);					  	
					  	$("#respfin_profissao").val(json.cProfissao);
					  	$("#respfin_estcivil").val(json.nCdEstadoCivil);
					  	$("#respfin_cep_com").val(json.cEnd_com_cepFormatado);
					  	$("#respfin_endereco_com").val(json.cEnd_com_end);
					  	$("#respfin_bairro_com").val(json.cEnd_com_bairro);
					  	$("#respfin_cidade_com").val(json.cEnd_com_cidade);
					  	$("#respfin_uf_com").val(json.cEnd_com_uf);
					  	$("#idchange").val("0");					  	
					  }
	    		});
	    	}
	    	function verifica_alteracao_respfin(){
		    	if ($("#idchange").val() == "1"){		    		
      					$("<div title='Aviso'></div>").appendTo('body')
                						.html("<center><span style='font-size:small'>Os dados do Responsavel Finaceiro foram alterados <br/> Escolha uma opção:</span></center>")
                						.dialog({ modal: true
                								, title: 'Aviso'
                								, zIndex: 10000
                								, autoOpen: true
                								, width: 'auto'
                								, resizable: false
                								, buttons: { "ALTERAR Responsável": function () {
                													$(this).dialog("close");
                													$("#idchange").val("0");	
								                           		  }
								                           , "INCLUIR Responsável": function () {
								                               	 	$(this).dialog("close");
								                               	 $("#idchange").val("0");	
								                               	 $("#respfin_codigo").val("0");
								                            	  }
						                        },
						                        close: function (event, ui) {
						                            $(this).remove();
						                        }
                								});
      					
		    	}
		    }
	    	function verifica_alteracao_aluno(){
	    		if ($("#idchange").val() == "1"){
	    			if ($("#idchange").val() == "1"){		    		
      					$("<div title='Aviso'></div>").appendTo('body')
                						.html("<center><span style='font-size:small'>Os dados do Aluno foram alterados <br/> Escolha uma opção:</span></center>")
                						.dialog({ modal: true
                								, title: 'Aviso'
                								, zIndex: 10000
                								, autoOpen: true
                								, width: 'auto'
                								, resizable: false
                								, buttons: { "ALTERAR Aluno": function () {
                													$(this).dialog("close");
								                           		  }
								                           , "INCLUIR Aluno": function () {
								                               	 	$(this).dialog("close");
								                               	 $("#aluno_codigo").val("0");
								                            	  }
						                        },
						                        close: function (event, ui) {
						                            $(this).remove();
						                        }
                								});
      					
		    		}
	    		}	
		    }
	    		    	
			$(document).ready(function() {
				$("#dlgConsultaPessoa").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
				$("#dlgPessoaAluno").dialog( {modal: true, autoOpen: false, width: 800, height: 400, close: function(event, ui) { verifica_alteracao_aluno(); }} );
				$("#dlgPessoaRespFin").dialog( {modal: true, autoOpen: false, width: 800, height: 400, close: function(event, ui) { verifica_alteracao_respfin(); }});
				$( "#aluno_btnpesq,#respfin_btnpesq" ).click(function(){		        	
					$("#campo_change").val($(this).attr("campo"));
		        	$( "#dlgConsultaPessoa" ).dialog("open");		        
		        	return false;
		        });				
		        $("#btnAltAluno").click(function(){
		        	$( "#dlgPessoaAluno" ).dialog("open");
		        	return false;
			    });
		        $("#btnAltRespFin").click(function(){
		        	$( "#dlgPessoaRespFin" ).dialog("open");
		        	return false;
			    });
				$("#aluno_cpf").mask("999.999.999-99");				
				$("#aluno_cep_res").mask("99999-999");
				$("#aluno_cep_com").mask("99999-999");
				$("#aluno_dt_nasc").mask("99/99/9999");

				$("#respfin_cpf").mask("999.999.999-99");				
				$("#respfin_cep_res").mask("99999-999");
				$("#respfin_cep_com").mask("99999-999");
				$("#respfin_dt_nasc").mask("99/99/9999");
				
				$("#vcto1").mask("99/9999");
				$("#vcto1_mat").mask("99/9999");
				
				$("#serie").change(function(){
					$("#turma").load('carrega_turno.php?curso='+$(this).val());					
				});
				$("#turma").change(function(){
					$("#vlr_anuidade").val($("#turma option:selected").attr("vlr_anuidade"));
					$("#vlr_material").val($("#turma option:selected").attr("vlr_material"));
					$("#anuidade").load('carrega_financeiro.php?consulta=anuidade&turma='+$(this).val());
					$("#material").load('carrega_financeiro.php?consulta=material&turma='+$(this).val());										
					$("#desconto").val($("#turma option:selected").attr("vlr_desconto"));
							
				});
				$("#aluno_nome").change(function(){$("#aluno").val($(this).val());});
				$("#respfin_nome").change(function(){$("#respfin").val($(this).val());});
		        $("#tabs").tabs();		        
		        $("#avancar").click(function(){
			        var _txt = "";		        	
					$("input").each(function(i){
						if ( typeof $(this).attr("name") !==  'undefined' ){							
							_txt = _txt + "&" + $(this).attr("name") + "=" + $(this).val();
						}
					});
					$("select").each(function(i){
						if ( typeof $(this).attr("name") !==  'undefined' ){
							_txt = _txt + "&" + $(this).attr("name") + "=" + $(this).val();
						}
					});			
					if ($("#respfin_oMesmo").is(':checked')){
						_txt = _txt + "&respfin_oMesmo=1";
					}else{
						_txt = _txt + "&respfin_oMesmo=0";
					}
					window.location.href = "verificafin.php?"+_txt;
					return false;
			    });
			    $("input").change(function(){
				    if (($(this).attr("name").substring(0,8) == "respfin_") || ($(this).attr("name").substring(0,6) == "aluno_")){
					    $("#idchange").val("1");
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
			<div id="dlgConsultaPessoa" title="Consulta Pessoa">
				<iframe src="../Pessoa/consultar_popup.php?popup=sim"
					frameborder="0" width="680" height="300"></iframe>
			</div>

			<form name="frm1" id="frm1" method="post" action="verificafin.php">
				<div id="dlgPessoaAluno" title="Dados Cadastrais - Aluno">
					<label style="margin-top: 5px">CPF</label> <input id="aluno_cpf"
						name="aluno_cpf" type="text" size='21' /><img
						src="../image/search-icon.png" name="aluno_btnpesq"
						id="aluno_btnpesq" campo="aluno" height="15px"> <label
						style="margin-top: 5px; width: 22px; margin-left: 15px">RG</label>
						<input id="aluno_rg" name="aluno_rg" type="text" size='18' /> <br />
						<label style="margin-top: 5px">Nome</label> <input id="aluno_nome"
						name="aluno_nome" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Dt. Nasc.</label> <input
						id="aluno_dt_nasc" name="aluno_dt_nasc" type="text" size='20' /> <br />
						<label style="margin-top: 5px">Naturalidade</label> <input
						id="aluno_naturalidade" name="aluno_naturalidade" type="text"
						size='39' /> <label
						style="margin-top: 5px; margin-left: 10px; width: 20px">UF</label>
						<input id="aluno_naturalidade_uf" name="aluno_naturalidade_uf"
						type="text" size='3' /> <br /> <label style="margin-top: 5px">Nacionalidade</label>
						<input id="aluno_nacionalidade" name="aluno_nacionalidade"
						type="text" size='39' /> <br /> <label style="margin-top: 5px">Profissao</label>
						<input id="aluno_profissao" name="aluno_profissao" type="text"
						size='20' /> <label style="margin-top: 5px" id="aluno_estcivil">Estado
							Civil</label> <select name="aluno_estcivil">
							<option value="0">SELECIONE</option>
							<option value="1">SOLTEIRO(A)</option>
							<option value="2">CASADO(A)</option>
							<option value="3">DIVORCIADO(A)</option>
							<option value="4">VIUVO(A)</option>
					</select> <br /> <label style="margin-top: 5px">Pai</label> <input
						id="aluno_pai" name="aluno_pai" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Mae</label> <input id="aluno_mae"
						name="aluno_mae" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Email</label> <input id="aluno_email"
						name="aluno_email" type="text" size='50' /> <br />
						<div class="divisao">Endereço Residencial</div> <label
						style="margin-top: 5px">CEP</label> <input id="aluno_cep_res"
						name="aluno_cep_res" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="aluno_endereco_res" name="aluno_endereco_res" size='50'
						type="text" /> <label style="margin-top: 5px">Complemento</label>
						<input id="aluno_endereco_complemento_res"
						name="aluno_endereco_complemento_res" size='10' type="text" /> <br />
						<label style="margin-top: 5px">Bairro</label> <input
						id="aluno_bairro" name="aluno_bairro" type="text" size='30' /> <label
						style="margin-top: 5px">Cidade</label> <input id="aluno_cidade"
						name="aluno_cidade" type="text" size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="aluno_uf" name="aluno_uf" type="text" size='3' />
						<div class="divisao">Endereço Comercial</div> <label
						style="margin-top: 5px">CEP</label> <input id="aluno_cep_com"
						name="aluno_cep_com" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="aluno_endereco_com" name="aluno_endereco_com" size='50'
						type="text" /> <br /> <label style="margin-top: 5px">Bairro</label>
						<input id="aluno_bairro_com" name="aluno_bairro_com" type="text"
						size='30' /> <label style="margin-top: 5px">Cidade</label> <input
						id="aluno_cidade_com" name="aluno_cidade_com" type="text"
						size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="aluno_uf_com" name="aluno_uf_com" type="text" size='3' />
						<br />
						<div class='divisao'>Telefones</div> <input size="6" name='ddd'
						id='aluno_ddd' /> <input size="14" name='telefone'
						id='aluno_telefone' /> <a href="" id='aluno_incluir_tel'>[Incluir]</a>
						<table>
							<tr style="background-color: black; color: white">
								<td width="50px">DDD</td>
								<td width="150px">Telefone</td>
							</tr>
						</table>
						<div id='aluno_telefone'
							style='height: 150px; width: 210px; overflow-y: auto'>
							<table id="aluno_telefones"></table>
						</div>
				
				</div>
				<div id="dlgPessoaRespFin"
					title="Dados Cadastrais - Responsável Financeiro">
					<label style="margin-top: 5px">CPF</label> <input id="respfin_cpf"
						name="respfin_cpf" type="text" size='21' /><img
						src="../image/search-icon.png" name="respfin_btnpesq"
						id="respfin_btnpesq" campo="respfin" height="15px"> <label
						style="margin-top: 5px; width: 22px; margin-left: 15px">RG</label>
						<input id="respfin_rg" name="respfin_rg" type="text" size='18' />
						<br /> <label style="margin-top: 5px">Nome</label> <input
						id="respfin_nome" name="respfin_nome" type="text" size='50' /> <br />
						<label style="margin-top: 5px">Dt. Nasc.</label> <input
						id="respfin_dt_nasc" name="respfin_dt_nasc" type="text" size='20' />
						<br /> <label style="margin-top: 5px">Naturalidade</label> <input
						id="respfin_naturalidade" name="respfin_naturalidade" type="text"
						size='39' /> <label
						style="margin-top: 5px; margin-left: 10px; width: 20px">UF</label>
						<input id="respfin_naturalidade_uf" name="respfin_naturalidade_uf"
						type="text" size='3' /> <br /> <label style="margin-top: 5px">Nacionalidade</label>
						<input id="respfin_nacionalidade" name="respfin_nacionalidade"
						type="text" size='39' /> <br /> <label style="margin-top: 5px">Profissao</label>
						<input id="respfin_profissao" name="respfin_profissao" type="text"
						size='20' /> <label style="margin-top: 5px" id="respfin_estcivil">Estado
							Civil</label> <select name="respfin_estcivil">
							<option value="0">SELECIONE</option>
							<option value="1">SOLTEIRO(A)</option>
							<option value="2">CASADO(A)</option>
							<option value="3">DIVORCIADO(A)</option>
							<option value="4">VIUVO(A)</option>
					</select> <br /> <label style="margin-top: 5px">Pai</label> <input
						id="respfin_pai" name="respfin_pai" type="text" size='50' /> <br />
						<label style="margin-top: 5px">Mae</label> <input id="respfin_mae"
						name="respfin_mae" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Email</label> <input id="respfin_email"
						name="respfin_email" type="text" size='50' /> <br />
						<div class="divisao">Endereço Residencial</div> <label
						style="margin-top: 5px">CEP</label> <input id="respfin_cep_res"
						name="respfin_cep_res" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="respfin_endereco_res" name="respfin_endereco_res" size='50'
						type="text" /> <label style="margin-top: 5px">Complemento</label>
						<input id="respfin_endereco_complemento_res"
						name="respfin_endereco_complemento_res" size='10' type="text" /> <br />
						<label style="margin-top: 5px">Bairro</label> <input
						id="respfin_bairro" name="respfin_bairro" type="text" size='30' />
						<label style="margin-top: 5px">Cidade</label> <input
						id="respfin_cidade" name="respfin_cidade" type="text" size='30' />
						<label style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="respfin_uf" name="respfin_uf" type="text" size='3' />
						<div class="divisao">Endereço Comercial</div> <label
						style="margin-top: 5px">CEP</label> <input id="respfin_cep_com"
						name="respfin_cep_com" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="respfin_endereco_com" name="respfin_endereco_com" size='50'
						type="text" /> <br /> <label style="margin-top: 5px">Bairro</label>
						<input id="respfin_bairro_com" name="respfin_bairro_com"
						type="text" size='30' /> <label style="margin-top: 5px">Cidade</label>
						<input id="respfin_cidade_com" name="respfin_cidade_com"
						type="text" size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="respfin_uf_com" name="respfin_uf_com" type="text"
						size='3' /> <br />
						<div class='divisao'>Telefones</div> <input size="6" name='ddd'
						id='respfin_ddd' /> <input size="14" name='telefone'
						id='respfin_telefone' /> <a href="" id='respfin_incluir_tel'>[Incluir]</a>
						<table>
							<tr style="background-color: black; color: white">
								<td width="50px">DDD</td>
								<td width="150px">Telefone</td>
							</tr>
						</table>
						<div id='respfin_telefone'
							style='height: 150px; width: 210px; overflow-y: auto'>
							<table id="respfin_telefones"></table>
						</div>
				
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/matricula.png"
								width="30px" />&nbsp;Matricula</a></li>
					</ul>
					<div id="geral"
						style='height: 320px; padding-left: 5px; padding-top: 0; overflow: auto'>
						<div class="divisao">Dados Acadêmicos</div>
						<label style='margin-top: 5px'>Curso:</label> <select id="serie"
							name="serie">
							<option value='99'>SELECIONE...</option>
									<?php
									$query = 'call lista_cursos_matricula();';
									$cursos = consulta ( 'athenas', $query );
									foreach ( $cursos as $curso ) {
										$nCdCurso = $curso ['nCdCurso'];
										$cNmCurso = $curso ['cNmCurso'];
										echo "<option value='$nCdCurso'>$cNmCurso</option>";
									}
									?>
   					 			</select> <br /> <label style='margin-top: 5px'>Turno:</label>
						<select id='turma' name='turma'></select> <br />
						<div class="divisao">Dados Cadastrais</div>
						<label>Aluno: </label> <input id="aluno" size="50"
							readonly="readonly" />
						<button id="btnAltAluno" class='sbtn2' campo='aluno'>Alterar</button>
						<br /> <label style='margin-top: 5px'>Resp. Fin.</label> <input
							id="respfin" size="50" readonly="readonly" />
						<button id="btnAltRespFin" class='sbtn2' campo='respfin'>Alterar</button>
						<input id='respfin_oMesmo' value='1' type='checkbox' />O Mesmo <input
							type='hidden' id='campo_change' /> <input type='hidden'
							id='idchange' /> <input type='hidden' id='aluno_codigo'
							name='aluno_codigo' /> <input type='hidden' id='respfin_codigo'
							name='respfin_codigo' /> <input type='hidden' id='vlr_anuidade'
							name='vlr_anuidade' /> <input type='hidden' id='vlr_material'
							name='vlr_material' /> <br />
						<div class="divisao">Dados Financeiros</div>
						<label style='width: 120px; margin-top: 5px'>Anuidade:</label> <select
							id="anuidade" name="anuidade"
							style="width: 150px; margin-right: 20px;"><option value="0">Selecione</option></select>

						<label style='width: 120px; margin-top: 5px'>Primeiro Vcto:</label>
						<input id="vcto1" size="6" name="vcto1"
							style="margin-right: 20px;" value='01/2014' /> <label
							style='margin-top: 5px; width: 120px'>Opções de Mens.</label> <select
							id="opcoes_boleto_matricula" name="opcoes_boleto_matricula"
							style="width: 150px; margin-right: 20px">
							<option value="0">Selecione</option>
							<option value="D1" selected="selected">Descontar 1º</option>
							<option value="NG">Não Gerar</option>
							<option value="GT">Gerar Todos</option>
						</select> <label style='width: 120px; margin-top: 5px'>Desconto
							Vcto:</label> <input id="desconto" size="6" name="desconto"
							style="margin-right: 110px;" /> <br /> <label
							style='width: 120px; margin-top: 5px'>Material:</label> <select
							id="material" name="material"
							style="width: 150px; margin-right: 20px;"><option value="0">Selecione</option></select>

						<label style='width: 120px; margin-top: 5px'>Primeiro Vcto:</label>
						<input id="vcto1_mat" size="6" name="vcto1_mat"
							style="margin-right: 20px;" value='02/2014' /> <label
							style='margin-top: 5px; width: 120px'>Opções de Mat.</label> <select
							id="opcoes_boleto_material" name="opcoes_boleto_material"
							style="width: 150px; margin-right: 20px;">
							<option value="0">Selecione</option>
							<option value="D1">Descontar 1º</option>
							<option value="NG">Não Gerar</option>
							<option value="GT" selected="selected">Gerar Todos</option>
						</select> <label style='margin-top: 5px; width: 120px'>Modelo
							Contrato:</label> <select id="modelo_contrato"
							name="modelo_contrato" style="width: 150px">
							<option value="0">Selecione</option>
							<option value="1" selected="selected">Particular</option>
							<option value="2">ProJovem</option>
							<option value="3">Vence</option>
							<option value="4">Pronatec</option>
						</select> <br /> <br />
						<button id='avancar' class="sbtn2">Avançar</button>



					</div>
				</div>
			</form>
		</div>             
			<?php include "../footer.inc"?>
		</div>
</body>
</html>