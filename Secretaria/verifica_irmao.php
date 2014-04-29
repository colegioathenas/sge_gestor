<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );

$cpfresp = $_REQUEST ['cpfresp'];
$serie = $_REQUEST ['serie'];

$cpfresp = str_replace ( ".", "", $cpfresp );
$cpfresp = str_replace ( "-", "", $cpfresp );

$query = "SELECT aluno_mat 
			  FROM matriculado 
				   INNER JOIN cursos on serie = nCdCurso
			where resp_cpf = $cpfresp
			 and cOrdem >=  (Select cOrdem from Cursos where nCdCurso = $serie)";

$resultado = consulta ( "athenas", $query );

echo $resultado [0] ['aluno_mat'];

?>