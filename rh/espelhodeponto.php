<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

ini_set ( "display_errors", 0 );

$cpf = $cpf == "" ? $_REQUEST ['codigo'] : $cpf;
$dInicio = $_REQUEST ['inicio'];
$dFim = $_REQUEST ['fim'];

$dInicioTime = mktime ( 0, 0, 0, substr ( $dInicio, 3, 2 ), substr ( $dInicio, 0, 2 ), substr ( $dInicio, 6, 4 ) );
$dFimTime = mktime ( 0, 0, 0, substr ( $dFim, 3, 2 ), substr ( $dFim, 0, 2 ), substr ( $dFim, 6, 4 ) );

$query_ch = "select distinct horario.* 
  from funcionario 
       inner join escala on escala.nCdEscala = funcionario.nCdEscala 
       inner join horario on (     horario.nCdHorario = escala.nCdHorarioSeg
                               or horario.nCdHorario = escala.nCdHorarioTer
                               or horario.nCdHorario = escala.nCdHorarioQua
                               or horario.nCdHorario = escala.nCdHorarioQui
                               or horario.nCdHorario = escala.nCdHorarioSex
                               or horario.nCdHorario = escala.nCdHorarioSab
                               or horario.nCdHorario = escala.nCdHorarioDom
                               )
        
 where nCdPessoa = $cpf";

$registros_ch = consulta ( "athenas", $query_ch );

$query_marcacoes = "select * from marcacao 
                         where nCdFuncionario = $cpf 
                          and dMarcacao between '" . date ( "Y-m-d", $dInicioTime ) . "' and '" . date ( "Y-m-d", $dFimTime ) . "'";
$registros_marc = consulta ( "athenas", $query_marcacoes );

$query_funcionario = "select funcionario.*
                               ,nCdHorarioDom
                               ,nCdHorarioSeg
                               ,nCdHorarioTer
                               ,nCdHorarioQua
                               ,nCdHorarioQui
                               ,nCdHorarioSex
                               ,nCdHorarioSab
                               , cNome
                               , empresa.cRazaoSocial
                               , empresa.cEndereco 
                               , empresa.cBairro
                               , empresa.cCidade
                               , empresa.cUF
                               from funcionario left join escala on escala.nCdEscala = funcionario.nCdEscala 
                               inner join pessoa on pessoa.nCdPessoa = funcionario.nCdPessoa
                               inner join empresa on empresa.nCNPJ = funcionario.nCdEmpresa
                               where funcionario.nCdPessoa = $cpf";
$registro_func = consulta ( "athenas", $query_funcionario );

$query_motivos = "select * from ocorrencia";
$resultado_motivos = consulta ( "athenas", $query_motivos );
$motivos = array ();

foreach ( $resultado_motivos as $motivo ) {
	$motivos [$motivo ["nCdOcorrencia"]] = $motivo ["cNmOcorrencia"];
}

foreach ( $registros_marc as $marc ) {
	
	$marc_func [date ( "dm", strtotime ( $marc ["dMarcacao"] ) )] = $marc;
}
$chs = array ();
foreach ( $registros_ch as $ch ) {
	$chs [$ch ['nCdHorario']] = $ch;
}

?>

<style>
body {
	font-size: x-small;
}

.tabela {
	border-collapse: collapse;
	font-size: xx-small;
}

.tabela thead {
	background-color: #ccc;
}

.tabela td {
	text-align: center;
}

.tabela td {
	border-width: 1px;
	border-style: solid;
}

p.quebra {
	page-break-before: always;
}
</style>

<table style="font-size: small">
	<tr>
		<td><b>Empregador</b></td>
		<td><?php echo $registro_func[0]['cRazaoSocial']; ?></td>
	</tr>
	<tr>
		<td><b>Endereco</b></td>
		<td><?php echo $registro_func[0]['cEndereco']." - ".$registro_func[0]['cBairro']." - ".$registro_func[0]['cCidade']." / ".$registro_func[0]['cUF']; ?></td>
	</tr>
	<tr>
		<td><b>Empregado</b></td>
		<td><?php echo $registro_func[0]['cNome']; ?></td>
	</tr>
	<tr>
		<td><b>Admissao</b></td>
		<td></td>
	</tr>

