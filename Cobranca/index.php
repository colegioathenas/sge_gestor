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
																													if ($_SESSION ['COBACORDO'] == "00001") {
																														echo "<td>
                                        <a href=\"/Cobranca/acordo_consultar.php\" ><img src=\"/image/icon_acordo_consultar.png\" /> <br/> Consulta Acordo </a>
                                    </td>";
																														echo "<td>
                                        <a href=\"/Cobranca/acordo.php\" ><img src=\"/image/icon_acordo_novo.png\" /> <br/> Novo Acordo</a>
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
																												if ($_SESSION ['RELCARTCOB'] == "00001") {
																													echo "<td>
                                        <a href=\"/Relatorio/carta_cobranca.php\" ><img src=\"/image/icon_carta.png\" /> <br/>Carta de Cobran&ccedila</a>
                                    </td>";
																												}
																												if ($_SESSION ['RELCARTCOBL'] == "00001") {
																													echo "<td>
                                        <a href=\"/Relatorio/carta_cobranca_lote.php\" ><img src=\"/image/icon_carta_lote.png\" /> <br/>Carta de Cobran&ccedila (Lote)</a>
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