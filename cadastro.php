<?php
ini_set ( "display_errors", 0 );

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
            <?php include "header.inc"?>
            <div id="menu"><?php include "menu.inc"; ?></div>

		<div id="content">

			<form method="post">
				<p>
					<h2>CADASTRO - CONSULTAR</h2>
				</p>

				<div id="tabs">
					<ul>
						<li><a href="#consulta">Consulta</a></li>
					</ul>
					<div id="consulta" style='height: 350px'>
						<label>Consultar</label> <input type="text" size='80'
							id="procurar" title='Inserir Nome ou CPF'></input> <input
							type="button" value="Consultar" class='sbtn' />
						<div id="resultado" style='height: 300px; overflow: auto'></div>
					</div>
				</div>
				</p>
			</form>
		</div>
             
             <?php include "footer.inc"?>
         	 
         </div>
</body>