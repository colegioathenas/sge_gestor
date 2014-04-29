<?php
// include("../verifica_logado.php");
include ("../bd.php");
ini_set ( "display_errors", 1 );

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
	$disciplinas [$disciplina ["nCdDisciplina"]] = $disciplina ["cNmDisciplina"];
}

$html .= "<table>";

$html_opcao = "";
$nr_opcao = 0;

foreach ( $cabecalho as $aluno ) {
	
	$nr_opcao = 0;
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
		if ($notas [$divisao ["nCdDivisao"]] [$disciplina ["nCdDisciplina"]] ["nMedia"] < 5) {
			$nr_opcao ++;
			$html_opcao .= "<table><tr>
    				<td width='200px'>" . $disciplinas [$disciplina ["nCdDisciplina"]] . "</td>
    				<td><select>
    						<option value='R'>Reprovado</option>
    						<option value='C'>Aprov. Conselho</option>
    						<option value='D'>Dependencia</option>
    					</select>
    				</td>
    				</tr></table>";
		}
	}
	if ($nr_opcao > 0) {
		$html .= "<tr style='vertical-align:top;border-top-style:solid;border-top-width:1px;'>";
		$html .= "<td style='vertical-align:top'>" . $aluno ["cNome"] . "</td><td></td>";
		$html .= "<td>";
		$html .= $html_opcao;
		$html .= "</td>";
		$html .= "</tr>";
	}
}

if ($html == "<table>") {
	$html = "<tr><td>Não existem alunos para observação de Conselho Final</td></tr>";
}
$html .= "</table>";

echo $html;

?>