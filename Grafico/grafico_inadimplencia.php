<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

require ("../config.php");
include_once "../bd.php";

$ano = $_REQUEST ['ano'];
$query = "call Grafico_inadimplencia_ano($ano)";
$registros = consulta ( "athenas", $query );
echo "<pre>";
print_r ( $registros );
echo "</pre>";
?>
<html>
<head>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
           ['Mes', 'Inadimplencia', 'Titulos em Aberto', 'Titulos em Aberto Acumulado']
          <?php
										$acumulado = 0;
										foreach ( $registros as $registro ) {
											$mes = $registro ['mes'];
											$inadimplencia = $registro ['nVlrInadimplencia'];
											$emaberto = $registro ['nVlrInadimplenciaAbt'];
											$acumulado = $acumulado + $registro ['nVlrInadimplenciaAbt'];
											
											$inadimplencia = number_format ( $inadimplencia, 2, ".", "" );
											$emaberto = number_format ( $emaberto, 2, ".", "" );
											$acumulado = number_format ( $acumulado, 2, ".", "" );
											
											echo ",['$mes', $inadimplencia,  $emaberto,$acumulado] \r\n";
										}
										?>
        ]);

            var data2 = google.visualization.arrayToDataTable([
              ['Mes', 'Titulos', 'Inadimplencia', 'Liquidados', 'Descontos e Tarifas', 'Baixados','Aberto']
              <?php
														$valor = 0;
														foreach ( $registros as $registro ) {
															$mes = $registro ['mes'];
															$titulos = $registro ['nVlrTitulos'];
															$inadimplencia = $registro ['nVlrInadimplencia'];
															$liquidados = $registro ['nVlrLiquidado'];
															$descontos = $registro ['nVlrDescTar'];
															$baixados = $registro ['nVlrBaixado'];
															$emaberto = $registro ['nVlrInadimplenciaAbt'];
															
															$inadimplencia = number_format ( $inadimplencia, 2, ".", "" );
															$liquidados = number_format ( $liquidados, 2, ".", "" );
															$descontos = number_format ( $descontos, 2, ".", "" );
															$baixados = number_format ( $baixados, 2, ".", "" );
															$emaberto = number_format ( $emaberto, 2, ".", "" );
															
															echo ",['$mes', $titulos, $inadimplencia, $liquidados,$descontos, $baixados,$emaberto]\r\n";
														}
														?>
            ]);

        var options = {
          title: 'Inadimplencia'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
        chart2.draw(data2, options);
      }
    </script>
</head>
<body>
	<div id="chart_div" style="width: 900px; height: 500px;"></div>
	<div id="chart_div2" style="width: 900px; height: 500px;"></div>
</body>
</html>
