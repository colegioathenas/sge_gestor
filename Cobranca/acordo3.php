<?
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 1 );
include_once "../Util/gravar_comunicacao.php";
session_start ();

$cpf = $_REQUEST ['cpf'];
$usuario = $_SESSION ['nCdUsuario'];
$parcelas = $_REQUEST ['parcelas'];
$valor = $_REQUEST ['vlrTotal'];
$primeiroVcto = $_REQUEST ['dt_vcto'];
$boletos = $_REQUEST ['boletos'];
$desconto = $_REQUEST ['vlrDesconto'];

$boletos = substr ( $boletos, 0, strlen ( $boletos ) - 1 );

list ( $dia, $mes, $ano ) = explode ( "/", $primeiroVcto );
$primeiroVctoSql = "$ano-$mes-$dia";

$valor = str_replace ( ".", "", $valor );
$valor = str_replace ( ",", ".", $valor );

$desconto = str_replace ( ".", "", $desconto );
$desconto = str_replace ( ",", ".", $desconto );

$valor_total = floatval ( $valor ) - floatval ( $desconto );

$valor_parcela = $valor_total / $parcelas;

$dataSql = date ( "Y-m-d" );

$query = "call gerar_acordo($cpf,$usuario,$parcelas,$valor,'$primeiroVctoSql')";

$resultado = consulta ( 'athenas', $query );

$nCdAcordo = $resultado [0] ['nCdAcordo'];

// Baixa os Boletos
$boletos = explode ( ',', $boletos );
$qtdbol = count ( $boletos );
foreach ( $boletos as $boleto ) {
	$query = "call baixar_titulo('$boleto','$dataSql',0,0,0
				 ,0,0,0,0,'$dataSql','$dataSql','00','00','00','98',$nCdAcordo);";
	
	consulta ( 'athenas', $query );
}

// Gera NossoNumero
$query = "SELECT * FROM Titulos where nCdPessoa = $cpf and nNossoNumero is null";

$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	consulta ( 'athenas', $query );
}
grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 1, "Feito acordo de $valor ($qtdbol Titulos) em $parcelas vezes de $valor_parcela. Primeiro Vencimento em $primeiroVcto" );
?>