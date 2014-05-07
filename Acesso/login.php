<?php
ini_set ( "display_errors", 1 );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acesso ao Sistema</title>
<link href="/css/estilo.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-ui.js" type="text/javascript"></script>

</head>

<body style="background-color: #bbb">

	<div id="box"
		style="text-align: center; border-radius: 20px; box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); -moz-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); -webkit-box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5); padding: 10px; background-color: white; height: 300px; left: 50%; margin: -100px 0 0 -160px; position: absolute; top: 40%; width: 320px; font-family: Geneva, Arial, Helvetica, sans-serif;">



		<form name="frm1" id="frm1" method="post" action="verifica_login.php">
			<img src="/image/logo_sge.png" /> <br /> <span
				style="font-size: 20px; font-weight: bold;">Acesso ao Sistema</span>
			<br />
			<br /> <label style='margin-top: 0px'>Usuario</label> <input
				type="text" size='15' id="login" name='login'></input> <br /> <label
				style='margin-top: 5px'>Senha</label> <input type="password"
				size='15' id="senha" name='senha'></input> <br />

			<div style="text-align: right; padding-right: 20px">
				<button style='margin-top: 10px;' id="send">Entrar</button>
			</div>
			<br />
						<?php
						if ($_REQUEST ['msg'] == 'err') {
							echo "<span style='color:red;'>Usuario / Senha Invalido</span>";
						}
						if ($_REQUEST ['msg'] == 'nav') {
							echo "<span style='color:red;'>Navegador e/ou versao incompativel.<br/> Usar Firefox 16 ou superior </span>";
						}
						?>
					
   				</form>
	</div>   
             <?php
													include ("../footer.inc");
													?>
</body>
</html>
