<?php
ini_set ( "display_errors", 1 );

?>
<html>
<head>
<style>
body {
	font-family: Verdana;
	font-size: 10px;
}

.titulo {
	font-size: 14px;
	font-weight: bold;
}

table {
	border-collapse: collapse;
	border-style: solid;
	border-width: 0.5px;
	font-size: 10px;
}

table td {
	border-style: solid;
	border-width: 0.5px;
}

thead tr,tfoot tr {
	background-color: #DDDDDD;
}

#destino tr td:nth-child(1) {
	width: 200px;
}

#destino tr td:nth-child(2) {
	width: 100px;
	text-align: center;
}

#destino tr td:nth-child(3) {
	width: 100px;
	text-align: center;
}

#destino tr td:nth-child(4) {
	width: 100px;
	text-align: center;
}

#ambulatorio tr td:nth-child(1) {
	width: 200px;
}

#ambulatorio tr td:nth-child(2) {
	width: 100px;
	text-align: center;
}

#ambulatorio tr td:nth-child(3) {
	width: 100px;
	text-align: center;
}

#ambulatorio tr td:nth-child(4) {
	width: 100px;
	text-align: center;
}

#hospital tr td:nth-child(1) {
	width: 400px;
}

#hospital tr td:nth-child(2) {
	width: 100px;
	text-align: center;
}

#hospital tr td:nth-child(3) {
	width: 100px;
	text-align: center;
}

#hospital tr td:nth-child(4) {
	width: 100px;
	text-align: center;
}

#horario tr td:nth-child(1) {
	width: 200px;
}

#horario tr td:nth-child(2) {
	width: 100px;
	text-align: center;
}

#horario tr td:nth-child(3) {
	width: 100px;
	text-align: center;
}

#horario tr td:nth-child(4) {
	width: 100px;
	text-align: center;
}

.cabecalho {
	width: 600px;
}

.cabecalho,.cabecalho td {
	border-style: none;
}
</style>
</head>
<body>
	<div align="center" style="width: 600px">
		<table class="cabecalho">
			<tr>
				<td width=110px><img src="../image/logo_relatorio.png" width=80px /></td>
				<td align='center'><span class='title'>PREFEITURA MUNICIPAL DE SANTA
						ISABEL</span> <br /> <span class='subtitle'>Setor de Ambulancia</span>
					<br /> <span class='fone'>Fone: 4652-4240 / 2657-2542</span></td>
			</tr>
		</table>

		<span class="titulo">Agendamento de Transporte</span> <br />
		<br />


		<table id="destino">
			<thead>
				<tr>
					<td>Destino</td>
					<td>Passageiros</td>
					<td>Pacientes</td>
					<td>Acompanhantes</td>

				</tr>
			</thead>
			<tbody>

			</tbody>
			<tfoot>
				<tr>
					<td>Total</td>

				</tr>
			</tfoot>
		</table>
		<br />
		<br /> <span class="titulo">Ambulatorios x Passageiros Transportados</span>

		<table id="ambulatorio">
			<thead>
				<tr>
					<td>Ambulatorio</td>
					<td>Passageiros</td>
					<td>Pacientes</td>
					<td>Acompanhantes</td>

				</tr>
			</thead>
			<tbody>

			</tbody>
			<tfoot>
				<tr>
					<td>Total</td>
				<?php
				echo "<td>$total_passageiros</td>
						  <td>$total_pacientes</td>
						  <td>$total_acompanhantes</td>";
				?>
			</tr>
			</tfoot>
		</table>
		<br />
		<br /> <span class="titulo">Hospital x Passageiros Transportados</span>

		<table id="hospital">
			<thead>
				<tr>
					<td>Hospital</td>
					<td>Passageiros</td>
					<td>Pacientes</td>
					<td>Acompanhantes</td>

				</tr>
			</thead>
			<tbody>

			</tbody>
			<tfoot>
				<tr>
					<td>Total</td>

				</tr>
			</tfoot>
		</table>
		<br />
		<br /> <span class="titulo">Hor&aacute;rio da Consulta x Passageiros
			Transportados</span>

		<table id="horario">
			<thead>
				<tr>
					<td>Faixa de Hor&aacute;rio</td>
					<td>Passageiros</td>
					<td>Pacientes</td>
					<td>Acompanhantes</td>

				</tr>
			</thead>
			<tbody>

			</tbody>
			<tfoot>
				<tr>
					<td>Total</td>

				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>