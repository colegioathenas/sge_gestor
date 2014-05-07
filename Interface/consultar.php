<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iEscolar - <?php echo $page_title; ?></title>
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
        	_valor = $("#consulta_valor").val()
        	$.ajax({
			  url: '<?php echo url_consulta.php; ?>',
			
			  data: { action: 'consulta'
				  	, valor: _valor 
				  	},
			  
			  success: function(data){
			  	$("#resultado").html(data);
			 
			  },
			  beforeSend:function(){
				$("#div_loading").show();
			  },
			  complete: function(data){
				$("#div_loading").hide();
			  }
			  
			});
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
						<li><a href="#geral"><img
								src="../image/<?php echo page_tab_icon;?>" height="30px" />&nbsp;<?php echo page_tab_text;?></a></li>

					</ul>

					<div id="consulta"
						style='height: 410px; padding-left: 5px; overflow: auto'>
						<label style="margin-top: 15px">Consultar</label> <input
							id="consulta_valor" name="consulta_valor" type="text" size="50"
							title="CPF / Nome" />
						<button id="btnConsultar">Consultar</button>
						<div id="resultado" style='margin-top: 10px'></div>
					</div>


				</div>

			</form>
		</div>
             
             <?php include "../footer.inc"?>
         	 
         </div>
</body>
</html>
