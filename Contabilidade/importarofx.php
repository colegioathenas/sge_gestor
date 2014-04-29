<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
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
<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
<script src="/js/cadastro_consulta.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
	});
	</script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form method="post" action="upload_file.php"
				enctype="multipart/form-data">
				<div id="tabs">
					<ul>
						<li><a href="#geral">Importar OFX - Extrato Bancario</a></li>

					</ul>
					<div id="geral" style='height: 415px'>
						Enviar o arquivo: <input type="file" name="arquivo" size="20" /><br />
						<input type="submit" value="Enviar" />
					</div>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>