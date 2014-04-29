<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

require ("../config.php");
include_once "../bd.php";

$ano = $_REQUEST ['ano'];
$query = "call Grafico_inadimplencia_ano($ano)";
$registros = consulta ( "athenas", $query );

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
											$acumulado .= $registro ['nVlrInadimplenciaAbt'];
											echo ",['$mes', $titulos, $inadimplencia, $emaberto, $acumulado]";
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
															echo ",['$mes', $titulos, $inadimplencia, $liquidados,$descontos, $baixados,$emaberto]";
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