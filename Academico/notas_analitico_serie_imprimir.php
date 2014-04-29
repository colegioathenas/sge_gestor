<html>
<head>
<meta charset="utf-8" />

<title>Notas Analitico</title>
<STYLE>
p.quebra {
	page-break-before: always;
}

.header {
	text-align: center;
}

table tbody td {
	border-collapse: collapse;
	border-width: 1px;
	border-style: solid;
}

table tbody tr {
	border-collapse: collapse;
	border-width: 1px;
	border-style: solid;
}

table {
	border-collapse: collapse;
	font-size: x-small;
}

.disciplina {
	width: 150px;
}

thead {
	
}

.titulo {
	font-size: larger;
	font-weight: bold;
	text-align: center
}

.nota {
	width: 33px;
	text-align: center;
	font-family: sans-serif
}

.falta {
	width: 33px;
	text-align: center
}

.media {
	width: 30px;
	text-align: center
}
</STYLE>
</head>
<body onload="">
<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
include ("../bd.php");

$nCdturma = $_REQUEST ['tumrma'];

$query = "select * from matricula where nCdMatricula in ($matriculas) order by nChamada ";
$registros = consulta ( "athenas", $query );
$i = 0;
$html = "";
foreach ( $registros as $registro ) {
	$query_cabecalho = "SELECT cursos.`cNmCurso`
    		                      , turma.`cNmTurma`
                                  , pessoa.`cNome`	
                                  , matricula.nCdMatricula
                                  , matricula.nChamada
        						FROM matricula
             						 INNER JOIN pessoa ON matricula.`nCdPessoa` = pessoa.`nCdPessoa`
             						 INNER JOIN turma ON turma.ncdturma =  matricula.`nCdTurma`
             						 INNER JOIN `cursos` ON cursos.`nCdCurso` = turma.`nCdCurso`
       						   WHERE turma.nCdTurma = $nCdturma";
	
	$query_disciplinas = "SELECT disciplina.nCdDisciplina
        					       , disciplina.cNmDisciplina
  								FROM turma
       								 INNER JOIN `matriz_disciplina` ON matriz_disciplina.nCdMatriz = turma.nCdMatriz
       								 INNER JOIN disciplina ON disciplina.nCdDisciplina = matriz_disciplina.nCdDisciplina
 							   WHERE turma.`nCdTurma` = $nCdturma
 							   ORDER BY cNmDisciplina;";
	
	$query_notas = "SELECT gb.`nCdDisciplina`
			  		     	 , gb.`nCdDivisao`
		     			     , n.`nMedia`
		  				  FROM vw_grade_boletim gb
		       				   INNER JOIN matricula m ON m.nCdTurma   = gb.`nCdTurma`
		       				   LEFT JOIN notas n ON n.`nCdDisciplina` = gb.`nCdDisciplina`
				           						AND n.`nCdDivisao` 	  = gb.`nCdDivisao`
				           						AND n.`nCdMatricula`  = m.nCdMatricula	
   	  				     WHERE m.nCdPessoa = $nCdUsuario
		   				   AND m.`nCdTurma`= $nCdturma";
	$query_divisao = "SELECT * from turma_divisao where nCdTurma = $nCdturma ORDER BY dInicio ASC, bLctoNotas DESC;";
	$notas_registro = consulta ( "athenas", $query_notas );
	$disciplinas_registro = consulta ( "athenas", $query_disciplinas );
	$divisoes_registros = consulta ( "athenas", $query_divisao );
	$cabecalho = consulta ( "athenas", $query_cabecalho );
	$matricula = $cabecalho [0] ["nCdMatricula"];
	$query_faltas = "SELECT nCdDivisao
						 	  , nCdDisciplina
							  , COUNT(*) AS qtd
						   FROM `falta` 
						         INNER JOIN turma_divisao ON nCdTurma =  $nCdturma AND dFalta BETWEEN dInicio AND dFim
						  WHERE falta.`nCdMatricula` = $matricula
					   GROUP BY nCdDivisao
							  , nCdDisciplina";
	$faltas_registro = consulta ( "athenas", $query_faltas );
	$disciplinas = array ();
	foreach ( $disciplinas_registro as $disciplina ) {
		$disciplinas [$disciplina ["nCdDisciplina"]] = $disciplina ["cNmDisciplina"];
	}
	
	foreach ( $notas_registro as $nota ) {
		$notas [$nota ["nCdDivisao"]] [$nota ["nCdDisciplina"]] = $nota;
	}
	$divisoes_formulas = array ();
	foreach ( $divisoes as $divisao ) {
		$divisoes_formulas [$divisao ["cDivisao"]] = $divisao;
	}
	$faltas = array ();
	foreach ( $faltas_registro as $falta ) {
		$faltas [$falta ["nCdDivisao"]] [$falta ["nCdDisciplina"]] = $falta ["qtd"];
	}
	
	$html .= "<table>";
	$html .= "<thead>";
	$html .= "<tr>";
	$html .= "<td></td>";
	foreach ( $disciplinas as $disciplina ) {
		$html .= "<td colspan = '" . count ( $divisoes ) . "'>" . $disciplina ['cNmDisciplina'] . "</td>";
	}
	$html .= "</tr>";
	$html .= "<tr>";
	$html .= "<td></td>";
	foreach ( $disciplinas as $disciplina ) {
		foreach ( $divisoes as $divisao ) {
			$html .= "<td>" . $divisa ['cDivisao'] . "</td>";
		}
	}
	$html .= "</tr>";
	$html .= "</thead>";
	
	$html .= "<tbody>";
	$html .= "</tbody>";
	
	$html .= "</table>";
}
echo $html;

?>
</body>
</html>

