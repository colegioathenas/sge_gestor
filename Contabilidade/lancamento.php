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
<title>SGE - Sistema de Gestão Escolar [Lançamento Financeiro]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="/css/flexigrid.pack.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>


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
		 $("#tabela tr").each(function(){
				$(this).remove();
			 });
			$.get('lancamento_carregar.php?data='+$("#data").val(), function(data) {
			  $("#tabela").last().append(data);
			});
	}
	$(document).ready(function(){
		carrega_tabela();
		$( "#tabs" ).tabs();
		$("#lancamento_detalhe").dialog({modal: true
									   , autoOpen: false
									   ,width: 800
		});
		$("#data").change(function(){
                    carrega_tabela();
                });
                
                $("#lancamento_conta_cod").change(function(){
                   
                    $("#lancamento_conta").val($("#lancamento_conta option[conta='"+$(this).val()+"']").attr("value"));
                  
                });
                $("#lancamento_conta").change(function(){
                    $("#lancamento_conta_cod").val($(this).find("option:selected").attr("conta"));
                });
                
                $("#lancamento_ccusto_cod").change(function(){
                   
                    $("#lancamento_ccusto").val($(this).val());
                  
                });
                $("#lancamento_ccusto").change(function(){
                    $("#lancamento_ccusto_cod").val($(this).val());
                });
                $("#btnIncluirLcto").click(function(){
                    $("#lancamento_detalhe").dialog("open");
                    return false;
                });
		$("#btnAtualizarLcto").click(function(){
                   $.ajax({
                            url: 'lancamento_update.php',
                            async: false,
                            data: { data: $("#lancamento_data").val()
                                  , descricao: $("#lancamento_descricao").val()
                                  , valor: $("#lancamento_valor").val()
                                  , ccusto: $("#lancamento_ccusto").val()
                                  , conta: $("#lancamento_conta").val()
                                  , valor: $("#lancamento_valor").val()
                              },
                            success: function(data){
                                alert("Lancamento Realizado com sucesso!");
                                carrega_tabela();
                                $("#lancamento_detalhe").dialog("close");
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
				<div id="lancamento_detalhe" title="Lancamento"
					style="font-size: small">
					<label style="width: 150px; margin-left: 10px">Data</label> <input
						type='input' id="lancamento_data" size='12'
						value="<?php echo date("d/m/Y"); ?>" /> <br /> <label
						style="width: 150px; margin-left: 10px">Descrição</label> <input
						type='input' id="lancamento_descricao" size='69' /> <br /> <label
						style="width: 150px; margin-left: 10px">Valor</label> <input
						type='input' id="lancamento_valor" size='12' /> <br /> <label
						style="width: 150px; margin-left: 10px">Conta</label> <input
						type='input' id="lancamento_conta_cod" size='12' /> <select
						id="lancamento_conta">
                            <?php
																												$query_contas = "select * from conta_contabil order by cCodConta";
																												$contas = consulta ( "athenas", $query_contas );
																												$html_conta_contabil = "";
																												foreach ( $contas as $conta ) {
																													$lancamento = $conta ['bPermiteLancamento'];
																													$codigo = $conta ['nCdContaContabil'];
																													$nome = $conta ['cCodConta'] . " - " . $conta ['cNmConta'];
																													$conta = $conta ['cCodConta'];
																													
																													if ($lancamento == 1) {
																														$html_conta_contabil .= '</optgroup">';
																														$html_conta_contabil .= "<option value='$codigo' codigo='$codigo' conta='$conta' >$nome</option>";
																													} else {
																														$html_conta_contabil .= "<optgroup label='$nome' >";
																													}
																												}
																												echo $html_conta_contabil;
																												?>
                        </select> <br /> <label
						style="width: 150px; margin-left: 10px">Centro de Custo</label> <input
						type='input' id="lancamento_ccusto_cod" size='12' /> <select
						id="lancamento_ccusto">
                            <?php
																												
																												$query_ccusto = "select * from centro_custo";
																												$ccustos = consulta ( "athenas", $query_ccusto );
																												$html_centro_custo = "";
																												foreach ( $ccustos as $ccusto ) {
																													
																													$codigo = $ccusto ['nCdCCusto'];
																													$nome = $ccusto ['nCdCCusto'] . " - " . $ccusto ['cNmCCusto'];
																													
																													$html_centro_custo .= "<option value='$codigo' >$nome</option>";
																												}
																												echo $html_centro_custo;
																												?>
                        </select> <br /> <br /> <a href=""
						id="btnAtualizarLcto" class="sbtn">Atualizar</a>
				</div>
				<div id="tabs">
					<ul>
						<li><a href="#geral">Lançamento Financeiro</a></li>
					</ul>
					<div id="geral" style='height: 415px'>

						<label style="width: 150px; margin-left: 10px">Data</label> <input
							type='input' id="data" size='12'
							value="<?php echo date("d/m/Y"); ?>" /> <a href=""
							id="btnIncluirLcto">[ Incluir ]</a> <br />
						<br />
						<table class="tbGrid" style="font-size: small">
							<thead>
								<tr>
									<td width='50px' style="text-align: left"></td>
									<td width='200px' style="text-align: left">Descrição</td>
									<td width='50px' style='text-align: right; padding-right: 15px'>Valor</td>
									<td width="350px" style="text-align: left">Conta</td>
									<td>Centro de Custo</td>
								</tr>
							</thead>
						</table>

						<div style="height: 340px; overflow: scroll; width: 100%">
							<table class="tbGrid" id="tabela" style="font-size: small">

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