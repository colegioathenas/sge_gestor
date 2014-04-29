<?php
session_start ();
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$nCdTurma = $_REQUEST ['turma'];
$query = "SELECT nCdMatricula
                   , nChamada
                   , cNome    
                FROM matricula
                     INNER JOIN pessoa ON pessoa.nCdPEssoa = matricula.`nCdPessoa`
               WHERE nCdTurma = $nCdTurma
              ORDER BY nChamada;";

$registros = consulta ( "athenas", $query );
echo "<table class='grid'>";
foreach ( $registros as $registro ) {
	$chamada = $registro ['nChamada'];
	$nome = $registro ['cNome'];
	$matricula = $registro ['nCdMatricula'];
	echo "<tr>
                <td><input type='checkbox' value='$matricula' name='matricula' /></td>
                <td>$chamada</td>
                <td>$nome</td>
             </tr>";
}
echo "</table>";
?>
