<?php
ini_set ( "display_errors", 0 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css">
	</script>
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
		</script>
		<script src="/js/jquery.js" type="text/javascript"></script>
		<script src="/js/jquery-ui.js" type="text/javascript"></script>


		<script>
	function selectitem(objecValuetId, value, objectTextId, text){
		document.forms[0][objecValuetId].value = value;
		document.forms[0][objectTextId].value = text;
		$( "#dialog" ).dialog("close");
		preenche_campos(value);
		return false;
		
	}
	function preenche_campos(_cpf){
		$.ajax({
				  url: '../Financeiro/consulta_titulos3.php',
				  dataType: 'json',
				  data: { cpf: _cpf  },
				  
				  success: function(json){
				  	$("#pessoa_nome").val(json.cNome);
				  	$("#menor_vcto").val(json.minVcto);
				  	$("#maior_vcto").val(json.maxVcto);
				  	$("#boleto_abt").val(json.qtdBol);
				  	$("#valor_total").val(json.vlrTotal);
				  
				  },
				  beforeSend:function(){
					$("#div_loading").show();
				  },
				  complete: function(data){
					$("#div_loading").hide();
				  }
				  
				});
	}
	
	$(function() {
		$("#dialog").dialog( {modal: true, autoOpen: false, width: 700, height: 400} );
		$( "#tabs" ).tabs();
        $( "#btnpesq" ).click(function(){
        	_cpf = $("#cpf").val();
        	if (_cpf == ""){
        		$( "#dialog" ).dialog("open");
        		
        	}else{
	        	preenche_campos(_cpf);	
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
			<form name="frm1" id="frm1" method="post"
				action="carta_cobranca_rel.php" target="_blank">

				<div id="tabs">
					<ul>
						<li><a href="#geral">Gerar Titulos</a></li>

					</ul>

					<div id="geral"
						style='height: 415px; padding-left: 5px; overflow: auto'>

						<label style="width: 115px">CPF</label> <input type="text"
							size="15" name="cpf" id="cpf" /> <img
							src="../image/search-icon.png" name="btnpesq" id="btnpesq"
							height="15px"> <br /> <label
							style="margin-top: 5px; width: 115px">Nome</label> <input
							type="text" size="40" name="pessoa_nome" id="pessoa_nome" /> <br />
							<label style="margin-top: 5px; width: 115px">Boletos em Aberto</label>
							<input type="text" size="12" name="boleto_abt" id="boleto_abt"
							value="1" style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 115px">Menor Vcto</label> <input
							type="text" size="12" name="menor_vcto" id="menor_vcto"
							style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 115px">Mario Vcto</label> <input
							type="text" size="12" name="maior_vcto" id="maior_vcto" value=""
							style="text-align: right" /> <br /> <label
							style="margin-top: 5px; width: 115px">Valor Total</label> <input
							type="text" size="12" name="valor_total" id="valor_total"
							value="0,00" style="text-align: right" /> <br />

							<button style="margin-top: 30px;">Gerar</button>
					
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>