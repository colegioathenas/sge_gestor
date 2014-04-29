<?php
$operacao = $_REQUEST ['operacao'];

if ($operacao == 'listasexo') {
	echo "<option value='M'>Masculino</option>";
	echo "<option value='F'>Feminino</option>";
}
?>