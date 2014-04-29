<?php
session_start ();
?>
<!--
<script src="/js/voip.js" type="text/javascript"></script>
-->
<div id="msg"></div>
<div id="header">
	<div id="header_left">
		<img src="/image/logo_sge.png" style="width: 150px" />
	</div>
	<div id="header_main">
		<center></center>
	</div>
	<div id="header_right">
		INSTITUTO EDUCACIONAL JR LTDA <br /> <span
			style="color: black; font-size: 10px;"><span
			style="font-weight: normal">Bem-Vindo</span> <?php echo $_SESSION['usuario_nome']; ?><span>
				<br />
				<div id="relogio"></div>
	
	</div>
</div>