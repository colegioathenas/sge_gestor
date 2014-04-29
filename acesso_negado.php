<?php
ini_set ( "display_errors", 0 );
include ("verifica_logado.php");
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
	<div id="container">
            <?php include "header.inc"?>
            <div id="menu"><?php include "menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1">

				<div style="height: 485px">

					<span style="font-size: 25px">Acesso Negado</span>

				</div>
			</form>
		</div>
             
             <?php include "footer.inc"?>
         	 
         </div>
</body>