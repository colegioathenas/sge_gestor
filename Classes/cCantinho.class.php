<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
include_once "cCantinho_Item.class.php";
include_once "cTurma.class.php";
ini_set ( "display_errors", 1 );
class Cantinho {
	private $Codigo;
	var $Data;
	var $Turma;
	var $Items;
	function __construct() {
		$this->Items = array ();
		$this->Turma = new Turma ();
	}
	static function lista($data) {
		$dCantinho = $data;
		$query = "call listCantinh('$dCantinho')";
		$resultado = consulta2 ( $query );
		$cantinhos = array ();
		foreach ( $resultado as $registro ) {
			$obj = new Cantinho ();
			$obj->Codigo = $registro ['nCdCodigo'];
			$obj->Turma->Codigo = $registro ['nCdTurma'];
			$obj->Disciplina->Codigo = $registro ['nCdDisciplina'];
			$cantinhos [] = $obj;
		}
		return $cantinhos;
	}
	function load($codigo) {
		$query = "call loadCantinho($codigo)";
		$resultado = consulta2 ( $query );
		
		$this->Codigo = $resultado [0] ['nCdCodigo'];
		$this->Turma->Codigo = $resultado [0] ['nCdTurma'];
		$this->Disciplina->Codigo = $resultado [0] ['nCdDisciplina'];
		
		$this->Items = Cantinho_Item::loadItens ( $codigo );
	}
	function salvar() {
		$nCdCantinho = $this->Codigo;
		$dCantinho = $this->Data;
		$nCdTurma = $this->Turma->Codigo;
		$nCdDisciplina = $this->Disciplina->Codigo;
		$query = "call updateTipoSolicitacao($nCdCantinho,'$dCantinho',$nCdTurma,$nCdDisciplina,$nAula,'$cPagAula','$cPagTarefa');";
		consulta2 ( $query );
	}
	function adicionaItem($item) {
		$this->Items [] = $item;
	}
	function removeItem($item) {
	}
}

?>