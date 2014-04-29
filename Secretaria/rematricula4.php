<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
session_start ();
$serie = $_SESSION ['serie'];

$material = 0;
$vlrcurso = 0;

$tipo = $_SESSION ['tipo'];
$nCdCurso = $_SESSION ['serie'];
$nCdTurma = $_SESSION ['turma'];

$query = "select DISTINCT turma.nVlrCurso, turma.nVlrRematricula, turma.nVlrMaterial,nCursoPrazoMax, nMaterialPrazoMax from turma where nCdTurma = $nCdTurma";

$valores = consulta ( "athenas", $query );

$material = $valores [0] ['nVlrMaterial'];

$prazocurso = $valores [0] ['nCursoPrazoMax'];
$prazomaterial = $valores [0] ['nMaterialPrazoMax'];

if ($tipo == "matricula") {
	$vlrcurso = $valores [0] ['nVlrCurso'];
} else {
	
	$vlrcurso = $valores [0] ['nVlrRematricula'];
}

if ($_SESSION ['irmao_mat'] != "") {
	$_SESSION ['perdesconto'] = 0.05;
} else {
	$_SESSION ['perdesconto'] = 0;
}

$mat = $_SESSION ['mat'];
$query = "call dadosAluno('$mat');";
$resultado = consulta ( "acadesc", $query );
$dados_aluno = $resultado [0];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Dados Cadastrais</title>

<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>


