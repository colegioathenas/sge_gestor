<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
?>
<div>
	<table border="1">
		<thead>
			<tr>
				<td width='150px'>Data</td>
				<td width='810px'>Conteudo</td>
			</tr>
		</thead>
	</table>
</div>

<div style="height: 330px; overflow: scroll;">
	<table border="1">
<?php
$ano = substr ( $_REQUEST ['mes_ano'], 0, 4 );
$mes = substr ( $_REQUEST ['mes_ano'], - 2 );

$usuario = $_SESSION ['nCdUsuario'];
$turma = $_REQUEST ['turma'];
$disciplina = $_REQUEST ['disciplina'];

$query = "select nCdCalendario, day(dCalendario) as dia, cConteudo
				  	  from calendario 
				 	       inner join usuario on calendario.nCdProfessor = usuario.nCPF
				      where usuario.nCdUsuario = $usuario
				        and nCdTurma = $turma
				        and nCdDisciplina = $disciplina
				        order by dCalendario;
		  		";
$resultado = consulta ( "athenas", $query );
$x = 0;

foreach ( $resultado as $registro ) {
	$d = $registro ['dia'];
	$codigo = $registro ['nCdCalendario'];
	$conteudo = $registro ['cConteudo'];
	
	$data_atual = mktime ( 0, 0, 0, $mes, $d, $ano );
	$x ++;
	if ($x % 2 == 0) {
		$color = '#CCCCCC';
	} else {
		$color = '#AAAAAA';
	}
	if (date ( "N", $data_atual ) < 6) {
		
		switch (date ( "N", $data_atual )) {
			case 1 :
				$dw = "S";
				break;
			case 2 :
				$dw = "T";
				break;
			case 3 :
				$dw = "Q";
				break;
			case 4 :
				$dw = "Q";
				break;
			case 5 :
				$dw = "S";
				break;
		}
		
		echo "<tr style='background-color: $color'>
				  	<td width='150px'><center>" . date ( "d/m/Y", $data_atual ) . "</center></td>
					<td width='810px'><textarea style='width: 800px; height: 170px;' codigo='$codigo'>$conteudo</textarea></td>
				  </tr>";
	}
}

?>
</table>
</div>