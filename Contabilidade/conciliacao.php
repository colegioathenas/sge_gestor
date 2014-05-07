<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
include "../geral.php";
require ("../config.php");
include_once "../bd.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/flexigrid.pack.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
<script src="/js/cadastro_consulta.js" type="text/javascript"></script>
<script src="/js/flexigrid.pack.js" type="text/javascript"></script>
<style>
td {
	border-style: none;
	border-left-width: 0px;
	border-spacing: 0em;
}

table {
	border-style: none;
	border-left-width: 0px;
	border-spacing: 0em;
}
</style>
<script>
	function carrega_tabela(){
		_tpConsulta = $("input[name=tpConsulta]:checked").val();
		_conta = $("#conta_corrente").val();
		 $("#tabela tr").each(function(){
				$(this).remove();
			 });
			$.get('carrega_lancamento.php?conta='+_conta+'&tipo='+_tpConsulta, function(data) {
			  $("#tabela").last().append(data);
			});
	}
	$(document).ready(function(){
		carrega_tabela();
		$( "#tabs" ).tabs();
		$("#desmembrar_dialog").dialog({modal: true
									   , autoOpen: false
									   ,width: 500
		});
		$("a[name=desmembrar_btn]").live('click',function(){
			$("#desmembramento_valor").val( $(this).parent().parent().find('td:gt(2)').html());
			$("#desmembramento_lancamento").val($(this).attr("codigo"));
			$("#desmembrar_dialog").dialog("open");
			return false;
		});
		$("#desmembramento_incluir").click(function(){
			$.ajax({
				  url: 'desmembramento_incluir.php',
				
				  data: { descricao: $("#desmembramento_nova_descricao").val()
					  	, valor: $("#desmembramento_novo_valor").val()
					  	, lancamento:$("#desmembramento_lancamento").val()
					  	},
				  
				  success: function(data){
					  carrega_tabela();
					  $("#desmembrar_dialog").dialog("close");
					  alert('Desmembramento Realizado Com Sucesso');
				 
				  },
				  beforeSend:function(){
					$("#div_loading").show();
				  },
				  complete: function(data){
				  	$("#div_loading").hide();
				  }
			});
			return false;
		});
		$("input[name=tpConsulta]").click(function(){
			carrega_tabela();
		});
		$("#conta_corrente").change(function(){
			carrega_tabela();
			
		});
		$(".conta_contabil").live('change',function(e){
			$.ajax({
				  url: 'conciliacao_updade.php',
				  data: { codigo: $(this).attr('codigo')
					  	, conta: $(this).find('option:selected').attr('codigo')
					    },
				  
				  success: function(json){
				 
				  },
				  beforeSend:function(){
					$("#div_loading").show();
				  },
				  complete: function(data){
					$("#div_loading").hide();
				  }
				  
				});
			
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

			<form method="post" action="processado_ofx.php">
				<div id="desmembrar_dialog">
					<label style='margin-top: 5px; width: 100px'>Valor</label><input
						type="text" name="desmembramento_valor" id="desmembramento_valor"
						size="30" value="ARUJA" /> <br /> <label
						style='margin-top: 5px; width: 100px'>Descricao</label><input
						type="text" name="desmembramento_nova_descricao"
						id="desmembramento_nova_descricao" size="40" value="" /> <br /> <label
						style='margin-top: 5px; width: 100px'>Valor</label><input
						type="text" name="desmembramento_novo_valor"
						id="desmembramento_novo_valor" size="30" value="" /> <br /> <a
						href='' id="desmembramento_incluir" style='margin-left: 400px'>Consultar</a>
					<input type="hidden" name="desmembramento_lancamento"
						id="desmembramento_lancamento" value="" />
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral">Conciliacao Bancaria</a></li>

					</ul>
					<div id="geral" style='height: 415px'>

						<label style="width: 150px; margin-left: 10px">Conta Corrente</label>
						<select name="conta_corrente" id="conta_corrente">
							<option value="0" selected="selected">Todas</option>
								<?php
								$query = "SELECT * FROM conta_corrente";
								$contas = consulta ( "athenas", $query );
								
								foreach ( $contas as $conta ) {
									$nome = $conta ['cNmConta'];
									$cAgencia = $conta ['cAgencia'];
									$cConta = $conta ['cConta'];
									$nCdBanco = $conta ['nCdBanco'];
									$nCdConta = $conta ['nCdContaCorrente'];
									
									echo "<option value='$nCdConta'>$nome - ($cAgencia - $cConta)</option>";
								}
								
								?>
								</select> &nbsp;&nbsp; <input name="tpConsulta" type="radio"
							value="0" checked="checked" />&nbsp;Nao Conciliado <input
							name="tpConsulta" type="radio" value="1" />&nbsp;Conciliado <input
							name="tpConsulta" type="radio" value="3"
							style="margin-left: 15px" />&nbsp;Todos
						<table border="0px" width=100%>
							<tr style='background-color: black; color: white'>
								<td width='100'></td>
								<td width='80'>Data</td>
								<td width='350'>Descricao</td>
								<td width='95' style='text-align: right; padding-right: 15px'>Valor</td>
								<td>Conta Financeira</td>
							</tr>
						</table>
						<div style="height: 350px; overflow: scroll;">
							<table border="1px" id="tabela">

							</table>
						</div>


					</div>
				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>