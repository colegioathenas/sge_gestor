<?php
ini_set ( "display_errors", 0 );
include ("verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Secretaria]</title>
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
																													if ($_SESSION ['SECREMAT'] == "00001") {
																														echo "<td>
                                        <a href=\"/Secretaria/rematricula.php?tipo=rematricula\" ><img src=\"/image/icon_matricula.png\" /> <br/> ReMatricula</a>
                                    </td>";
																													}
																													if ($_SESSION ['SECMAT'] == "00001") {
																														echo "<td>
                                        <a href=\"/Secretaria/rematricula.php?tipo=matricula\" ><img src=\"/image/icon_matricula.png\" /> <br/> Matricula</a>
                                    </td>";
																													}
																													if ($_SESSION ['SECLSTVAGA'] == "00001") {
																														echo "<td>
                                        <a href=\"/Secretaria/lista_vagas.php\" ><img src=\"/image/icon_lista_vagas.png\" /> <br/> Lista de Vagas</a>
                                    </td>";
																													}
																													?>
                              
                         </tr>
				</table>
			</form>
		</div>
	</div>
        <?php include "../footer.inc"?>
</body>
</html>