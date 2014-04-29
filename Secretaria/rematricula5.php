<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );

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


<script>
	$(function() {
        $("#tabs").tabs();
        $("#btnContrato").click(function(){
            var width = 850;
		    var height = 600;
		    var left = parseInt((screen.availWidth/2) - (width/2));
		    var top = parseInt((screen.availHeight/2) - (height/2));
		    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
		   
		    window.open("../contrato.php", "Contrato", windowFeatures);
        	//window.open("../contrato.php", "Contrato", "width=850,height=600,scrollbars=yes");
 
        	return false;
        });
        $("#btnRM").click(function(){
        	var width = 850;
		    var height = 600;
		    var left = parseInt((screen.availWidth/2) - (width/2));
		    var top = parseInt((screen.availHeight/2) - (height/2));
		    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
		   
        	window.open("../registro_matricula.php", "Registro de Matricula", windowFeatures);
 
        	return false;
        });
        $("#btnBoletos").click(function(){
        	var width = 900;
		    var height = 600;
		    var left = parseInt((screen.availWidth/2) - (width/2));
		    var top = parseInt((screen.availHeight/2) - (height/2));
		    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
		   
        	window.open("../Boleto/gerarboletos.php", "Boletos", windowFeatures);
 
        	return false;
        });
    });
    </script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1" method="post" action="verificafin.php">
				<p>
					<h2><?php echo $_SESSION['tipo']; ?> 5/5</h2>
				</p>
				<div id="tabs">
					<ul>
						<li><a href="#impressao">Impressao</a></li>


					</ul>
					<div id="impressao" style="height: 370px; overflow: auto">
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<table width="100%">
							<tr>
								<td align="center"><button id="btnContrato">Contrato</button></td>
								<td align="center"><button id="btnRM">RM</button></td>
								<td align="center"><button id="btnBoletos">Boletos</button></td>
							</tr>
						</table>
					</div>

				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>