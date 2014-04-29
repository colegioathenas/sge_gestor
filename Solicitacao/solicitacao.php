<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Solicitações]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script>
	function selectitem(objecValuetId, value, objectTextId, text){      	
      	$("#requerente").val(text);
      	$("#req_codigo").val(value);
      	carregar_campos_requerente(value); 
		$( "#dlgConsultaPessoa" ).dialog("close");
		return false;			
	}
	function carregar_campos_requerente(codigo){
		$.ajax({
			  url: '../Secretaria/search.php',
			  dataType: 'json',
			  data: { consulta: 'pessoa',cpf:codigo  },			  
			  success: function(json){
			  	$("#req_nome").val(json.cNome);
			  	$("#req_endereco_res").val(json.cLogradouro);
			  	$("#req_codigo").val(json.nCdPessoa);
			  	$("#req_endereco_complemento_res").val(json.cComplelemnto);
			  	$("#req_cep_res").val(json.nCEPFormatado);
			  	$("#req_cidade").val(json.cCidade);
			  	$("#req_bairro").val(json.cBairro);
			  	$("#req_uf").val(json.cUF);
			  	$("#req_cpf").val(json.nCPFFormatado);
			  	$("#req_rg").val(json.cRG);
			  	$("#req_dt_nasc").val(json.dNascFormatado);
			  	$("#req_naturalidade").val(json.cNaturalidade);
			  	$("#req_naturalidade_uf").val(json.cNaturalidadeUf);
			  	$("#req_nacionalidade").val(json.cNacionalidade);
			  	$("#req_email").val(json.cEmail);
			  	$("#req_pai").val(json.cFiliacaoPai);
			  	$("#req_mae").val(json.cFiliacaoMae);					  	
			  	$("#req_profissao").val(json.cProfissao);
			  	$("#req_estcivil").val(json.nCdEstadoCivil);
			  	$("#req_cep_com").val(json.cEnd_com_cepFormatado);
			  	$("#req_endereco_com").val(json.cEnd_com_end);
			  	$("#req_bairro_com").val(json.cEnd_com_bairro);
			  	$("#req_cidade_com").val(json.cEnd_com_cidade);
			  	$("#req_uf_com").val(json.cEnd_com_uf);
			  	carregar_campos_respfin(json.nCdRespFin);
			  	$("#idchange").val("0");					  	
			  }
		});
	}
	function verifica_alteracao_requerente(){
    	if ($("#idchange").val() == "1"){		    		
					$("<div title='Aviso'></div>").appendTo('body')
        						.html("<center><span style='font-size:small'>Os dados do Requerente foram alterados <br/> Escolha uma opção:</span></center>")
        						.dialog({ modal: true
        								, title: 'Aviso'
        								, zIndex: 10000
        								, autoOpen: true
        								, width: 'auto'
        								, resizable: false
        								, buttons: { "ALTERAR Requerente": function () {
        													$(this).dialog("close");
        													$("#idchange").val("0");	
						                           		  }
						                           , "INCLUIR Requerente": function () {
						                               	 	$(this).dialog("close");
						                               	 $("#idchange").val("0");	
						                               	 $("#req_codigo").val("0");
						                            	  }
				                        },
				                        close: function (event, ui) {
				                            $(this).remove();
				                        }
        								});
					
    	}
    }
	$(document).on("click","#lista_adicionar", function(){		
		var _item = $("#lista_item").val();
		var _qtd = $("#lista_quantidade").val();
		var _nr = parseInt($("#tbLista tr:last").attr("nr")) + 1;		
		$("#tbLista tr:last").after("<tr nr='"+_nr+"'><td><a href='#' name='lista_remover'>remover</td></td><td>"+_item+"</td><td>"+_qtd+"</td><td>0</td><td>0</td><td><input name='lista_detalhe_"+_nr+"' value='"+_item+"|"+_qtd+"' /><td>  </tr>");
		return false;
	});
	$(document).on("click","a[name=lista_remover]", function(){		
		$(this).parent().parent().remove();		
		return false;
	});
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		
		$("#dlgConsultaPessoa").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
		$("#dlgPessoaRequerente").dialog( {modal: true, autoOpen: false, width: 800, height: 400, close: function(event, ui) { verifica_alteracao_requerente(); }} );
		$( "#req_btnpesq" ).click(function(){		        	
			$("#campo_change").val($(this).attr("campo"));
        	$( "#dlgConsultaPessoa" ).dialog("open");		        
        	return false;
        });				
        $("#btnAltRequerente").click(function(){
        	$( "#dlgPessoaRequerente" ).dialog("open");
        	return false;
	    });        
		$("#req_cpf").mask("999.999.999-99");				
		$("#req_cep_res").mask("99999-999");		
		$("#req_dt_nasc").mask("99/99/9999");
		$("#req_nome").change(function(){$("#requerente").val($(this).val());});
		$("input").change(function(){
		    if ($(this).attr("name").substring(0,4) == "req_"){
			    $("#idchange").val("1");
		    }
		});
		
		$("#tpSolicitacao").load('solicitacao_lista_tipo.php');	
	    $("#tpSolicitacao").change(function(){
		    var _formulario = $("#tpSolicitacao option:selected").attr("formulario");
		    $.ajax({
				  url: "Formularios/"+_formulario,
				  data: {"codigo" : $("#tpSolicitacao option:selected").val() },								  				 
				  success: function(data){
				  	$("#formulario").html(data);				 
				  }
		    });
		    $("#prazo").val($("#tpSolicitacao option:selected").attr("prazo"));		    
		});
		$("#btnProximo").click(function(){
			var _txt = "tipo="+$("#tpSolicitacao option:selected").val();
			_txt = _txt + "&" + "nmsol=" + $("#tpSolicitacao option:selected").text();
			_txt = _txt + "&" + "ID=" + $("#tpSolicitacao option:selected").attr("idt");
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

							
			window.location.href = "solicitacao_incluir.php?"+_txt;
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
				<div id="dlgConsultaPessoa" title="Consulta Pessoa">
					<iframe src="../Pessoa/consultar_popup.php?popup=sim"
						frameborder="0" width="680" height="300"></iframe>
				</div>
				<div id="dlgPessoaRequerente" title="Dados Cadastrais - Requerente">
					<label style="margin-top: 5px">CPF</label> <input id="req_cpf"
						name="req_cpf" type="text" size='21' /><img
						src="../image/search-icon.png" name="req_btnpesq" id="req_btnpesq"
						height="15px"> <label
						style="margin-top: 5px; width: 22px; margin-left: 15px">RG</label>
						<input id="req_rg" name="req_rg" type="text" size='18' /> <br /> <label
						style="margin-top: 5px">Nome</label> <input id="req_nome"
						name="req_nome" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Dt. Nasc.</label> <input id="req_dt_nasc"
						name="req_dt_nasc" type="text" size='20' /> <br /> <label
						style="margin-top: 5px">Naturalidade</label> <input
						id="req_naturalidade" name="req_naturalidade" type="text"
						size='39' /> <label
						style="margin-top: 5px; margin-left: 10px; width: 20px">UF</label>
						<input id="req_naturalidade_uf" name="req_naturalidade_uf"
						type="text" size='3' /> <br /> <label style="margin-top: 5px">Nacionalidade</label>
						<input id="req_nacionalidade" name="req_nacionalidade" type="text"
						size='39' /> <br /> <label style="margin-top: 5px">Profissao</label>
						<input id="req_profissao" name="req_profissao" type="text"
						size='20' /> <label style="margin-top: 5px" id="req_estcivil">Estado
							Civil</label> <select name="req_estcivil">
							<option value="0">SELECIONE</option>
							<option value="1">SOLTEIRO(A)</option>
							<option value="2">CASADO(A)</option>
							<option value="3">DIVORCIADO(A)</option>
							<option value="4">VIUVO(A)</option>
					</select> <br /> <label style="margin-top: 5px">Pai</label> <input
						id="req_pai" name="req_pai" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Mae</label> <input id="req_mae"
						name="req_mae" type="text" size='50' /> <br /> <label
						style="margin-top: 5px">Email</label> <input id="req_email"
						name="req_email" type="text" size='50' /> <br />
						<div class="divisao">Endereço Residencial</div> <label
						style="margin-top: 5px">CEP</label> <input id="req_cep_res"
						name="req_cep_res" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="req_endereco_res" name="req_endereco_res" size='50'
						type="text" /> <label style="margin-top: 5px">Complemento</label>
						<input id="req_endereco_complemento_res"
						name="req_endereco_complemento_res" size='10' type="text" /> <br />
						<label style="margin-top: 5px">Bairro</label> <input
						id="req_bairro" name="req_bairro" type="text" size='30' /> <label
						style="margin-top: 5px">Cidade</label> <input id="req_cidade"
						name="req_cidade" type="text" size='30' /> <label
						style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="req_uf" name="req_uf" type="text" size='3' />
						<div class="divisao">Endereço Comercial</div> <label
						style="margin-top: 5px">CEP</label> <input id="req_cep_com"
						name="req_cep_com" type="text" size='10' /> <br /> <label
						style="margin-top: 5px">Endereco</label> <input
						id="req_endereco_com" name="req_endereco_com" size='50'
						type="text" /> <br /> <label style="margin-top: 5px">Bairro</label>
						<input id="req_bairro_com" name="req_bairro_com" type="text"
						size='30' /> <label style="margin-top: 5px">Cidade</label> <input
						id="req_cidade_com" name="req_cidade_com" type="text" size='30' />
						<label style="margin-top: 5px; margin-left: 26px; width: 20px">UF</label>
						<input id="req_uf_com" name="req_uf_com" type="text" size='3' /> <br />
						<input size="6" name='ddd' id='req_ddd' /> <input size="14"
						name='telefone' id='req_telefone' />
				
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/procurar_pessoa_icon.jpg"
								height="30px" />&nbsp;Incluir Solicitação</a></li>
					</ul>

					<div id="consulta"
						style='height: 350px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px; width: 120px">Tipo de Solicitação</label>
						<select id="tpSolicitacao">
						</select> <label>Prazo: </label> <input id="prazo" name="prazo"
							size="3" readonly="readonly" /> dias <br /> <label
							style="margin-top: 5px; width: 120px">Requerente: </label> <input
							id="requerente" size="50" readonly="readonly" />
						<button id="btnAltRequerente" class='sbtn2'>Alterar</button>
						<input type='hidden' id='campo_change' /> <input type='hidden'
							id='idchange' /> <input type='hidden' id='req_codigo'
							name='req_codigo' />
						<div id="formulario" style='height: 270px; overflow: auto'></div>
						<a href="#" class="sbtn" id="btnProximo">Proximo</a>
					</div>


				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
