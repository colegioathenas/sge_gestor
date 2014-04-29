<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$cpf = $_SESSION ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$query = "Select dContato,cNmUsuario,cNmTpContato,cMensagem as Msg from Pessoa_contato
			inner join Usuario on Pessoa_Contato.nCdUsuario = Usuario.nCdUsuario
			inner join TipoContato on Pessoa_Contato.nCdTpContato = TipoContato.nCdTpContato
			where nCdPessoa = $cpf order by dContato DESC";
$registros = consulta ( "athenas", $query );

?>
<table class="tbGrid">
<?php
$total = 0;
foreach ( $registros as $registro ) {
	$data = date ( "d/m/Y H:i", strtotime ( $registro ['dContato'] ) );
	$Usuario = $registro ['cNmUsuario'];
	$tipo = $registro ['cNmTpContato'];
	$mensagem = $registro ['Msg'];
	echo "<tr>";
	echo "<td style='width:130px'>$data</td>
                      <td style='width:120px'>$Usuario</td>
                      <td style='width:150px'>$tipo</td>
                      <td >$mensagem</td>";
	echo "</tr>";
}

?>
</table>