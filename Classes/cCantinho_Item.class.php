<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
include_once "cDisciplina.class.php";
ini_set ( "display_errors", 1 );
class Cantinho_Item {
	var $Disciplina;
	var $Aula;
	var $Pagina_Aula;
	var $Pagina_Tarefa;
	var $Status;
	function __construct() {
		$this->Disciplina = new Disciplina ();
		$this->Status = "I";
	}
	static function loadItens($codigo) {
		$query = "call listCantinhoItem('$codigo')";
		$resultado = consulta2 ( $query );
		$cantinhos = array ();
		foreach ( $resultado as $registro ) {
			$obj = new Cantinho_Item ();
			$obj->Disciplina->Codigo = $registro ['nCdDisciplina'];
			$obj->Aula = $registro ['nAula'];
			$obj->Pagina_Aula = $registro ['cPagAula'];
			$obj->Pagina_Tarefa = $registro ['cPagTarefa'];
			$obj->Status = "O";
			$itens [] = $obj;
		}
		
		return $itens;
	}
	function __set($name, $value) {
		$this->Status = "A";
	}
	function Remove() {
		$this->Status = "E";
	}
}

?>