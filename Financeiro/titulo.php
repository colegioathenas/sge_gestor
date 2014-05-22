<?php
ini_set ( "display_errors", 0 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>

<script>
	function selectitem(objecValuetId, value, objectTextId, text){
		document.forms[0][objecValuetId].value = value;
		document.forms[0][objectTextId].value = text;
		$( "#dialog" ).dialog("close");
		desbloquear();
 		consultarDependente();
		return false;
		
	}
	function bloquear(){
		$("#ref").attr("disabled","disabled");
		$("#aluno").attr("disabled","disabled");
		$("#aluno_nome").val("");
		$("#titulo_qtd").attr("disabled","disabled");		
		$("#titulo_valor").attr("disabled","disabled");
		$("#titulo_desconto").attr("disabled","disabled");
		$("input[name=titulo_tp_vencimento]").attr("disabled","disabled");
		$("#titulo_vencimento").attr("disabled","disabled");
		$("#mes_inicio").attr("disabled","disabled");
		$("#btnGerar").attr("disabled","disabled");
	}
	function desbloquear(){
		$("#ref").removeAttr("disabled");
		$("#aluno").removeAttr("disabled");
		$("#titulo_qtd").removeAttr("disabled");		
		$("#titulo_valor").removeAttr("disabled");
		$("#titulo_desconto").removeAttr("disabled");
		$("input[name=titulo_tp_vencimento]").removeAttr("disabled");
		$("#titulo_vencimento").removeAttr("disabled");
		$("#mes_inicio").removeAttr("disabled");
		$("#btnGerar").removeAttr("disabled");
	}
	function consultarDependente(){		
		$.ajax({
			  url: '../Secretaria/search.php',
			  dataType: 'json',
			  data: { consulta: 'dependente',cpf:_cpf  },
			  
			  success: function(json){			 
			  	$.each(json,function(index,value){
				  	$("#aluno").append('<option value="'+value.nCdPessoa+'">'+value.cNome+'</option>');
			  		});
			  	$("#aluno_nome").val($("#aluno option:eq(0)").text());					
			  }			  
		});
	}
	$(function() {
		bloquear();
		$("#dialog").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
		$("#aluno").change(function(){
			$("#aluno_nome").val($("#aluno option:selected").text());
		});
		$( "#tabs" ).tabs();
		$("#cpf").mask("999.999.999-99");
        $( "#btnpesq" ).click(function(){
        	_cpf = $("#cpf").val();
        	$("#aluno").empty();
        	if (_cpf == ""){
        		$( "#dialog" ).dialog("open");        		
        	}else{
	        	$.ajax({
				  url: '../Secretaria/search.php',
				  dataType: 'json',
				  data: { consulta: 'pessoa',cpf:_cpf  },				  
				  success: function(json){
				  	$("#pessoa_nome").val(json.cNome);				  	
				 	if (json.cNome == ""){
					 	bloquear();
				 		alert("Cliente não Encontrado");				 		
				 	}else{
				 		desbloquear();
				 		consultarDependente();
				 	}
				  
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
    });
	
    </script>

</head>

<body>
	<div id="container">
			<?php include "../loading.inc"?>
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>
		<div id="content">
			<div id="dialog">
				<iframe src="../Pessoa/consultar_popup.php?popup=sim"
					frameborder="0" width="680" height="300"></iframe>
			</div>
			<form name="frm1" id="frm1" method="post" action="gerar_parcelas.php">

				<div id="tabs">
					<ul>
						<li><a href="#geral">Gerar Titulos</a></li>
					</ul>
					<div id="geral"
						style='height: 415px; padding-left: 5px; overflow: auto'>
						<label>Resp. Fin</label> <input type="text" size="15" name="cpf"
							id="cpf" /> <img src="../image/search-icon.png" name="btnpesq"
							id="btnpesq" height="15px" /> <br /> <label
							style='margin-top: 5px;'>Nome</label> <input type="text"
							size="40" name="pessoa_nome" id="pessoa_nome" disabled='disabled' />
						<br /> <label>Aluno</label> <select name="aluno" id="aluno"
							style='width: 300px'>
						</select> <input name='aluno_nome' id='aluno_nome' type='hidden' />
						<br /> <label style="margin-top: 5px;">Referencia</label> <select
							id="ref" name="ref">
							<option value="1">1 - Mensalidade</option>
							<option value="2">2 - Material Didatico</option>
							<option value="3">3 - Uniforme</option>
							<option value="4">4 - Documentacao</option>
							<option value="5">5 - Seguro</option>
							<option value="6">6 - Dosimentro</option>
							<option value="7">7 - Acordo</option>
							<option value="8">8 - Provas Substitutivas</option>
							<option value="9">9 - Kit Carteirinha / Agenda</option>
							<option value="0">0 - Outros</option>
						</select> <br /> <label style="margin-top: 5px;">Qtd Parcela</label>
						<input type="text" size="8" name="titulo_qtd" id="titulo_qtd"
							value="1" style="text-align: right" /> <br /> <label
							style="margin-top: 5px;">Vlr Parcela</label> <input type="text"
							size="8" name="titulo_valor" id="titulo_valor"
							style="text-align: right" /> <br /> <label
							style="margin-top: 5px;">Vlr Desconto</label> <input type="text"
							size="8" name="titulo_desconto" id="titulo_desconto" value="0,00"
							style="text-align: right" /> <br /> <label
							style="margin-top: 5px;">Vencimento</label> <input type="text"
							size="6" name="titulo_vencimento" id="titulo_vencimento"
							value="5" /> <input type="radio" name="titulo_tp_vencimento"
							value="DU" checked="checked"> Dia Util </input> <input
							type="radio" name="titulo_tp_vencimento" value="DM">Dia do Mês</input>
						<br /> <label style="margin-top: 5px;">Primeiro Vcto</label> <select
							name="mes_inicio" id="mes_inicio">
                 	 		<?php
																					$mes = date ( 'm' );
																					$ano = date ( 'Y' );
																					for($i = 0; $i <= 6; $i ++) {
																						$vcto = mktime ( 0, 0, 0, $mes + $i, 1, $ano );
																						$value = date ( 'Ym', $vcto );
																						$display = strftime ( "%B/%Y", $vcto );
																						echo "<option  value='$value'>$display</option>";
																					}
																					
																					?>
                 	 	</select> <br />
						<button style="margin-top: 30px;" id='btnGerar'>Gerar</button>
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>