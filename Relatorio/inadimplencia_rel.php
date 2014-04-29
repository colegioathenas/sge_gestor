<html>
<head>
<title>Relatorio de Inadimplencia</title>
<style type="text/css">
table {
	font-size: 10px;
}
</style>
</head>
<body>
		<?php
		ini_set ( "display_errors", 0 );
		include ("../verifica_logado.php");
		
		require ("../config.php");
		include_once "../bd.php";
		
		$data_inicio = $_REQUEST ['data_inicio'];
		$data_fim = $_REQUEST ['data_fim'];
		$tipo = $_REQUEST ['tpRelatorio'];
		
		list ( $dia, $mes, $ano ) = split ( '/', $data_inicio );
		$data_inicio = "$ano-$mes-$dia";
		
		list ( $dia, $mes, $ano ) = split ( '/', $data_fim );
		$data_fim = "$ano-$mes-$dia";
		
		if ($tipo == 'A') {
			$query = "call Relatorio_Inadimplencia_Analitico('$data_inicio','$data_fim')";
		} else {
			$query = "call Relatorio_Inadimplencia_Sintetico('$data_inicio','$data_fim')";
		}
		
		$registros = consulta ( "athenas", $query );
		?>
		<table>
		<thead style="display: table-header-group;">
			<tr style="background-color: black; color: white;">
					<?php
					if ($tipo == 'A') {
						echo "<td>CPF</td>
						<td>Nome</td>
						<td>Nosso Numero</td>
						<td>Seu Numero</td>
						<td>Vencimento</td>
						<td>Emissao</td>
						<td>Valor</td>";
					} else {
						echo "<td>CPF</td>
						<td>Nome</td>
						<td>Qtd</td>
						<td>Menor Vcto</td>
						<td>Maior Vcto</td>
						<td>Valor</td>";
					}
					?>
				</tr>
		</thead>
			<?php
			$total = 0;
			$nome_anterior = "";
			$color = "#f8f7f6";
			foreach ( $registros as $registro ) {
				if ($nome_anterior != $registro ['cNome']) {
					if ($color == "#c6c5c4") {
						$color = "#f8f7f6";
					} else {
						$color = "#c6c5c4";
					}
					$nome_anterior = $registro ['cNome'];
				}
				$total = $total + floatval ( $registro ['nVlrTitulo'] );
				
				echo "<tr style='background-color:$color'>";
				echo "<td>" . $registro ['nCdPessoa'] . "</td>";
				echo "<td>" . $registro ['cNome'] . "</td>";
				if ($tipo == 'A') {
					
					echo "<td>" . $registro ['nNossoNumero'] . "</td>";
					echo "<td>" . $registro ['SeuNum'] . "</td>";
					echo "<td>" . date ( "d/m/Y", strtotime ( $registro ['dVcto'] ) ) . "</td>";
					echo "<td>" . date ( "d/m/Y", strtotime ( $registro ['dEmissao'] ) ) . "</td>";
				} else {
					echo "<td>" . $registro ['nQtdTitulo'] . "</td>";
					echo "<td>" . date ( "d/m/Y", strtotime ( $registro ['dMenorVcto'] ) ) . "</td>";
					echo "<td>" . date ( "d/m/Y", strtotime ( $registro ['dMaiorVcto'] ) ) . "</td>";
				}
				echo "<td align='right'>" . number_format ( $registro ['nVlrTitulo'], 2, ",", "." ) . "</td>";
				echo "</tr>";
			}
			echo "<tr>";
			if ($tipo == 'A') {
				echo "<td></td>";
			}
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td align='right'>" . number_format ( $total, 2, ",", "." ) . "</td>";
			echo "</tr>";
			
			?>
			
		</table>
</body>

</html>