<script>
	
		
	$(document).ready(function(){
		$("#aluno_dtnasc").mask("99/99/9999");
		$("#aluno_cep").mask("99999-999");
		$("#resp_cpf").mask("999.999.999-99");
		$("#resp_dtnasc").mask("99/99/9999");
		$("#resp_end_res_cep").mask("99999-999");
		$("#resp_end_com_cep").mask("99999-999");
		
		$("#resp_cel_tel").focusout(function(){
			_ddd = $("#resp_cel_ddd").val();
			_cel = $("#resp_cel_tel").val();
			_operadora = $("#resp_cel_operadora").val();
			if (_operadora == ""){
				$.ajax({
				  url: '../Util/consulta_operadora.php',
				  dataType: 'json',
				  data: { ddd: _ddd
				  		, telefone: _cel  
				  		},
				  beforeSend: function(){
				  	$( "#resp_cel_operadora" ).val("consultando..");
				  },
				  success: function(json){
				  	$("#resp_cel_operadora").val(json.operadora);
				  	
				  	}			  
				});
			}
		});
		
		$("#dialog").dialog( {modal: true, autoOpen: false} );
		$("#consultaCEP").dialog({modal: true, autoOpen: false,width: 500} );
		$("#cep_consulta").click(function(){
			_campo_endereco = "";
			_campo_bairro = "";
			_campo_cidade = "";
			_campo_uf = "";
			_campo_cep = "";
			
			if ($("#cep_ref").val() == "aluno" ){
				_campo_endereco = "#aluno_endereco";
				_campo_bairro = "#aluno_bairro";
				_campo_cidade = "#aluno_cidade";
				_campo_uf = "#aluno_uf";
				_campo_cep = "#aluno_cep";
			}
			
			if ($("#cep_ref").val() == "resp_res" ){
				_campo_endereco = "#resp_end_res_end";
				_campo_bairro = "#resp_end_res_bairro";
				_campo_cidade = "#resp_end_res_cidade";
				_campo_uf = "#resp_end_res_uf";
				_campo_cep = "#resp_end_res_cep";
			}
			if ($("#cep_ref").val() == "resp_com" ){
				_campo_endereco = "#resp_end_com_end";
				_campo_bairro = "#resp_end_com_bairro";
				_campo_cidade = "#resp_end_com_cidade";
				_campo_uf = "#resp_end_com_uf";
				_campo_cep = "#resp_end_com_cep";
			}
			
			$.ajax({
				  url: '../Util/consulta_cep.php',
				  dataType: 'json',
				  data: { cidade: $("#cep_cidade").val()
				  	    , logradouro: $("#cep_logradouro").val()  },
				  
				  beforeSend: function(){
				  	$( "#dialog" ).dialog("open");
				  	$( "#consultaCEP" ).dialog("close");
				  },
				  complete: function(){
				  	$( "#dialog" ).dialog("close");
				  	
				  },
				  success: function(json){
				 	
				  	$(_campo_endereco).val(json.logradouro);
				  	$(_campo_bairro).val(json.bairro);
				  	$(_campo_cidade).val(json.cidade);
				  	$(_campo_uf).val(json.uf);
				  	$(_campo_cep).val(json.cep);
				  	
				  	
				  	}			  
				});
			return false;
		});
		$("#btnConsultar_aluno_cep").click(function(){
			if ($("#aluno_cep").val()  == ""){
				$("#cep_ref").val("aluno");
				$("#consultaCEP").dialog("open");
			}else{
				$.ajax({
				  url: '../Util/consulta_cep.php',
				  dataType: 'json',
				  data: { cep: $("#aluno_cep").val()  },
				  
				  beforeSend: function(){
				  	$( "#dialog" ).dialog("open");
				  },
				  complete: function(){
				  	$( "#dialog" ).dialog("close");
				  },
				  success: function(json){
				  	$("#aluno_endereco").val(json.logradouro);
				  	$("#aluno_bairro").val(json.bairro);
				  	$("#aluno_cidade").val(json.cidade);
				  	$("#aluno_uf").val(json.uf);
				  	}			  
				});
			}
			return false;
		});
		
		$("#btnConsultar_resp_res_cep").click(function(){
			if ($("#resp_end_res_cep").val()  == ""){
				$("#cep_ref").val("resp_res");
				$("#consultaCEP").dialog("open");
			}else{
				$.ajax({
				  url: '../Util/consulta_cep.php',
				  dataType: 'json',
				  data: { cep: $("#resp_end_res_cep").val()  },
				  beforeSend: function(){
				  	$( "#dialog" ).dialog("open");
				  },
				  complete: function(){
				  	$( "#dialog" ).dialog("close");
				  },
				  success: function(json){
				  	$("#resp_end_res_end").val(json.logradouro);
				  	$("#resp_end_res_bairro").val(json.bairro);
				  	$("#resp_end_res_cidade").val(json.cidade);
				  	$("#resp_end_res_uf").val(json.uf);
				  	}			  
				});
			}
			return false;
		});
		
		$("#btnConsultar_resp_com_cep").click(function(){
			if ($("#resp_end_com_cep").val()  == ""){
				$("#cep_ref").val("resp_com");
				$("#consultaCEP").dialog("open");
			}else{
				$.ajax({
				  url: '../Util/consulta_cep.php',
				  dataType: 'json',
				  data: { cep: $("#resp_end_com_cep").val()  },
				  beforeSend: function(){
				  	$( "#dialog" ).dialog("open");
				  },
				  complete: function(){
				  	$( "#dialog" ).dialog("close");
				  },
				  success: function(json){
				  	$("#resp_end_com_end").val(json.logradouro);
				  	$("#resp_end_com_bairro").val(json.bairro);
				  	$("#resp_end_com_cidade").val(json.cidade);
				  	$("#resp_end_com_uf").val(json.uf);
				  }			  
				});
			}
			return false;
		});
		
		$("#resp_copy_end").click(function(){
			$("#resp_end_res_cep").val($("#aluno_cep").val());
			$("#resp_end_res_end").val($("#aluno_endereco").val());
			$("#resp_end_res_bairro").val($("#aluno_bairro").val());
			$("#resp_end_res_cidade").val($("#aluno_cidade").val());
			$("#resp_end_res_uf").val($("#aluno_uf").val());
			return false;
		});
        $( "#nomeirmao" ).autocomplete({
        	
            source: "search.php?consulta=matricula&serie="+$("#serieirmao").val(),
            minLength: 2,
            select: function( event, ui ) {
            	$("#nomeirmao").val(this.value);
               
            }
        });
       		$( "#dialog" ).dialog({ modal:true, autoOpen: false, width: 600 });
		$( "#tabs" ).tabs();
		$( "#contratante_enderecos" ).tabs();
		$( "#add_uniforme" ).click(function(){
			
			
			valor = "";
			peca = "";
			tamanho = $("#tam_uniforme").val();;
			qtd = $("#qtd_uniforme").val();;
			cdpeca = $("#uniformes").val();
			
			switch(cdpeca){
				case "1": valor = 30;
						  peca = "CAMISETA MANGA CURTA";
				break;
				case "2": valor = 78;
						  peca = "BLUSAO POLI";
				break;
				case "3": valor = 50;
						  peca = "CALCA POLI";
				break;
				case "4": valor = 40;
						  peca = "CALCA LEG";
				break;
				case "5": valor = 38;
						  peca = "BERMUDA TECTEL";
				break;
			}
			total_geral = $("#val_uniforme").val();
			
			total = valor * qtd;
			total_geral = parseFloat(total_geral) + parseFloat(total);
			$("#val_uniforme").val(total_geral);
			pmt1 = total_geral;
			pmt2 = total_geral/2;
			pmt3 = total_geral/3;
			
			total = parseFloat(Math.round(total * 100) / 100).toFixed(2);
			valor = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
			total_geral = parseFloat(Math.round(total_geral * 100) / 100).toFixed(2);
			pmt1 = parseFloat(Math.round(pmt1 * 100) / 100).toFixed(2);
			pmt2 = parseFloat(Math.round(pmt2 * 100) / 100).toFixed(2);
			pmt3 = parseFloat(Math.round(pmt3 * 100) / 100).toFixed(2);
			
			//$("#tb_uniformes tr").last().remove();
			$("#tb_uniformes tr").last().before("<tr><td>"+peca+"<input type='hidden' name='lstpeca' value='"+cdpeca+"'/></td><td>"+tamanho+"<input type='hidden' name='lsttam' value='"+tamanho+"'/></td><td>"+qtd+"<input type='hidden' name='lstqtd' value='"+qtd+"'/></td><td>"+valor+"</td><td>"+total+"</td></tr>");
			$("#tb_uniformes td").last().text(total_geral);
			
			
			$("input[name='fpg_uniforme']").show();
			$("#fpg_uniforme1").text(" 1x R$ "+pmt1 );
			$("#fpg_uniforme2").text(" 2x R$ "+pmt2);
			$("#fpg_uniforme3").text(" 3x R$ "+pmt3);

			$("#valor_uniforme").val("R$ "+pmt1);
			$("#idx_uniforme").val(parseFloat($("#idx_uniforme").val())+1 );
			
			
			return false;
		});
		$("#send").click(function(){ 
		 	 var msg = "";
		 	 var icon = "<span class='ui-icon ui-icon-circle-check' style='float: left;'></span>";
		 	
		 	if ($("#aluno_naturalidade").val() == ""){ msg = msg + icon +  "Naturalidade do Aluno n&atilde;o Preenchida <br/>" ;}
		 	if ($("#aluno_nacionalidade").val() == ""){ msg = msg + icon +  "Nacionalidade do Aluno n&atilde;o Preenchida <br/>" ;}
		 	if ($("#aluno_cep").val() == ""){ msg = msg + icon +  "CEP do Aluno n&atilde;o Preenchidao <br/>";}
		 	if ($("#aluno_endereco ").val() == ""){ msg = msg + icon +  "Endereco do Aluno n&atilde;o Preenchidao <br/>";}
		 	if ($("#aluno_bairro").val() == ""){ msg = msg + icon +  "Bairro do Aluno n&atilde;o Preenchidao <br/>";}
		 	if ($("#aluno_pai ").val() == ""){ msg = msg + icon +  "Mae do Aluno n&atilde;o Preenchidao <br/>";}
		 	if ($("#aluno_mae ").val() == ""){ msg = msg + icon +  "Pai do Aluno n&atilde;o Preenchidao <br/>";}
		 	
		 	if ($("#resp_nome").val() == ""){ msg = msg + icon +  "Nome do Responsavel n&atilde;o preenchdio <br/>";}
		 	if ($("#resp_parentesco ").val() == ""){ msg = msg + icon +  "Parentesco do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_rg").val() == ""){ msg = msg + icon +  "RG do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_cpf ").val() == ""){ msg = msg + icon +  "CPF do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_dtnasc").val() == ""){ msg = msg + icon +  "Dt. Nasc do Responsavel n&atilde;o Preenchidao <br/>";}
		 	
		 	if ($("#resp_naturalidade").val() == ""){ msg = msg + icon + "Naturalidade do Responsavel n&atilde;o preenchdio <br/>";}
		 	if ($("#resp_nacionalidade").val() == ""){ msg = msg + icon +  "Nacionalidade do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_profissao").val() == ""){ msg = msg + icon +  "Profissao do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_cpf ").val() == ""){ msg = msg + icon +  "CPF do Responsavel n&atilde;o Preenchidao <br/>";}
		 	if ($("#resp_est_civ").val() == ""){ msg = msg + icon +  "Estado Civil do Responsavel n&atilde;o Preenchidao <br/>";}
		 	
		 
		 	
		 	if ($("#resp_end_res_cep ").val() == ""){ msg = msg + icon +  "CEP Residencial do Responsavel nao preenchdio <br/>";}
		 	if ($("#resp_end_res_end ").val() == ""){ msg = msg + icon +  "Endereco Residencial do Responsavel não Preenchidao <br/>";}
		 	if ($("#resp_end_res_bairro").val() == ""){ msg = msg + icon +  "Bairro Residencial do Responsavel não Preenchidao <br/>";}
		 	if ($("#resp_end_res_cidade ").val() == ""){ msg = msg + icon +  "Cidade Residencial do Responsavel não Preenchidao <br/>";}
		 	if ($("#resp_end_res_uf").val() == ""){ msg = msg + icon +  "UF Residencial do Responsavel não Preenchidao <br/>";}
		 	
		 	if (    ($("#resp_res_tel").val() == "") 
		 	     && ($("#resp_com_tel").val() == "") 
		 	     && ($("#resp_cel_tel").val() == "")
		 	   ){ 
		 	     	msg = msg + icon +  "Telefone do Responsavel não Preenchidao <br/>";
	 	     	} 
		 	
		 	if ($("input[name='fpg_uniforme']:checked").val() == "" ){msg = msg + icon +  "Forma de Pgto do Uniforme nao escolhida<br/>";}
		 	
		 	if (msg == ""){
		 		("#frm1").submit(); 
		 		return false;
		 	}else{
		 		$( "#dialog" ).html(msg);
		 		$( "#dialog" ).dialog("open");
		 		return false;
		 	}
		 	
		 	
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

			<form id="frm1" method="post" action="precontrato.php">
				<div id="dialog">Consultando..</div>
				<div id="consultaCEP">
					<label style='margin-top: 5px; width: 100px'>Cidade</label><input
						type="text" name="cep_cidade" id="cep_cidade" size="30"
						value="ARUJA" /> <br /> <label
						style='margin-top: 5px; width: 100px'>Logradouro</label><input
						type="text" name="cep_logradouro" id="cep_logradouro" size="40"
						value="" /> <br /> <a href='' id="cep_consulta"
						style='margin-left: 400px'>Consultar</a>
				</div>
				<p>
					<h2><?php echo $_SESSION['tipo']; ?> 4/5</h2>
				</p>
				<div id="dialog" title="Aviso"></div>
				<div id="tabs">
					<ul>
						<li><a href="#Dados_aluno"><img src="../image/aluno_icon.png"
								height="30px" />&nbsp;Dados do Aluno</a></li>
						<li><a href="#Dados_responsavel"><img
								src="../image/resp_fin_icon.png" height="30px" />&nbsp;Responsavel
								Financeiro</a></li>
						<li><a href="#solicitacao_uniforme"><img
								src="../image/uniforme_icon.jpg" height="30px" />&nbsp;Solicitacao
								de Uniforme</a></li>
						<li><a href="#forma_pagamento"><img
								src="../image/pagamento_icon.gif" height="30px" />&nbsp;Forma de
								Pagamento</a></li>
						<li><a href="#checklist_documentos"><img
								src="../image/checklist_icon.png" height="30px" />&nbsp;CheckList
								Doc</a></li>

					</ul>
					<div id="Dados_aluno" style="height: 330px; overflow: auto">

						<label style='margin-top: 5px; width: 80px'>Nome</label><input
							type="text" name="aluno_nome" id="aluno_nome" size="80"
							value="<?php
							
