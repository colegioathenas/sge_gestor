<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$boletos = $_REQUEST ['boletos'];
$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$boletos = substr ( $boletos, 0, strlen ( $boletos ) - 1 );

$query = "select nNossoNumero,dVcto,nVlrTitulo,nVlrDesconto,nVlrJuros,nVlrMulta from titulos where nNossoNumero in ($boletos)";

$resultado = consulta ( "athenas", $query );

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
			 
			  data: { tpConsulta:_tpConsulta ,cpf:_cpf, obs:'ajuste'  },
			  
			  success: function(html){
			 	$("#titulos_resultado").html(html); 
			  },
			  beforeSend:function(){
				$("#div_loading").show();
			  },
			  complete: function(data){
				$("#div_loading").hide();
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
        $("input[name=tpConsulta]").click(function(){
			_tpConsulta = $("input[name=tpConsulta]:checked").val();
			_cpf = $("#cpf").val();
			
			if (_cpf != ""){
        		consulta_titulos(_tpConsulta,_cpf);
        	}
		});
		$("#checkAll").click(function(){
			$('input[name=boleto]').each(function(){
				$(this).attr("checked", "checked");
				
			});
			return false;
		});
		$("#btnGerar").click(function(){
			$("#tbResultado")
			
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
			<form method="post" action="ajuste_boleto3.php">


				<div id="tabs">
					<ul>
						<li><a href="#geral">Ajuste de Boletos</a></li>

					</ul>

					<div id="geral"
						style='height: 385px; padding-left: 5px; overflow: auto'>

						<table>
							<thead>
								<tr>

									<td width='150px'>Nosso Numero</td>
									<td width='150px'>Vencimento</td>
									<td width='100px'>Valor Titulo</td>
									<td width='100px'>Valor Desconto</td>
									<td></td>



								</tr>
							</thead>
						</table>
						<div id="titulos_resultado" style="height: 350px; overflow: auto">
							<table id='tbResultado'>
								<?php
								
								foreach ( $resultado as $registro ) {
									$nn = $registro ['nNossoNumero'];
									$data = date ( "d/m/Y", strtotime ( $registro ['dVcto'] ) );
									$vlrTitulo = number_format ( $registro ['nVlrTitulo'], 2, ",", "." );
									$vlrDesconto = number_format ( $registro ['nVlrDesconto'], 2, ",", "." );
									echo "<tr '>";
									
									echo "<td width='150px'>" . $nn . "<input name='nn" . $nn . "' size='10' type='hidden' value='" . $nn . "' /></td>";
									echo "<td width='150px'><input name='dt" . $nn . "' size='10' type='text' value='" . $data . "' /></td>";
									echo "<td width='100px'><input name='vl" . $nn . "'size='10' type='text' value='" . $vlrTitulo . "' /></td>";
									echo "<td width='100px'><input name='ds" . $nn . "'size='10' type='text' value='" . $vlrDesconto . "' /></td>";
									
									echo "</tr>";
								}
								?>
							</table>
						</div>
						<button style="margin-left: 680px" id="btnGerar">Alterar</button>
					</div>


				</div>

				</p>
				<input name="boletos" id="boletos" type="hidden"
					value="<? echo str_replace("'","",$boletos); ?>" /> <input
					name="cpf" id="cpf" type="hidden" value="<? echo $cpf; ?>" />
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>