</table>
<span style="font-size: x-small"><b>Geracao Relatorio </b><?php echo date("d/m/Y H:i"); ?></span>
<br />
<br />
<span style="font-weight: bold; font-size: small">Horarios contratuais
	do empregado</span>
<br />
<table class="tabela">
	<thead>
		<tr>
			<td colspan="2">Codigo de Horario(CH)</td>
			<td rowspan="2" width="70px">Entrada</td>
			<td rowspan="2" width="70px">Saida</td>
			<td rowspan="2" width="70px">Entrada</td>
			<td rowspan="2" width="70px">Saida</td>
		</tr>
		<tr>
			<td>Codigo</td>
			<td>Descricao</td>
		</tr>
	</thead>
        <?php
								
								foreach ( $chs as $ch ) {
									$entrada1 = $ch ["tEntrada1"] == "" ? "" : date ( "H:i", strtotime ( $ch ["tEntrada1"] ) );
									$saida1 = $ch ["tSaida1"] == "" ? "" : date ( "H:i", strtotime ( $ch ["tSaida1"] ) );
									$entrada2 = $ch ["tEntrada2"] == "" ? "" : date ( "H:i", strtotime ( $ch ["tEntrada2"] ) );
									$saida2 = $ch ["tSaida2"] == "" ? "" : date ( "H:i", strtotime ( $ch ["tSaida2"] ) );
									
									echo "<tr>
                        <td>" . str_pad ( $ch ["nCdHorario"], 2, '0', STR_PAD_LEFT ) . "</td>
                        <td>" . $ch ["cNmHorario"] . "</td>
                        <td>$entrada1</td>
                        <td>$saida1</td>
                        <td>$entrada2</td>
                        <td>$saida2</td>
                      </tr>";
								}
								?>
</table>
<br />
<span style="font-size: small"><b>Periodo</b>: <?php echo "$dInicio - $dFim"; ?></span>
<br />
<table class="tabela">
	<thead>
		<tr>
			<td rowspan="2">Dia</td>
			<td rowspan="2" colspan="6">Marcacoes Registradas <br /> no ponto
				eletronico
			</td>
			<td colspan="6">Jornada Realizada</td>
			<td rowspan="2" width="20px">CH</td>
			<td colspan="3">Tratamentos efetuados sobre os dados originais</td>
		</tr>
		<tr>
			<td width="40px">Entrada</td>
			<td width="40px">Saida</td>
			<td width="40px">Entrada</td>
			<td width="40px">Saida</td>
			<td width="40px">Entrada</td>
			<td width="40px">Saida</td>
			<td width="40px">Horario</td>
			<td width="30px">Ocor.</td>
			<td>Motivo</td>
		</tr>
	</thead>
	<tbody>
<?php

