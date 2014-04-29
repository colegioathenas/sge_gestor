<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGE - Sistema de Gestão Escolar [Matricula]</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
				
		$( "#tabs" ).tabs();
		$("#carne").click(function(){
			_valores = $("#boletos").val();			
			var width = 850;
			    var height = 600;
			    var left = parseInt((screen.availWidth/2) - (width/2));
			    var top = parseInt((screen.availHeight/2) - (height/2));
			    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
			   
			    window.open("../Boleto/boletopdf2.php?nCdBoleto="+_valores, "Contrato", windowFeatures);
			return false;
			
		});
		$("#contrato_serv").click(function(){
			_valor = $("#matricula").val();			
			var width = 850;
			    var height = 600;
			    var left = parseInt((screen.availWidth/2) - (width/2));
			    var top = parseInt((screen.availHeight/2) - (height/2));
			    var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
			   
			    window.open("../Relatorio/contrato_serv.php?matricula="+_valor, "Matricula", windowFeatures);
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
			<form method="post">
				<div id="tabs">
					<ul>
						<li><a href="#geral"><img src="../image/matricula.png"
								height="30px" />&nbsp;Matricula</a></li>
					</ul>
					<div id="consulta"
						style='height: 350px; padding-left: 5px; overflow: auto'>
						<table style="width: 100%; text-align: center">
							<tr style="height: 200px; vertical-align: bottom">
								<td><a href="#" id="contrato_serv"><img
										src="/image/icon_contrato_serv.png" width="100px" /> <br />
										Contrato <br /> Serv. Educacionais</a></td>
								<td><a href="#" id="contrato_mat"><img
										src="/image/icon_contrato_mat.png" width="100px" /> <br />
										Contrato <br /> Material Didático</a></td>
								<td><a href="#" id="registro_matricula"><img
										src="/image/icon_registro_matricula.png" width="70px" /> <br />
										Registro de <br /> Matricula</a></td>
								<td><a href="#" id="carne"><img
										src="/image/icon_boleto_imprimir.png" /> <br /> Boletos </a></td>
							</tr>
						</table>
					</div>
				</div>
				<input type="text" id="matricula"
					value="<?php echo $_SESSION['matricula'];?>" /> <input type="text"
					id="boletos" value="<?php echo $_SESSION['boletos'];?>" />
			</form>
		</div>
		<?php include "../footer.inc"?>
	</div>
</body>
</html>
