<html>
<head>
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>
<script>
				$(document).ready(function(){
					$("#processar").click(function(){
						  d = new Date();
							$.ajax({    
                        url: 'inss1.php',
                        async: false,
                        data: { },
												beforeSend: function(msg){
													$("#log").val("Acessando DataPrev");
												},
                        success: function(data){
                         	$("#hoje").val(data);
													$("#captcha").attr("src","inss.jpg?"+d.getTime());
													$("#log").val("");
                        }
									});
							$.ajax({    
                        url: 'inss2.php',
                        async: false,
                        data: { },
												beforeSend: function(msg){
													$("#log").val("Lendo Captcha");
												},
                        success: function(data){
                         	$("#captchaTxt").val(data);
													$("#log").val("");
                        }
									});
							$.ajax({    
                        url: 'inss3.php',
                        async: false,
                        data: { nb : $("#nb").val()
															, dn : $("#dtnasc").val()
															, nome : $("#nome").val()
															, cpf : $("#cpf").val()
															, hoje : $("#hoje").val()
															,captcha : $("#captchaTxt").val()
															},
												beforeSend: function(msg){
													$("#log").val("Aguardando DataPrev");
												},
                        success: function(data){
													$("#log").val("Consulta Realizada com Sucesso");
													var width = 850;
																var height = 600;
																var left = parseInt((screen.availWidth/2) - (width/2));
																var top = parseInt((screen.availHeight/2) - (height/2));
																var windowFeatures = "width=" + width + ",height=" + height + ",scrollbars=yes,status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
															 
																window.open($("#nb").val()+".html", "Detalhamento", windowFeatures);
													
                        }
									});
							return false;
					});
				});
			 </script>
</head>
<body>
	<input id='hoje' type="hidden" />
	<table>
		<tr>
			<td>NB</td>
			<td><input id="nb" size="10" value="1189005210"></td>
		</tr>
		<tr>
			<td>Dt. Nasc</td>
			<td><input id="dtnasc" size="10" value="03/01/1943"></td>
		</tr>
		<tr>
			<td>Nome</td>
			<td><input id="nome" size="40" value="ANTONIO DE OLIVEIRA FILHO"></td>
		</tr>
		<tr>
			<td>CPF</td>
			<td><input id="cpf" size="11" value="01234692287"></td>
		</tr>
	</table>
	<a href="#" id="processar">Processar</a>
	<br />
	<input id="log" size=100 />
	<br />
	<table>
		<tr>
			<td>Imagem do INSS</td>
			<td><img src="" id="captcha" /></td>
			<td>Leitura da Imagem</td>
			<td><input id="captchaTxt" size=5 value="" /></td>
		</tr>
		<div id="resultado"></div>
		<body>
		
		
		</html>