if ($dados_aluno ['Nome'] == "") {
								echo $_REQUEST ['aluno_nome'];
							} else {
								echo $dados_aluno ['Nome'];
							}
							?>" /> <br />
						<label style='margin-top: 5px'>RG/RA</label><input type="text"
							name="aluno_rg" id="aluno_rg" size="20"
							value="<?php echo $dados_aluno['RGAluno']; ?>" /> <label
							style='margin-left: 120px'>Dt. Nasc.</label><input
							style='margin-left: -20px' type="text" name="aluno_dtnasc"
							id="aluno_dtnasc" size="12"
							value="<?php echo date("d/m/Y",strtotime($dados_aluno['DtNascimento'])); ?>" />
						<br /> <label style='margin-top: 5px'>Naturalidade</label><input
							type="text" name="aluno_naturalidade" id="aluno_naturalidade"
							size="29" value="<?php echo $dados_aluno['CidadeNasc']; ?>" /> <label
							style='margin-left: 35px'>Nacionalidade</label><input
							style='margin-left: 10px' type="text" name="aluno_nacionalidade"
							id="aluno_nacionalidade" value="Brasileira" size="27" /> <br /> <label
							style='margin-top: 5px'>CEP</label><input type="text"
							name="aluno_cep" id="aluno_cep" size="10"
							value="<?php echo $dados_aluno['CEP']; ?>" />&nbsp;<a href=''
							id='btnConsultar_aluno_cep'>Consultar</a> <br /> <label
							style='margin-top: 5px'>Endereco</label><input type="text"
							name="aluno_endereco" id="aluno_endereco" size="80"
							value="<?php echo $dados_aluno['Endereco']; ?>" /> <br /> <label
							style='margin-top: 5px'>Bairro</label><input type="text"
							name="aluno_bairro" id="aluno_bairro" size="29"
							value="<?php echo $dados_aluno['Bairro']; ?>" /> <label
							style='margin-left: 5px'>Cidade</label><input
							style='margin-left: -35px' type="text" name="aluno_cidade"
							id="aluno_cidade" size="20"
							value="<?php echo $dados_aluno['Cidade']; ?>" /> <label
							style='margin-left: 50px'>UF</label><input
							style='margin-left: -55px' type="text" name="aluno_uf"
							id="aluno_uf" size="3" value="<?php echo $dados_aluno['UF']; ?>" />
						<br /> <label style='margin-top: 5px'>DDD</label><input
							type="text" name="aluno_ddd" id="aluno_ddd" size="3"
							value="<?php echo $dados_aluno['ddd']; ?>" /> <label
							style='margin-left: 5px'>Telefone</label><input
							style='margin-left: -10px' type="text" name="aluno_telefone"
							id="aluno_telefone" size="10"
							value="<?php echo $dados_aluno['Telefone']; ?>" /> <label
							style='margin-left: 5px'>Email</label><input
							style='margin-left: -34px' type="text" name="aluno_email"
							id="aluno_email" size="39"
							value="<?php echo $dados_aluno['Email']; ?>" /> <br /> <label
							style='margin-top: 5px'>Pai</label><input type="text"
							name="aluno_pai" id="aluno_pai" size="80"
							value="<?php echo $dados_aluno['NomePai']; ?>" /> <br /> <label
							style='margin-top: 5px'>Mae</label><input type="text"
							name="aluno_mae" id="aluno_mae" size="80"
							value="<?php echo $dados_aluno['NomeMae']; ?>" />
					</div>
					<div id="Dados_responsavel" style="height: 330px; overflow: auto">


						<label style='margin-top: 5px; width: 80px'>Nome</label><input
							type="text" name="resp_nome" id="resp_nome" size="52"
							value="<?php echo $dados_aluno['NomeResp']; ?>" /> <label
							style='margin-left: 6px; width: 80px'>Parentesco</label><input
							type="text" name="resp_parentesco" id="resp_parentesco" size="12"
							value="<?php echo $dados_aluno['ParentescoResp']; ?>" /> <br /> <label
							style='margin-top: 5px'>RG</label><input type="text"
							name="resp_rg" id="resp_rg" size="20"
							value="<?php echo $dados_aluno['RGResp']; ?>" /> <label
							style='margin-left: 22px'>CPF</label><input
							style='margin-left: -45px' type="text" name="resp_cpf"
							id="resp_cpf" size="19"
							value="<?php echo $_SESSION['responsavel_cpf']; ?>" /> <label
							style='margin-left: 26px'>Dt. Nasc.</label><input
							style='margin-left: -20px' type="text" name="resp_dtnasc"
							id="resp_dtnasc" size="12"
							value="<?php echo  date("d/m/Y",strtotime($dados_aluno['DtNascimentoResp']));?>" />
						<br /> <label style='margin-top: 5px'>Naturalidade</label><input
							type="text" name="resp_naturalidade" id="resp_naturalidade"
							size="29" /> <label style='margin-left: 35px'>Nacionalidade</label><input
							style='margin-left: 8px' type="text" name="resp_nacionalidade"
							id="resp_nacionalidade" value="Brasileira" size="29" /> <br /> <label
							style='margin-top: 5px'>Est. Civil</label><input type="text"
							name="resp_est_civ" id="resp_est_civ" size="29" /> <label
							style='margin-left: 35px'>Profiss&atilde;o</label><input
							style='margin-left: 8px' type="text" name="resp_profissao"
							id="resp_profissao" size="29" /> <br />
						<fieldset style='padding: 10px; float: left'>
							<legend>
								Endereco Residencial - [<a href="" id="resp_copy_end">Copiar do
									Aluno</a>]
							</legend>

							<label style='margin-top: 5px'>CEP</label><input type="text"
								name="resp_end_res_cep" id="resp_end_res_cep" size="10"
								value="<?php echo $dados_aluno['CEPResp']; ?>" />&nbsp;<a
								href='' id='btnConsultar_resp_res_cep'>Consultar</a> <br /> <label
								style='margin-top: 5px'>Endereco</label><input type="text"
								name="resp_end_res_end" id="resp_end_res_end" size="60"
								value="<?php echo $dados_aluno['EnderecoResp']; ?>" /> <br /> <label
								style='margin-top: 5px'>Bairro</label><input type="text"
								name="resp_end_res_bairro" id="resp_end_res_bairro" size="29"
								value="<?php echo $dados_aluno['BairroResp']; ?>" /> <label
								style='margin-left: 5px'>Cidade</label><input
								style='margin-left: -35px' type="text"
								name="resp_end_res_cidade" id="resp_end_res_cidade" size="20"
								value="<?php echo $dados_aluno['CidadeResp']; ?>" /> <label
								style='margin-left: 50px'>UF</label><input
								style='margin-left: -55px' type="text" name="resp_end_res_uf"
								id="resp_end_res_uf" size="3"
								value="<?php echo $dados_aluno['UFResp']; ?>" />
						</fieldset>
						<fieldset style='padding: 10px'>
							<legend>Endereco Comercial</legend>

							<label style='margin-top: 5px'>CEP</label><input type="text"
								name="resp_end_com_cep" id="resp_end_com_cep" size="10" />&nbsp;<a
								href='' id='btnConsultar_resp_com_cep'>Consultar</a> <br /> <label
								style='margin-top: 5px'>Endereco</label><input type="text"
								name="resp_end_com_end" id="resp_end_com_end" size="60" /> <br />
							<label style='margin-top: 5px'>Bairro</label><input type="text"
								name="resp_end_com_bairro" id="resp_end_com_bairro" size="29" />
							<label style='margin-left: 5px'>Cidade</label><input
								style='margin-left: -35px' type="text"
								name="resp_end_com_cidade" id="resp_end_com_cidade" size="20" />
							<label style='margin-left: 50px'>UF</label><input
								style='margin-left: -55px' type="text" name="resp_end_com_uf"
								id="resp_end_com_uf" size="3" />

						</fieldset>
						<fieldset style='padding: 10px'>
							<legend>Telefones</legend>
							<label style='margin-top: 5px'>Tel. Res</label> <input
								type="text" name="resp_res_ddd" id="resp_res_ddd" size="3"
								value="11" />-<input style='margin-left: 0px' type="text"
								name="resp_res_tel" id="resp_res_tel" size="10"
								value="<?php echo $dados_aluno['TelefoneResp']; ?>" /> <label
								style='margin-left: 20px'>Tel. Com</label> <input type="text"
								name="resp_com_ddd" id="resp_com_ddd" style="margin-left: -20px"
								size="3" value="11" />-<input style='margin-left: 0px'
								type="text" name="resp_com_tel" id="resp_com_tel" size="10"
								value="<?php echo $dados_aluno['TelEmpresaResp']; ?>" /> <label
								style='margin-left: 20px'>Tel. Cel</label> <input type="text"
								name="resp_cel_ddd" id="resp_cel_ddd" style="margin-left: -20px"
								size="3" value="11" />-<input style='margin-left: 0px'
								type="text" name="resp_cel_tel" id="resp_cel_tel" size="10"
								value="<?php echo $dados_aluno['CelularResp']; ?>" /> <label
								style='margin-left: 20px'>Operadora</label> <input
								style='margin-left: 0px' type="text" name="resp_cel_operadora"
								style="margin-left:-10px" id="resp_cel_operadora" size="10"
								value="" />
						</fieldset>
						<label style='margin-top: 5px'>Email</label><input type="text"
							name="resp_email" id="resp_email" size="82"
							value="<?php echo $dados_aluno['EmailResp']; ?>" />


					</div>

					<div id="solicitacao_uniforme"
						style="height: 330px; overflow: auto">
						<label for="nome" style='margin-top: 5px'>Serie:</label> <select
							id="uniformes" name="uniformes">
							<option value='0'>SELECIONE...</option>
							<option value='1'>CAMISETA MANGA CURTA - R$ 30,OO</option>
							<option value='2'>BLUSAO POLI - R$ 78,00</option>
							<option value='3'>CALCA POLI - R$ 50,00</option>
							<option value='4'>CALCA LEG - R$ 35,00</option>
							<option value='5'>BERMUDA TECTEL - R$ 38,00</option>
						</select> <input type="text" name="qtd_uniforme" id="qtd_uniforme"
							size="4" /> <input type="text" name="tam_uniforme"
							id="tam_uniforme" size="4" />
						<button id="add_uniforme">Add</button>
						<table id="tb_uniformes" width="100%">
							<thead>
								<tr>
									<th>Peca</th>
									<th>Tamanho</th>
									<th>Quantidade</th>
									<th>Valor Unitario</th>
									<th>Valor Total</th>
								</tr>
							</thead>
							<tr>
								<td colspan='4'></td>
								<td>0,00</td>
							</tr>
						</table>
						<input type='hidden' id='val_uniforme' name='val_uniforme'
							value='0' /> <input type='hidden' id='idx_uniforme'
							name='idx_uniforme' value='0' />
					</div>

					<div id="forma_pagamento" style="height: 330px; overflow: auto">
						<fieldset style='padding: 10px'>
							<legend>Mensalidade</legend>
							<label style='margin-top: 5px'>Valor</label><input type="text"
								name="valor_mensalidade" id="valor_mensalidade" size="15"
								value="R$ <?php echo number_format($vlrcurso,2,",",".") ?>"
								readonly="readonly" /> <br />
							
								<?php
								$pmt = $vlrcurso - $vlrcurso * 0.05;
								$pmt = number_format ( $pmt, 2, ",", "." );
								$valores_mensalidade [] = $pmt;
								for($i = 2; $i <= $prazocurso; $i ++) {
									$pmt = number_format ( $vlrcurso / $i, 2, ",", "." );
									$valores_mensalidade [] .= $pmt;
								}
								$ncolunas = ceil ( $prazocurso / 3 );
								echo "<table width='100%'>";
								for($i = 1; $i <= 3; $i ++) {
									echo "<tr>";
									for($j = 1; $j <= $ncolunas; $j ++) {
										$value = (3 * ($j - 1)) + $i;
										if ($value <= $prazocurso) {
											$pos = $value - 1;
											echo "<td><input type= \"radio\" name=\"fpg_mensalidade\" value=\"$value\" >  $value x $valores_mensalidade[$pos]</input></td>";
										} else {
											echo "<td></td>";
										}
									}
									echo "</tr>";
								}
								echo "</table>";
								?>
						
						</fieldset>
						<fieldset style='padding: 10px'>
							<legend>Material Didatico</legend>
							<label style='margin-top: 5px'>Valor</label><input type="text"
								name="valor_mensalidade" id="valor_mensalidade" size="15"
								value="R$ <?php echo number_format($material,2,",","."); ?>"
								readonly="readonly" /> <br />
							<?php
							$pmt = $material - $material * 0.05;
							$pmt = number_format ( $pmt, 2, ",", "." );
							$valores_material [] = $pmt;
							for($i = 2; $i <= $prazomaterial; $i ++) {
								$pmt = number_format ( $material / $i, 2, ",", "." );
								$valores_material [] .= $pmt;
							}
							$ncolunas = ceil ( $prazomaterial / 3 );
							echo "<table width='100%'>";
							for($i = 1; $i <= 3; $i ++) {
								echo "<tr>";
								for($j = 1; $j <= $ncolunas; $j ++) {
									$value = (3 * ($j - 1)) + $i;
									if ($value <= $prazomaterial) {
										$pos = $value - 1;
										echo "<td><input type= \"radio\" name=\"fpg_material\" value=\"$value\" >  $value x $valores_material[$pos]</input></td>";
									} else {
										echo "<td></td>";
									}
								}
								echo "</tr>";
							}
							echo "</table>";
							
							?>
						</fieldset>
						<fieldset style='padding: 10px'>
							<legend>Uniforme</legend>
							<label style='margin-top: 5px'>Valor</label><input type="text"
								name="valor_uniforme" id="valor_uniforme" size="15"
								value="R$ 0,00" readonly="readonly" />
							<table width='100%' id="tb_fpg_uniforme">
								<tr>
									<td width='40%'><input type="radio" name="fpg_uniforme"
										value="1" style='display: none'></input><label
										id="fpg_uniforme1" /></td>
									<td><input type="radio" name="fpg_uniforme" value="2"
										style='display: none' /><label id="fpg_uniforme2" /></td>
									<td width='30%'><input type="radio" name="fpg_uniforme"
										value="3" style='display: none' /><label id="fpg_uniforme3" /></td>
								</tr>
							</table>
						</fieldset>
					</div>
					<div id="checklist_documentos"
						style="height: 345px; overflow: auto">
						<input id="documento1" name="documento1" type="checkbox" value="1" />
						Responsavel - CPF <br /> <input id="documento1" name="documento1"
							type="checkbox" value="1" /> Responsavel - RG <br /> <input
							id="documento1" name="documento1" type="checkbox" value="1" />
						Responsavel - Comprovante Residencia <br /> <input id="documento1"
							name="documento1" type="checkbox" value="1" /> Aluno - RG ou
						Certidao de Nascimento <br /> <input id="documento1"
							name="documento1" type="checkbox" value="1" /> Aluno -
						Transferencia <br /> <input id="documento1" name="documento1"
							type="checkbox" value="1" /> Aluno - Historico Escolar <br /> <input
							id="documento1" name="documento1" type="checkbox" value="1" />
						Aluno - 2 Fotos 3x4 <br /> <input id="documento1"
							name="documento1" type="checkbox" value="1" /> Aluno - CPF
					</div>
				</div>

				<button style='margin-left: 1100px; margin-top: 5px' id="send">Proximo</button>
				<input type="hidden" name="val_material" id="val_material"
					value="<?php echo $material ;?>" /> <input type="hidden"
					name="val_mensalidade" id="val_mensalidade"
					value="<?php echo $vlrcurso; ?>" /> <input type="hidden"
					name="cep_ref" id="cep_ref" value="" />


			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
