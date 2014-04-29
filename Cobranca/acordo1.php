<?php
ini_set ( "display_errors", 0 );
include ("verifica_logado.php");
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


<script>
	function incluir_fluxo_pagamento(){
		
		var linha = "<tr><td width='25px'><img src='../image/remove_icon.png' name='fluxo_remover' height='15px' title='Excluir Lan&ccedil;amento'/></td><td width='100px'>"+$("#fluxo_incluir_data").val()+"</td><td width='200px'>"+$("#fluxo_incluir_valor").val()+"</td><td width='200px'>"+$("#fluxo_incluir_tipo option:selected").text()+"</td></tr>";
			  $("#tabela_fluxo_pgto").last().append(linha);
			
	}
	$(function() {
		$( "#tabs" ).tabs();
		$("img[name=fluxo_remover]").live('click',function(){
			var valor = $(this).parent().parent().find('td:gt(1)').html().replace(".","").replace(",",".");
			var vlr_restante = $("#vlr_restante").text().replace(".","").replace(",",".");
			vlr_restante = parseFloat(vlr_restante) + parseFloat(valor);
			$("#vlr_restante").text( vlr_restante.toFixed(2).replace(".",",") );
			$(this).parent().parent().remove();
			
		});
		$("#fluxo_incluir_data").mask("99/99/9999");
		$("#fluxo_incluir_dialog").dialog( {modal: true, autoOpen: false, width: 280, height: 180} );

		$("#fluxo_pagamento_add").click(function(){
			$("#fluxo_incluir_dialog").dialog('open');
		});

		$("#fluxo_incluir_add").click(function(){
			var msg = '';
			if ($("#fluxo_incluir_tipo").val() < 1){
				msg = 'Selecione um tipo de pagamento';
			}
			
			if (msg == ''){
				incluir_fluxo_pagamento();
				var vlr_restante = $("#vlr_restante").text().replace(".","").replace(",",".");
				vlr_restante = parseFloat(vlr_restante) - parseFloat($("#fluxo_incluir_valor").val().replace(",","."));
				$("#vlr_restante").text( vlr_restante.toFixed(2).replace(".",",") );
				$("#fluxo_incluir_dialog").dialog('close');
			}else{
				alert(msg);
			}
		});
        
        $("#dt_vcto").change(function(){
        	
        	$.ajax({
				  url: 'acordo_recalculo.php',
				  dataType: 'json',
				  data: { recalculo: "sim"
				  		, boletos: $("#boletos").val()
				  		, cpf:	$("#cpf").val()
				  		, dt_vcto: $("#dt_vcto").val()
				  		},
				  success: function(json){
				  	$("#vlrDivida").val(json.VlrTotal);
				  	$("#vlrDesconto").val("0,00");
				  	$("#vlrTotal").val(json.VlrTotal);
				  	$("#vlr_restante").text(json.VlrTotal);
				  }
				});
        });
        $("#vlrDesconto").change(function(){
        	var valor = parseFloat($("#vlrDivida").val().replace(".", "").replace(",", ".")) - parseFloat($("#vlrDesconto").val().replace(".", "").replace(",", "."));
        	$("#vlrTotal").val(valor.toFixed(2).replace(".",","));
        	$("#vlr_restante").text(valor.toFixed(2).replace(".",","));
        	return false;
        });
        $("#btnEfetivar").click(function(){
            var str = "";
        	 $("#tabela_fluxo_pgto tr").each(function(){
				
					str = str  + $(this).find("td").eq(1).html() + ";" + $(this).find("td").eq(2).html() + ";" + $(this).find("td").eq(3).html() + "|" ;
			
            });
            $("#fluxo_pgto").val(str);
            $("#frm1").submit();	
			return false;
        });
        
    });
	
    </script>

</head>

<?php
include ('acordo_recalculo.php');
?>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<div id="tabs">
				<ul>
					<li><a href="#geral">Acordo / Renegocia&ccedil;&atilde;o</a></li>

				</ul>

				<div id="geral"
					style='height: 425px; padding-left: 5px; overflow: auto'>
					<form name="frm1" id="frm1" method="post" action="acordo2.php">
						<input type='hidden' id='hoje' value='<?php echo date('d/m/Y');?>'></input>
						<input type='hidden' id='cpf' name='cpf'
							value='<?php echo $cpf;?>'></input> <input type='hidden'
							id='boletos' name='boletos' value='<?php echo $boletos.",";?>'></input>
						<input type='hidden' id='fluxo_pgto' name='fluxo_pgto' value=""></input>
						<div id="fluxo_incluir_dialog" title='Incluir Fluxo Pgto'>
							<label>Data</label> <input id="fluxo_incluir_data"
								style='margin-top: 5px' type="text" size="15" /> <br /> <label>Valor</label>
							<input id="fluxo_incluir_valor" style='margin-top: 5px'
								type="text" size="15" /> <br /> <label>Forma</label> <select
								style='margin-top: 5px' id='fluxo_incluir_tipo'>
								<option value='0'>Selecionar</option>
								<option value='1'>Especie</option>
								<option value='2'>Cheque</option>
								<option value='3'>Boleto</option>
							</select>
							<button style="margin-top: 4px" id="fluxo_incluir_add">Incluir</button>
						</div>

						<div style="height: 350px">
							<label>Vencimento</label> <input id="dt_vcto" name="dt_vcto"
								type="text" size="15" value="<?php echo date("d/m/Y"); ?>" /> <br />
							<label>Divida</label> <input id="vlrDivida"
								style="margin-top: 5px" name="vlrDivida" type="text" size="15"
								value="<?php echo number_format($vlr_divida,2,",","."); ?>" /> <br />
							<label>Desconto</label> <input id="vlrDesconto"
								style="margin-top: 5px" name="vlrDesconto" type="text" size="15"
								value="0,00" /> <br /> <label>Valor Total</label> <input
								id="vlrTotal" style="margin-top: 5px" name="vlrTotal"
								type="text" size="15"
								value="<?php echo number_format($vlr_divida,2,",","."); ?>" /> <br />
							<br /> <span style='font-size: large; font-weight: bold'>Proposta
								de Fluxo de Pagamento</span> <img id='fluxo_pagamento_add'
								src='../image/pagamento_add.png' height="20px"
								title='Adicionar pagamento' /> <label
								style="margin-left: 100px; width: 60px;">Restante:</label> <label
								id="vlr_restante" style="text-align: right; width: 65px"><?php echo number_format($vlr_divida,2,",","."); ?></label>
							<table>
								<tr style='background-color: black; color: white'>
									<td width='25px'></td>
									<td width='100px'>Data</td>
									<td width='200px'>Valor</td>
									<td width='200px'>Forma</td>
								</tr>

							</table>
							<div style="height: 235px; overflow: scroll;">
								<table id="tabela_fluxo_pgto">
								</table>
							</div>

							<button id="btnEfetivar">Efetivar</button>
						</div>


					</form>
				</div>
			</div>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>