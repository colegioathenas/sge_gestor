<?php
ini_set ( "display_errors", 0 );
include ("verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar</title>
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
     <?php include "header.inc"?>
       <div id="container">

		<div id="menu"><?php include "menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1" method="post" action="verificafin.php">
				<table style="width: 100%; text-align: center">
					<tr style="height: 200px; vertical-align: bottom">
						<td><a href="/Acesso/index.php"><img
								src="/image/icon_seguranca.png" /> <br /> Segurança</a></td>
                             <?php
																													if ($mostra_fin == true) {
																														echo "<td>
                                        <a href=\"/Pessoa/index.php\" ><img src=\"/image/icon_cadastro.png\" /> <br/> Cadastro</a>
                                    </td>";
																													}
																													if ($mostra_aca == true) {
																														echo "<td>
                                            <a href=\"/Academico/index.php\" ><img src=\"/image/icon_academico.png\" /> <br/> Academico</a>
                                        </td>";
																													}
																													if ($mostra_sec == true) {
																														echo "<td>
                                           <a href=\"/Secretaria/index.php\" ><img src=\"/image/icon_secretaria.png\" /> <br/> Secretaria</a>
                                       </td>";
																													}
																													
																													if ($mostra_fin == true) {
																														echo "<td>
                                            <a href=\"/Financeiro/index.php\" ><img src=\"/image/icon_financeiro.png\" /> <br/> Financeiro</a>
                                        </td>";
																													}
																													
																													if ($mostra_cob == true) {
																														echo "<td>
                                          <a href=\"/Cobranca/index.php\" ><img src=\"/image/icon_cobranca.png\" /> <br/> Cobranca</a>
                                      </td>";
																													}
																													if ($mostra_cnt == true) {
																														echo "<td>
                                            <a href=\"/Acesso/index.html\" ><img src=\"/image/icon_contabilidade.png\" /> <br/> Contabilidade</a>
                                        </td>";
																													}
																													if ($mostra_rh == true) {
																														echo "<td>
                                            <a href=\"/rh/index.html\" ><img src=\"/image/icon_rh.png\" /> <br/> Recursos Humanos</a>
                                        </td>";
																													}
																													?>
                              
                         </tr>
				</table>
			</form>
		</div>
	</div>
        <?php include "footer.inc"?>
</body>
</html>
