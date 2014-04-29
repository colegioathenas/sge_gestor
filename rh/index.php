<?php
ini_set ( "display_errors", 0 );
include ("verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Financeiro]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css">
	</script>
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css">
		</script>
		<script src="/js/jquery.js" type="text/javascript"></script>
		<script src="/js/jquery-ui.js" type="text/javascript"></script>


		<script>
	$(function() {
        $( "#nome" ).autocomplete({
            source: "search.php?consulta=lista",
            minLength: 2,
            select: function( event, ui ) {
            	$("#serie").val(ui.item.id);
            	$("#mat").val(ui.item.info);
               
            }
        });
        $("#send").click(function(){ ("#frm1").submit(); return false;});
    });
	
    </script>
		</script>

</head>

<body>
     <?php include "../header.inc"?>
       <div id="container">

		<div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1" method="post" action="verificafin.php">
				<table style="width: 100%; text-align: center">
					<tr style="height: 200px; vertical-align: bottom">                           
                             <?php
																													if ($_SESSION ['RHCADHOR'] == "00001") {
																														echo "<td>
                                        <a href=\"/Financeiro/titulo.php\" ><img src=\"/image/icon_boleto_adicionar.png\" /> <br/> Cadastro de Horário</a>
                                    </td>";
																													}
																													if ($_SESSION ['RHCADESC'] == "00001") {
																														echo "<td>
                                        <a href=\"/Financeiro/titulo.php\" ><img src=\"/image/icon_boleto_imprimir.png\" /> <br/>Cadastro de Escala</a>
                                    </td>";
																													}
																													if ($_SESSION ['RHCADFUNC'] == "00001") {
																														echo "<td>
                                        <a href=\"/Financeiro/baixa.php\" ><img src=\"/image/icon_boleto_baixar.png\" /> <br/>Cadastro de Funcionario</a>
                                    </td>";
																													}
																													if ($_SESSION ['RHCADEMP'] == "00001") {
																														echo "<td>
                                        <a href=\"/Financeiro/ajuste_boleto.php\" ><img src=\"/image/icon_boleto_editar.png\"/> <br/>Cadastro de Empresa</a>
                                    </td>";
																													}
																													?>
                         </tr>
					<tr style="height: 200px; vertical-align: bottom"> 
                            <?php
																												if ($_SESSION ['RELINA'] == "00001") {
																													echo "<td>
                                        <a href=\"/Relatorio/inadimplencia.php\" ><img src=\"/image/icon_relatorio_boleto_aberto.png\" /> <br/>Relatorio de Inadimplencia</a>
                                    </td>";
																												}
																												if ($_SESSION ['RELTITBX'] == "00001") {
																													echo "<td>
                                        <a href=\"/Relatorio/titulos_baixados.php\" ><img src=\"/image/icon_relatorio_boleto_baixado.png\" /> <br/>Relatorio de Titulos Baixados</a>
                                    </td>";
																												}
																												if ($_SESSION ['RELPREV'] == "00001") {
																													echo "<td>
                                        <a href=\"/Relatorio/prev.php\" ><img src=\"/image/icon_relatorio_recebimento.png\" /> <br/>Previs&atilde;o de Recebimento</a>
                                    </td>";
																												}
																												?>
                             </tr>
					<tr style="height: 200px; vertical-align: bottom"> 
                                     <?php
																																					if ($_SESSION ['FINRET'] == "00001") {
																																						echo "<td>
                                        <a href=\"/Relatorio/prev.php\" ><img src=\"/image/icon_processar_arquivo.png\" width=100 /> <br/>Capturar Arquivo de Retorno</a>
                                    </td>";
																																					}
																																					
																																					?>
                              
                         </tr>
					<tr></tr>
				</table>
			</form>
		</div>
	</div>
        <?php include "../footer.inc"?>
</body>
</html>