<?php
include ("../verifica_logado.php");
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
<script src="/js/jquery_masc.js" type="text/javascript"></script>
<script src="/js/pessoa_cadastro.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
		$( "#tabs" ).tabs();
		$( "#btnConsultar" ).click(function(){
			
        	_senha 			 = $("#senha_atual").val();
        	_nova_senha		 = $("#nova_senha").val();
        	_confirmar_senha = $("#confirmar_senha").val();
        	
        	if (_nova_senha != _confirmar_senha){
        		alert('Confirmação de Senha Inválida');
        	}else{
	        	
	        	$.ajax({
				  url: 'senha_alterada.php',
				  data: { senha: _senha, nova_senha: _nova_senha },
				  success: function(data){
				  	$("#msg").val(data);
				  	alert(data);	
				  
				  },
				 beforeSend:function(){
					$("#div_loading").show();
					},
				complete: function(data){
					$("#div_loading").hide();
					} 
				  
				});
			}
			
			return false;
        	
        });
	});
	</script>
</head>

<body>
	<div id="container">
			<?php include "../loading.inc"?>
            <?php include "../header.inc"?>
            <div id="menu"><?php include "../menu.inc"; ?></div>

		<div id="content">

			<form method="post">


				<div id="tabs">
					<ul>
						<li><a href="#geral">Alterar Senha</a></li>

					</ul>

					<div id="consulta"
						style='height: 385px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Senha Atual</label> <input
							id="senha_atual" name="senha_atual" type="password" size="10" />
						<br /> <label style="margin-top: 15px">Nova Senha</label> <input
							id="nova_senha" name="nova_senha" type="password" size="10" /> <br />
						<label style="margin-top: 15px">Confirmar</label> <input
							id="confirmar_senha" name="confirmar_senha" type="password"
							size="10" /> <br /> <input id="msg" name="msg" type="hidden" />
						<button id="btnConsultar">Alterar</button>
						<div id="resultado"></div>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>