<html>
<head>
<meta charset="utf-8" />

<title>Boletos</title>
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
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
include ("../bd.php");

$matriculas = substr ( $_REQUEST ['matriculas'], 0, strlen ( $_REQUEST ['matriculas'] ) - 1 );

$query = "select * from matricula where nCdMatricula in ($matriculas) order by nChamada ";
$registros = consulta ( "athenas", $query );
$i = 0;
$html = "";
foreach ( $registros as $registro ) {
	$status = "APROVADO";
	$nCdUsuario = $registro ["nCdPessoa"];
	$nCdturma = $registro ["nCdTurma"];
	$query_cabecalho = " SELECT cursos.`cNmCurso`
    		                      , turma.`cNmTurma`
                                  , pessoa.`cNome`	
                                  , matricula.nCdMatricula
                                  , matricula.nChamada
        						FROM matricula
             						 INNER JOIN pessoa ON matricula.`nCdPessoa` = pessoa.`nCdPessoa`
             						 INNER JOIN turma ON turma.ncdturma =  matricula.`nCdTurma`
             						 INNER JOIN `cursos` ON cursos.`nCdCurso` = turma.`nCdCurso`
       						   WHERE turma.nCdTurma = $nCdturma 
         						 AND matricula.nCdPEssoa = $nCdUsuario";
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
	$html .= "
		        <table>
		            <thead>
		                <tr >
		                    <td rowspan='3'>
		                        <img src='/image/logo.jpeg' ></img>
		                    </td>
		                    <td colspan='15' class='titulo'>BOLETIM ESCOLAR</td>
		                </tr>
		                <tr >
		                    <td colspan='2' >Nome</td>
		                    <td colspan='8' >" . $cabecalho [0] ["cNome"] . "</td>
				    <td colspan='2' >Numero</td>
				    <td colspan='2' >" . $cabecalho [0] ["nChamada"] . "</td>
		                </tr>
		                
		                <tr >
		                    <td colspan='2' >Curso / Serie</td>
		                    <td colspan='8' >" . $cabecalho [0] ["cNmCurso"] . "</td>
		                    <td colspan='2'>Turma</td>
		                    <td colspan='2' >" . $cabecalho [0] ["cNmTurma"] . "</td>
		                </tr>
		                </thead>
		                <tr class='header'>
		                    <td rowspan='3' class='Disciplina' >Componente Curricular</td>
		                    <td colspan='7'>1º SEMESTRE</td>
		                    <td colspan='7'>2º SEMESTRE</td>
		                    <td rowspan='3' class='media'>Média Final</td>
		                    <td rowspan='3' class='media'>Total de Faltas</td>
		                    <td rowspan='3'> Resultado </td>
		                </tr>
		                <tr class='header'>
		                    <td colspan='2'>1º BIM.</td>
		                    <td colspan='2'>2º BIM.</td>
		                    <td rowspan='2' class='media'>1º <br/> REC</td>
		                    <td colspan='2' >Resultado Semestre</td>                    
		                    <td colspan='2'>3º BIM.</td>
		                    <td colspan='2'>4º BIM.</td>
		                    <td rowspan='2' class='media'>2º<br/>REC</td>
		                     <td colspan='2' >Resultado Semestre</td> 
		                    
		                </tr>
		                <tr class='header'>
		                    <td class='nota'>Média</td>
		                    <td class='falta'>Falta</td>
		                    <td class='nota'>Média</td>
		                    <td  class='falta'>Falta</td>
		                    <td class='nota'>Média</td>
		                    <td  class='falta'>Falta</td>
		                    <td class='nota'>Média</td>
		                    <td  class='falta'>Falta</td>
		                    <td class='nota'>Média</td>
		                    <td  class='falta'>Falta</td>
		                     <td class='nota'>Média</td>
		                    <td  class='falta'>Falta</td>
		                </tr>
		            
		            <tbody>";
	$array_total_faltas = array ();
	foreach ( $disciplinas_registro as $disciplina ) {
		$html .= "<tr>";
		$html .= "<td>" . $disciplina ["cNmDisciplina"] . "</td>";
		$nrDivisao = 0;
		$nrDivisaoMax = count ( $divisoes_registros );
		foreach ( $divisoes_registros as $divisao ) {
			$nrDivisao ++;
			$html .= "<td class='nota'>";
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
				$html .= $media != "" ? number_format ( $notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"], 1, ".", "" ) : "";
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
				if ($nrDivisaoMax == $nrDivisao) {
					$resultado_final = "<td>Aprovado</td>";
					if ($media < 5) {
						
						$query = "select * from conselho_final where nCdMatricula = $matricula and nCdDisciplina = " . $disciplina ["nCdDisciplina"];
						$resultado_consulta = consulta ( "athenas", $query );
						if ($resultado_consulta [0] ["cConceito"] == "C") {
							$media = "5.00";
							$resultado_final = "<td><b>Ap. Conselho</b></td>";
							if ($status == "APROVADO") {
								$status = "<b>APROVADO PELO CONSELHO</b>";
							}
						} else {
							if ($resultado_consulta [0] ["cConceito"] == "D") {
								$resultado_final = "<td><b>Dependencia</b></td>";
								if (($status == "APROVADO") || ($status == "<b>APROVADO PELO CONSELHO<b>")) {
									$status = "<b>APROVADO PARCIALMENTE</b>";
								}
							} else {
								$resultado_final = "<td><b>Reprovado</b></td>";
								$status = "<b>NÃO APROVADO</b>";
							}
						}
					}
				}
				$html .= $media != "" ? number_format ( $media, 2, ".", "" ) : "";
			}
			$html .= "</td>";
			if ($divisao ["bImprimeFalta"] == "1") {
				if ($divisao ["bLctoFreq"] == "1") {
					$nrFaltas = $faltas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]];
					$array_total_faltas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] = $array_total_faltas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] + $nrFaltas;
					$html .= "<td class='falta'>";
					$html .= $nrFaltas == "" ? "" : str_pad ( $nrFaltas, 2, "0", STR_PAD_LEFT );
					$html .= "</td>";
				} else {
					$formula = $divisao ["cFormulaFalta"];
					foreach ( $divisoes_registros as $divformula ) {
						$search = "[" . $divformula ["cDivisao"] . "]";
						$replace = $faltas [$divformula ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]];
						$replace = $replace == "" ? 0 : $replace;
						$formula = str_replace ( $search, $replace, $formula );
					}
					$nrFaltas = 0;
					eval ( "\$nrFaltas = $formula;" );
					$html .= "<td class='falta'>";
					$html .= $nrFaltas == "" ? "" : str_pad ( $nrFaltas, 2, "0", STR_PAD_LEFT );
					$html .= "</td>";
				}
			}
		}
		$html .= $resultado_final;
		$html .= "</tr>";
	}
	$html .= "</tbody>
        	</table>
        	</br>
        	Status: $status
        <br/><br/><br/><br/><br/><br/>";
	
	if ($i % 2 == 0) {
		$html .= "<p class='quebra'></p>";
	}
	$i ++;
}
echo $html;

?>
</body>
</html>

