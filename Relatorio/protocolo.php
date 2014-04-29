<?php
session_start ();
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
include_once ('../Util/fpdf.php');

$solicitacao = $_REQUEST ['solicitacao'];
$query = "SELECT tpSolicitacao.cNmTpSolicitacao
			    , solicitacao.dSolicitacao
			    , solicitacao.dPrazo
			    , pessoa.cNome
			    , usuario.cLogin
             FROM solicitacao
                  INNER JOIN usuario 		ON usuario.nCdUsuario = solicitacao.nCdUSuarioCad
                  INNER JOIN pessoa  		ON pessoa.nCdPessoa   = solicitacao.nCdPessoa
                  INNER JOIN tpsolicitacao  ON tpsolicitacao.nCdTpSolicitacao = solicitacao.nCdTpSolicitacao
			WHERE solicitacao.nCdSolicitacao = $solicitacao";

$registros = consulta ( "athenas", $query );
$registro = $registros [0];

$cNmTpSolicitacao = $registro ['cNmTpSolicitacao'];
$dSolicitacao = date ( "d/m/Y", strtotime ( $registro ['dSolicitacao'] ) );
$dPrazo = date ( "d/m/Y", strtotime ( $registro ['dPrazo'] ) );
$cNome = $registro ['cNome'];
;
$usuario = $registro ['cLogin'];
$autenticacao = $registro ['cSenha'];

$pdf = new FPDF ( "P", "mm", array (
		85,
		85 
) );

$pdf->Open ();
$pdf->AddPage ();
$pdf->SetTopMargin ( 0 );
$pdf->Image ( '../image/LOGO_ATHENAS.jpg', 2, 2, 30 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->SetXY ( $pdf->GetX () + 30, $pdf->GetY () );
$pdf->Cell ( 0, 0, 'PROTOCOLO', 0, 1 );
$pdf->SetFont ( 'courier', 'B', 12 );
$pdf->Cell ( 0, 1, str_pad ( $solicitacao, 4, "0", STR_PAD_LEFT ), 0, 2, 'R' );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->SetX ( 2 );
$pdf->Cell ( 22, 15, iconv ( "utf-8", "iso-8859-9", 'Requerimento:' ), "", 0 );
$pdf->SetFont ( 'courier', 'B', 8 );
$pdf->Cell ( 0, 15, iconv ( "utf-8", "iso-8859-9", $cNmTpSolicitacao ), "", 1 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->SetX ( 2 );
$pdf->Cell ( 10, - 8, iconv ( "utf-8", "iso-8859-9", 'Data:' ), "", 0 );
$pdf->SetFont ( 'courier', 'B', 8 );
$pdf->Cell ( 20, - 8, iconv ( "utf-8", "iso-8859-9", $dSolicitacao ), "", 0 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->Cell ( 10, - 8, iconv ( "utf-8", "iso-8859-9", 'Prazo:' ), "", 0 );
$pdf->SetFont ( 'courier', 'B', 8 );
$pdf->Cell ( 20, - 8, iconv ( "utf-8", "iso-8859-9", $dPrazo ), "", 1 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->SetX ( 2 );
$pdf->Cell ( 20, 14, iconv ( "utf-8", "iso-8859-9", 'Requerente:' ), "", 0 );
$pdf->SetFont ( 'courier', 'B', 8 );
$pdf->Cell ( 20, 14, iconv ( "utf-8", "iso-8859-9", $cNome ), "", 1 );
$pdf->SetX ( 2 );
$pdf->Cell ( 50, 0, iconv ( "utf-8", "iso-8859-9", "Protocolo Gerado por $usuario" ), "", 1 );
$pdf->SetX ( 2 );
$pdf->Cell ( 10, 5, iconv ( "utf-8", "iso-8859-9", "em " . date ( "d/m/Y H:i:s" ) ), "", 1 );
$pdf->SetX ( 2 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->Cell ( 25, 5, iconv ( "utf-8", "iso-8859-9", 'Autenticação:' ), "", 0 );
$pdf->SetFont ( 'courier', 'B', 8 );
$pdf->Cell ( 10, 5, iconv ( "utf-8", "iso-8859-9", "$autenticacao" ), "", 1 );
$pdf->SetX ( 2 );
$pdf->SetFont ( 'courier', '', 8 );
$pdf->Cell ( 25, 5, iconv ( "utf-8", "iso-8859-9", 'Acompanhar em http://www.colegioathenas.com.br' ), "", 0 );
$pdf->Output ( "protocolo.pdf", "D" );

?>