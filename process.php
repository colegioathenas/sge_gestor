<?php
ini_set ( "display_errors", 0 );

@header ( 'Content-Type: text/html; charset=utf-8' );
$fileXML = $_REQUEST ['processo'] . ".xml";
$xml = simplexml_load_file ( $fileXML );
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
		<link href="/css/flexigrid.pack.css" rel="stylesheet" type="text/css">
			</script>
			<script src="/js/jquery.js" type="text/javascript"></script>
			<script src="/js/jquery-ui.js" type="text/javascript"></script>
			<script src="/js/consulta_inss_historico.js" type="text/javascript"></script>
			<script src="/js/flexigrid.pack.js" type="text/javascript"></script>
   
   <?php echo "<script src=\"/js/".$_REQUEST['processo'].".js\" type=\"text/javascript\"></script>"; ?>
   
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
					<h2>CONSULTA INSS - HISTORICO</h2>
				</p>
				<div id="tabs">
						<?php
						echo "<ul>";
						foreach ( $xml->containers->children () as $container ) {
							$id_conteiner = $container->attributes ();
							$nome_conteiner = $id_conteiner ['nome'];
							$id_conteiner = $id_conteiner ['id'];
							
							echo "	<li><a href=\"#" . $id_conteiner . "\">" . $nome_conteiner . "</a></li>";
						}
						echo "</ul>";
						?>
                     	<?php
																						
																						// $xml = simplexml_load_file("cliente.xml");
																						$first = true;
																						foreach ( $xml->containers->children () as $container ) {
																							$id_conteiner = $container->attributes ();
																							$id_conteiner = $id_conteiner ['id'];
																							echo "<div id=\"" . $id_conteiner . "\" style='height:310px' >";
																							foreach ( $container->campos->children () as $campo ) {
																								$id = $campo->attributes ();
																								$id = $id ['id'];
																								$descricao = $campo->nome;
																								$tipoMargem = "margin-top:";
																								$margem = 5;
																								$entrecampo = "";
																								if ($campo->margem != "") {
																									$margem = $campo->margem;
																								}
																								if ($campo->entrecampo != "") {
																									$entrecampo = " style='margin-left:" . $campo->entrecampo . "px' ";
																								}
																								
																								if ($first == false) {
																									$tipoMargem = "margin-left:";
																								}
																								echo "<label style='" . $tipoMargem . $margem . "px'>" . $descricao . "</label>";
																								if ($campo->tipo == "text") {
																									echo "<input " . $entrecampo . " type=\"text\" name=\"" . $id . "\" id=\"" . $id . "\"  size=\"" . $campo->tamanho . "  \"/>";
																								}
																								if ($campo->tipo == "combo") {
																									echo "<select " . $entrecampo . " name=\"" . $id . "\" id=\"" . $id . "\"   \">";
																									
																									foreach ( $campo->opcoes->children () as $opcao ) {
																										$id_opcao = $opcao->attributes ();
																										$id_opcao = $id_opcao ['id'];
																										
																										echo "<option id=\"" . $id_opcao . " \">" . $opcao . "</option>";
																									}
																									echo "</select>";
																								}
																								if ($campo->fim == 1) {
																									echo "<br/>";
																									$first = true;
																								} else {
																									$first = false;
																								}
																							}
																							echo "</div>";
																						}
																						?>
                     </div>


				<br />
				<br /> <a class="sbtn">Consultar</a> <span id='descontos'></span> <br />
				<input type="hidden" id="metodo"
					value="<?php echo $_REQUEST['metodo']; ?>" /> <input type="hidden"
					id="param1" value="<?php echo $_REQUEST['matricula']; ?>" />

				</p>

				<iframe id="upload_target" name="upload_target" src="#"
					style="width: 0; height: 0; border: 0px solid #fff;"></iframe>
			</form>
		</div>
             
             <?php include "footer.inc"?>
         	 
         </div>
</body>