$data = $dInicioTime;
while ( $data <= $dFimTime ) {
	$marc_orig1 = "";
	$marc_orig2 = "";
	$marc_orig3 = "";
	$marc_orig4 = "";
	$marc_orig5 = "";
	$marc_orig6 = "";
	
	$entrada1 = "";
	$entrada2 = "";
	$entrada3 = "";
	
	$saida1 = "";
	$saida2 = "";
	$saida3 = "";
	
	$numero_ocorrencias = 0;
	
	$ocorrencias = array ();
	
	// echo date("dm",$data)."<br/>";
	if (array_key_exists ( date ( "dm", $data ), $marc_func )) {
		$marc_orig1 = $marc_func [date ( "dm", $data )] ["hMarcacao1"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao1"] ) );
		$marc_orig2 = $marc_func [date ( "dm", $data )] ["hMarcacao2"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao2"] ) );
		$marc_orig3 = $marc_func [date ( "dm", $data )] ["hMarcacao3"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao3"] ) );
		$marc_orig4 = $marc_func [date ( "dm", $data )] ["hMarcacao4"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao4"] ) );
		$marc_orig5 = $marc_func [date ( "dm", $data )] ["hMarcacao5"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao5"] ) );
		$marc_orig6 = $marc_func [date ( "dm", $data )] ["hMarcacao6"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["hMarcacao6"] ) );
		
		$entrada1 = $marc_func [date ( "dm", $data )] ["dEntrada1"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada1"] ) );
		$entrada2 = $marc_func [date ( "dm", $data )] ["dEntrada2"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada2"] ) );
		$entrada3 = $marc_func [date ( "dm", $data )] ["dEntrada3"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dEntrada3"] ) );
		
		$saida1 = $marc_func [date ( "dm", $data )] ["dSaida1"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida1"] ) );
		$saida2 = $marc_func [date ( "dm", $data )] ["dSaida2"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida2"] ) );
		$saida3 = $marc_func [date ( "dm", $data )] ["dSaida3"] == "" ? "" : date ( "H:i", strtotime ( $marc_func [date ( "dm", $data )] ["dSaida3"] ) );
		
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoE1"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dEntrada1"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaE1"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoE2"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dEntrada2"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaE2"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoE3"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dEntrada3"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaE3"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoS1"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dSaida1"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaS1"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoS2"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dSaida2"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaS2"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoS3"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["dSaida3"],
					"ocorrencia" => "I",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrenciaS3"] 
			);
		}
		
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao1"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao1"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia1"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao2"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao2"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia2"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao3"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao3"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia3"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao4"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao4"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia4"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao5"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao5"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia5"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacaoE6"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao6"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia6"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao7"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao7"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia7"] 
			);
		}
		if ($marc_func [date ( "dm", $data )] ["nCdTpMarcacao8"] > 1) {
			$numero_ocorrencias ++;
			$ocorrencias [] = array (
					"horario" => $marc_func [date ( "dm", $data )] ["hMarcacao8"],
					"ocorrencia" => "D",
					"motivo" => $marc_func [date ( "dm", $data )] ["nCdOcorrencia8"] 
			);
		}
	}
	$chCod = 0;
	switch (date ( "N", $data )) {
		case 1 :
			$chCod = $registro_func [0] ["nCdHorarioSeg"];
			break;
		case 2 :
			$chCod = $registro_func [0] ["nCdHorarioTer"];
			break;
		case 3 :
			$chCod = $registro_func [0] ["nCdHorarioQua"];
			break;
		case 4 :
			$chCod = $registro_func [0] ["nCdHorarioQui"];
			break;
		case 5 :
			$chCod = $registro_func [0] ["nCdHorarioSex"];
			break;
		case 6 :
			$chCod = $registro_func [0] ["nCdHorarioSab"];
			break;
		case 7 :
			$chCod = $registro_func [0] ["nCdHorarioDom"];
			break;
	}
	
	echo "<tr>";
	echo "<td rowspan='$numero_ocorrencias'>" . date ( "d", $data ) . "</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig1</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig2</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig3</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig4</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig5</td>";
	echo "<td rowspan='$numero_ocorrencias' width='28px'>$marc_orig6</td>";
	echo "<td rowspan='$numero_ocorrencias'>$entrada1</td>";
	echo "<td rowspan='$numero_ocorrencias'>$saida1</td>";
	echo "<td rowspan='$numero_ocorrencias'>$entrada2</td>";
	echo "<td rowspan='$numero_ocorrencias'>$saida2</td>";
	echo "<td rowspan='$numero_ocorrencias'>$entrada3</td>";
	echo "<td rowspan='$numero_ocorrencias'>$saida3</td>";
	echo "<td rowspan='$numero_ocorrencias'>" . str_pad ( $chCod, 2, '0', STR_PAD_LEFT ) . "</td>";
	if (count ( $ocorrencias ) == 0) {
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
	} else {
		$i = 0;
		foreach ( $ocorrencias as $ocorrencia ) {
			$i ++;
			if ($i > 1) {
				echo "<tr>";
			}
			echo "<td>" . date ( "H:i", strtotime ( $ocorrencia ["horario"] ) ) . "</td>";
			echo "<td>" . $ocorrencia ["ocorrencia"] . "</td>";
			echo "<td>" . $motivos [$ocorrencia ["motivo"]] . "</td>";
			
			echo "</tr>";
		}
	}
	echo "\n";
	echo "<pre>";
	// print_r($marc_func);
	echo "</pre>";
	
	$data = strtotime ( "+1 day", $data );
}
?>
        </tbody>
</table>

<p class="quebra" />