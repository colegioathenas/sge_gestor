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
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>


<script>
	$(function() {
        $( "#nomeirmao" ).autocomplete({
             source: function(request, response) {
			    $.getJSON("search.php", { consulta:'matricula', serie: $('#serieirmao').val(), term: $('#nomeirmao').val() }, 
			              response);
			  },
            minLength: 2,
            select: function( event, ui ) {
            	
            	$("#matirmao").val(ui.item.id);
            	$("#nomeirmao").val(ui.item.label);
            	
            	return false;
            }
        });
        $("#send").click(function(){
        	if ($("#matirmao").val() == ""){
	        	$('<div></div>').appendTo('body')
	                    .html('<center>Nenhum aluno foi escolhido <br/>Deseja Continuar?</center>')
	                    .dialog({
	                        modal: true, title: 'Aviso', zIndex: 10000, autoOpen: true,
	                        width: 'auto', resizable: false,
	                        buttons: {
	                            'Sim': function () {
	                                $("#frm1").submit(); 
	                            },
	                            'Nao': function () {
	                                $(this).dialog("close");
	                            }
	                        },
	                        close: function (event, ui) {
	                            $(this).remove();
	                        }
	                    });
               }else{
               		$("#frm1").submit();
               }
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

			<form method="post" action="rematricula4.php">
				<p>
					<h2><?php echo $_SESSION['tipo']; ?> 2/5</h2>
				</p>
				<div style="height: 440px">
					<label for="serieirmao" style='width: 120px; margin-top: 5px'>Serie:</label>
					<select id="serieirmao" name="serieirmao">
						<option value='0'>SELECIONE...</option>
   					 		<?php
											
											if ($_SESSION ['serie'] <= 0) {
												echo "<option value='0'>Selecione</option>";
											}
											if ($_SESSION ['serie'] <= - 1) {
												echo "<option value='-2'> PRE I</option>";
											}
											if ($_SESSION ['serie'] <= - 1) {
												echo "<option value='-1'> PRE II</option>";
											}
											
											if ($_SESSION ['serie'] <= 1) {
												echo "<option value='1'>ENSINO FUNDAMENTAL I - 1&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 2) {
												echo "<option value='2'>ENSINO FUNDAMENTAL I - 2&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 3) {
												echo "<option value='3'>ENSINO FUNDAMENTAL I - 3&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 4) {
												echo "<option value='4'>ENSINO FUNDAMENTAL I - 4&deg; Ano </option>";
											}
											if ($_SESSION ['serie'] <= 5) {
												echo "<option value='5'>ENSINO FUNDAMENTAL I - 5&deg; Ano </option><";
											}
											if ($_SESSION ['serie'] <= 6) {
												echo "<option value='6'>ENSINO FUNDAMENTAL II - 6&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 7) {
												echo "<option value='7'>ENSINO FUNDAMENTAL II - 7&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 8) {
												echo "<option value='8'>ENSINO FUNDAMENTAL II - 8&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 9) {
												echo "<option value='9'>ENSINO FUNDAMENTAL II - 9&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 10) {
												echo "<option value='10'>ENSINO MEDIO - 1&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 11) {
												echo "<option value='11'>ENSINO MEDIO - 2&deg; Ano</option>";
											}
											if ($_SESSION ['serie'] <= 12) {
												echo "<option value='12'>ENSINO MEDIO - 3&deg; Ano</option>";
											}
											?>
   					 	</select> <br /> <label for="nomeirmao"
						style='width: 120px; margin-top: 5px'>Nome do Irmao: </label> <input
						id="nomeirmao" name="nomeirmao" size="50" /> <input id="matirmao"
						name='matirmao' type='hidden' /> <br />
					<button id='send' style='margin-left: 400px; margin-top: 5px'>Proximo</button>
				</div>
			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
