<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
session_start ();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Dados Cadastrais</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css"
	rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"
	type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"
	type="text/javascript"></script>


<script>
	$(function() {
        
    });
    </script>
</head>

<body>
	<div id="container">
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">


			<form name="frm1" id="frm1" method="post" action="verificairmao.php">
				<p>
					<h2><?php echo $_SESSION['tipo']; ?> 2/5</h2>
				</p>

				<div style="height: 440px">
					<label for="nome" style='width: 120px'>Irm&atilde;o Matriculado em
						S&eacute;rie Superior: </label> <select id="irmaomat"
						name="irmaomat">
						<option value='0'>NAO</option>
						<option value='1'>SIM</option>
					</select> <br />
					<button id='proximo' style='margin-top: 5px'>Proximo</button>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 	
         </div>
</body>
</html>