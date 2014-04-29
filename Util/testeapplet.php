<html>
<head>
<script>
 function voltar(){
   history.go(-1);
 }
</script>
</head>
<body>
	<APPLET CODE="urutuprint.class" ARCHIVE="urutuprint.jar" WIDTH=800
		HEIGHT=600>
		<PARAM name="modelo" value="<?php echo $_REQUEST['modelo']; ?> ">
		<PARAM name="p1" value="<?php echo $_REQUEST['p1']; ?>">
		<PARAM name="p2" value="<?php echo $_REQUEST['p2']; ?>">
		<PARAM name="p3" value="<?php echo $_REQUEST['p3']; ?>">
		<PARAM name="p4" value="<?php echo $_REQUEST['p4']; ?>">
		<PARAM name="p5" value="<?php echo $_REQUEST['p5']; ?>">
	</APPLET>
</body>
</html>
