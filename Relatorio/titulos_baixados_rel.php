<html>
<head>
<title>Relatorio de Titulos Baixados</title>
<style type="text/css">
table {
	font-size: 10px;
}
</style>
<meta charset="utf-8">
</head>
<body>
		<?php
		ini_set ( "display_errors", 0 );
		include ("../verifica_logado.php");
		
		require ("../config.php");
		include_once "../bd.php";
		
		$data_inicio = $_REQUEST ['data_inicio'];
		$data_fim = $_REQUEST ['data_fim'];
		
		list ( $dia, $mes, $ano ) = split ( '/', $data_inicio );
		$data_inicio = "$ano-$mes-$dia";
		
		list ( $dia, $mes, $ano ) = split ( '/', $data_fim );
		$data_fim = "$ano-$mes-$dia";
		
		$query = "call Relatorio_Titulos_Baixados('$data_inicio','$data_fim')";
		
		$registros = consulta ( "athenas", $query );
		?>
		<h2>Relatorio de Titulos Baixados</h2>
	<table>
		<thead style="display: table-header-group;">
			<tr style="background-color: black; color: white;">

				<td>Tp Baixa</td>
				<td width="50px">Qtd</td>
				<td width="100px">Valor Titulos</td>
				<td width="100px">Valor Pago</td>
				<td width="100px">Tarifas</td>
				<td width="100px">Valor L&iacute;quido</td>
			</tr>
		</thead>
			<?php
			$total_qtd = 0;
			$total_pago = 0;
			$total_liquido = 0;
			$total_tarifa = 0;
			$total_titulos = 0;
			
			$color = "#f8f7f6";
			foreach ( $registros as $registro ) {
				
				if ($color == "#c6c5c4") {
					$color = "#f8f7f6";
				} else {
					$color = "#c6c5c4";
				}
				
				$total_qtd = $total_qtd + floatval ( $registro ['nQtd'] );
				$total_titulos = $total_pago + floatval ( $registro ['nVlrTitulo'] );
				$total_pago = $total_pago + floatval ( $registro ['nVlrPago'] );
				$total_liquido = $total_liquido + floatval ( $registro ['nVlrCredEf'] );
				$total_tarifa = $total_tarifa + floatval ( $registro ['nVlrTarifa'] );
				
				echo "<tr style='background-color:$color'>";
				echo "<td>" . $registro ['cTpBaixa'] . "</td>";
				echo "<td align='right'>" . str_pad ( $registro ['nQtd'], 3, "0", STR_PAD_LEFT ) . "</td>";
				echo "<td align='right'>" . number_format ( $registro ['nVlrTitulo'], 2, ",", "." ) . "</td>";
				echo "<td align='right'>" . number_format ( $registro ['nVlrPago'], 2, ",", "." ) . "</td>";
				echo "<td align='right'>" . number_format ( $registro ['nVlrTarifa'], 2, ",", "." ) . "</td>";
				echo "<td align='right'>" . number_format ( $registro ['nVlrCredEf'], 2, ",", "." ) . "</td>";
				echo "</tr>";
			}
			echo "<tr>";
			echo "<td></td>";
			echo "<td align='right'>" . str_pad ( $total_qtd, 3, "0", STR_PAD_LEFT ) . "</td>";
			echo "<td align='right'>" . number_format ( $total_titulos, 2, ",", "." ) . "</td>";
			echo "<td align='right'>" . number_format ( $total_pago, 2, ",", "." ) . "</td>";
			echo "<td align='right'>" . number_format ( $total_tarifa, 2, ",", "." ) . "</td>";
			echo "<td align='right'>" . number_format ( $total_liquido, 2, ",", "." ) . "</td>";
			echo "</tr>";
			
			?>
			
		</table>
</body>

</html>
