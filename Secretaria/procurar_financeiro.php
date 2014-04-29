<?php
include ("../verifica_logado.php");
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

</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form name="frm1" id="frm1" method="post" action="verificafin.php">

				<div style="height: 310px; text-align: center; margin-top: 180px">
					<h1>ATENÇÃO</h1>
					<!--
                 	 	 <span style="font-size: 25px">Esta Matricula deve ser realizada no setor financeiro</span>
                 	 	 -->
					<br /> <span style="font-size: 15px; color: red">
                 	 	 <?php
																					if ($_REQUEST ['param'] == '02') {
																						echo "Restri&ccedil;&atilde;o Interna";
																					}
																					if ($_REQUEST ['param'] == '01') {
																						echo "Verificar Responsavel Financeiro";
																					}
																					if ($_REQUEST ['param'] == '03') {
																						echo "Restri&ccedil;&atilde;o Externa";
																					}
																					?>
                 	 	 </span>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>