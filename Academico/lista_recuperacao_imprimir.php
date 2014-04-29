<html>
<head>
<meta charset="utf-8" />

<title>Lista de Recuperacao</title>
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
<body onload="window.print()">
<?php
// include("../verifica_logado.php");
ini_set ( "display_errors", 1 );
include ("../bd.php");

$nCdTurma = $_REQUEST ['turma'];
$i = 0;
$html = "";
$query_cabecalho = " SELECT cursos.`cNmCurso`
    		                  , turma.`cNmTurma`
                              , pessoa.`cNome`	
                              , matricula.nCdMatricula
                              , matricula.nChamada
        				   FROM matricula
             				    INNER JOIN pessoa ON matricula.`nCdPessoa` = pessoa.`nCdPessoa`
             					INNER JOIN turma ON turma.ncdturma =  matricula.`nCdTurma`
             					INNER JOIN `cursos` ON cursos.`nCdCurso` = turma.`nCdCurso`
       					  WHERE turma.nCdTurma = $nCdTurma 
         					    AND matricula.nCdStatus = 1 order by nChamada ";

$query_disciplinas = "SELECT disciplina.nCdDisciplina
        					       , disciplina.cNmDisciplina
        					       , disciplina.cSigla
  								FROM turma
       								 INNER JOIN `matriz_disciplina` ON matriz_disciplina.nCdMatriz = turma.nCdMatriz
       								 INNER JOIN disciplina ON disciplina.nCdDisciplina = matriz_disciplina.nCdDisciplina
 							   WHERE turma.`nCdTurma` = $nCdTurma
 							   ORDER BY cNmDisciplina;";

$query_divisao = "SELECT * from turma_divisao where nCdTurma = $nCdTurma ORDER BY dInicio ASC, bLctoNotas DESC;";
$cabecalho = consulta ( "athenas", $query_cabecalho );
$disciplinas_registro = consulta ( "athenas", $query_disciplinas );
$divisoes_registros = consulta ( "athenas", $query_divisao );

$disciplinas = array ();
foreach ( $disciplinas_registro as $disciplina ) {
	$disciplinas [$disciplina ["nCdDisciplina"]] = $disciplina ["cSigla"];
}
$divisoes_formulas = array ();

$html .= "
        <table>
        	<thead>
        		<tr >
        			<td rowspan='3'>
        				<img src='/image/logo.jpeg' ></img>
        			</td>
        			<td colspan='15' class='titulo'>LISTA DE RECUPERAÇÃO</td>
        		</tr>
        		<tr >
        			<td colspan='2' >Curso / Serie</td>
        			<td colspan='8' >" . $cabecalho [0] ["cNmCurso"] . " - " . $cabecalho [0] ["cNmTurma"] . "</td>
        		</tr>
        	</thead>
        		<tr class='header'> <td>Nome</td>";
foreach ( $disciplinas as $disc ) {
	$html .= "<td>" . $disc . "</td>";
}
$html .= "</tr>
        <tbody>";

foreach ( $divisoes as $divisao ) {
	$divisoes_formulas [$divisao ["cDivisao"]] = $divisao;
}
foreach ( $cabecalho as $aluno ) {
	$html .= "<tr>";
	$html .= "<td>" . $aluno ["cNome"] . "</td>";
	$nCdUsuario = $aluno ['nCdMatricula'];
	$query_notas = "SELECT gb.`nCdDisciplina`
			  		     	 	 , gb.`nCdDivisao`
		     			     	 , n.`nMedia`
		  				  	  FROM vw_grade_boletim gb
		       				   	   INNER JOIN matricula m ON m.nCdTurma        = gb.`nCdTurma`
		       				   	   LEFT  JOIN notas n 	  ON n.`nCdDisciplina` = gb.`nCdDisciplina`
				           					  			 AND n.`nCdDivisao`    = gb.`nCdDivisao`
				           								 AND n.`nCdMatricula`  = m.nCdMatricula	
   	  				     	  WHERE m.nCdMatricula = $nCdUsuario";
	$notas_registro = consulta ( "athenas", $query_notas );
	foreach ( $notas_registro as $nota ) {
		$notas [$nota ["nCdDivisao"]] [$nota ["nCdDisciplina"]] = $nota;
	}
	foreach ( $disciplinas_registro as $disciplina ) {
		
		foreach ( $divisoes_registros as $divisao ) {
			if ($divisao ["bLctoNotas"] == "1") {
				$media = $notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"];
				if ($media != "") {
					$frac_media = $media - intval ( $media );
					if (($frac_media >= 0) && ($frac_media <= 0.24)) {
						$media = intval ( $media );
					} else {
						if (($frac_media >= 0.25) && ($frac_media <= 0.74)) {
							$media = intval ( $media ) + 0.5;
						} else {
							$media = intval ( $media ) + 1;
						}
					}
					$notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"] = $media;
				}
			} else {
				$formula = $divisao ["cFormula"];
				
				foreach ( $divisoes_registros as $divformula ) {
					$search = "[" . $divformula ["cDivisao"] . "]";
					$replace = $notas [$divformula ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"];
					$replace = $replace == "" ? 0 : $replace;
					$formula = str_replace ( $search, $replace, $formula );
				}
				
				$formula = str_replace ( "MAIOR", "max", $formula );
				$media = 0;
				eval ( "\$media = $formula;" );
				$frac_media = $media - intval ( $media );
				if (($frac_media >= 0) && ($frac_media <= 0.24)) {
					$media = intval ( $media );
				} else {
					if (($frac_media >= 0.25) && ($frac_media <= 0.74)) {
						$media = intval ( $media ) + 0.5;
					} else {
						$media = intval ( $media ) + 1;
					}
				}
				$notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"] = $media;
			}
		}
		if ($notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"] >= 7) {
			$html .= "<td></td>";
		} else {
			$html .= "<td><center>X</center></td>";
		}
	}
	$html .= "</tr>";
}
$html .= "</tbody>
</table>
<br/><br/><br/><br/><br/><br/>";

echo $html;

?>
</body>
</html>