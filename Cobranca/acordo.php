<?php
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


<script>
	function selectitem(objecValuetId, value, objectTextId, text){
		document.forms[0][objecValuetId].value = value;
		document.forms[0][objectTextId].value = text;
		$( "#dialog" ).dialog("close");
		_tpConsulta = $("input[name=tpConsulta]:checked").val();
		consulta_titulos(_tpConsulta,value);
		return false;
		
	}
	function consulta_titulos(_tpConsulta, _cpf){
		$.ajax({
			  url: '../Financeiro/consulta_titulos.php',
			 
			  data: { tpConsulta:_tpConsulta ,cpf:_cpf, obs:'carne'  },
			  
			  success: function(html){
			 	$("#titulos_resultado").html(html); 
			  }
			  
			});
	}
	$(document).ready(function(){
		$("#dialog").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
		$( "#tabs" ).tabs();
		$( "#btnpesq" ).click(function(){
        	_cpf = $("#cpf").val();
        	if (_cpf == ""){
        		$( "#dialog" ).dialog("open");
        	}else{
	        	$.ajax({
				  url: '../Secretaria/search.php',
				  dataType: 'json',
				  data: { consulta: 'pessoa',cpf:_cpf  },
				  
				  success: function(json){
				  	$("#pessoa_nome").val(json.cNome);
				 
				  
				  }
				  
				});
			}
        	
        });
        $("input[name=tpConsulta]").click(function(){
			_tpConsulta = $("input[name=tpConsulta]:checked").val();
			_cpf = $("#cpf").val();
			
			if (_cpf != ""){
        		consulta_titulos(_tpConsulta,_cpf);
        	}
		});
		
		
		$("#btnGerar").click(function(){
			_valores = "";
			$('input[name=boleto]:checked').each(function(){
				_valores = _valores  + $(this).val() +','; 
			});
			$("#boletos").val(_valores);
			$("#frm1").submit();
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
			<div id="dialog">
				<iframe src="../Pessoa/consultar_popup.php?popup=sim"
					frameborder="0" width="680" height="300"></iframe>
			</div>
			<form method="post" id="frm1" action="acordo1.php">


				<div id="tabs">
					<ul>
						<li><a href="#geral">Acordo / Renegocia&ccedil;&atilde;o</a></li>

					</ul>

					<div id="geral"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">CPF</label> <input id="cpf"
							name="cpf" type="text" size="15" title="CPF / Nome" /> <img
							src="../image/search-icon.png" name="btnpesq" id="btnpesq"
							height="15px" /> <br /> <label style="margin-top: 5px;">Nome</label>
						<input type="text" size="40" name="pessoa_nome" id="pessoa_nome" />
						<br /> <input name="tpConsulta" type="radio" value="ACAB"
							style="margin-top: 5px;"></input>&nbsp;Abertos <input
							name="tpConsulta" type="radio" value="ACAT"
							style="margin-left: 15px"></input>&nbsp;Atrasados
						<table>
							<thead>
								<tr>

									<td width='150px'>Nosso Numero</td>
									<td width='150px'>Seu Numero</td>
									<td width='100px'>Vencimento</td>
									<td width='100px'>Valor Titulo</td>
									<td width='100px'>Valor Multa</td>
									<td width='100px'>Valor Juros</td>
									<td width='100px'>Valor Total</td>


								</tr>
							</thead>
						</table>
						<input type="hidden" id="boletos" name="boletos"></input>
						<div id="titulos_resultado" style="height: 260px; overflow: auto"></div>
						<button style="margin-left: 680px" id="btnGerar">Proximo</button>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>