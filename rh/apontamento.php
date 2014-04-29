<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

ini_set ( "display_errors", 1 );

$cpf = $cpf == "" ? $_REQUEST ['codigo'] : $cpf;
$dInicio = "25/03/2013";
$dFim = "25/04/2013";

$query = "select * from marcacao where nCdFuncionario = $cpf";

$registros = consulta ( "athenas", $query );
$marc_func = array ();
foreach ( $registros as $marc ) {
	
	$marc_func [date ( "dm", strtotime ( $marc ["dMarcacao"] ) )] = $marc;
}

$query_ocorrencia = "select  * from ocorrencia";
$resultado_ocorrencia = consulta ( "athenas", $query_ocorrencia );
$ocorrencias = array ();
foreach ( $resultado_ocorrencia as $ocr ) {
	$ocorrencias [$ocr ['nCdOcorrencia']] = $ocr ["cNmOcorrencia"];
}
?>

<table id="tbApontamento" class="tbGrid"
	style="font-size: small; border-style: solid; border-width: 1px;">
	<thead>
		<tr style="text-align: center">
			<td rowspan="2" width="50px">Dia</td>
			<td colspan="3">Entrada1</td>
			<td colspan="3">Saida1</td>
			<td colspan="3">Entrada2</td>
			<td colspan="3">Saida2</td>
			<td colspan="3">Entrada3</td>
			<td colspan="3">Saida3</td>
			<!--
            <td colspan="3">Entrada4</td>
            <td colspan="3">Saida4</td>
            -->
			<td rowspan="2">Observacao</td>
		</tr>
		<tr>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>
			<td width="50px">Horario</td>
			<td width="35px">Tipo</td>
			<td width="70px">Ocorrencia</td>


		</tr>
	</thead>
   
            <?php
												
												$dInicio = mktime ( 0, 0, 0, substr ( $dInicio, 3, 2 ), substr ( $dInicio, 0, 2 ), substr ( $dInicio, 6, 4 ) );
												$dFim = mktime ( 0, 0, 0, substr ( $dFim, 3, 2 ), substr ( $dFim, 0, 2 ), substr ( $dFim, 6, 4 ) );
												$data = $dInicio;
												while ( $data <= $dFim ) {
													
													$entrada1 = "";
													$entrada2 = "";
													$entrada3 = "";
													
													$saida1 = "";
													$saida2 = "";
													$saida3 = "";
													
													$cod_marcacao = 0;
													
													// echo date("dm",$data)."<br/>";
													if (array_key_exists ( date ( "dm", $data ), $marc_func )) {
														
														$entrada1 = $marc_func [date ( "dm", $data )] ["dEntrada1"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada1"] ) );
														$entrada2 = $marc_func [date ( "dm", $data )] ["dEntrada2"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada2"] ) );
														$entrada3 = $marc_func [date ( "dm", $data )] ["dEntrada3"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada3"] ) );
														
														$saida1 = $marc_func [date ( "dm", $data )] ["dSaida1"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida1"] ) );
														$saida2 = $marc_func [date ( "dm", $data )] ["dSaida2"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida2"] ) );
														$saida3 = $marc_func [date ( "dm", $data )] ["dSaida3"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida3"] ) );
														
														$ocorrenciaE1 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE1"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE1"]];
														$ocorrenciaE2 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE2"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE2"]];
														$ocorrenciaE3 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE3"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaE3"]];
														
														$ocorrenciaS1 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS1"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS1"]];
														$ocorrenciaS2 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS2"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS2"]];
														$ocorrenciaS3 = $marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS3"] == "" ? "" : $ocorrencias [$marc_func [date ( "dm", $data )] ["nCdTpOcorrenciaS3"]];
														
														$cod_marcacao = $marc_func [date ( "dm", $data )] ["nCdMarcacao"];
													}
													
													$data_marcacao = date ( "Y-m-d", $data );
													
													echo "<tr>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">" . date ( "d/m", $data ) . "</td>
                              <td name='es' valor='E1' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$entrada1'>$entrada1</td>
                              <td style=\"text-align:center\">$te1</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaE1</td>
                              
                              <td name='es' valor='S1' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$saida1'>$saida1</td>
                              <td style=\"text-align:center\">$ts1</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaS1</td>
                              
                              <td name='es' valor='E2' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$entrada2'>$entrada2</td>
                              <td style=\"text-align:center\">$te2</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaE2</td>
                              
                              <td name='es' valor='S2' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$saida2'>$saida2</td>
                              <td style=\"text-align:center\">$ts2</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaS2</td>
                              
                              <td name='es' valor='E3' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$entrada3'>$entrada3</td>
                              <td style=\"text-align:center\">$te3</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaE3</td>
                              
                              <td name='es' valor='S3' marcacao='" . $cod_marcacao . "' data='$data_marcacao' horario='$saida3'>$saida3</td>
                              <td style=\"text-align:center\">$ts3</td>
                              <td style=\"border-right-style:solid; border-right-width: 1px;\">$ocorrenciaS3</td>
                              
                               <td style=\"border-right-style:solid; border-right-width: 1px;\"></td>
                            
                        </tr>
                            
                            ";
													$data = strtotime ( "+1 day", $data );
												}
												?>
                    
</table>