<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

ini_set ( "display_errors", 1 );
class AFD_Header {
	public $TipoEmpregador;
	public $CNPJ;
	public $CEI;
	public $RazaoSocial;
	public $NumeroREP;
	public $DtInicioReg;
	public $DtFimReg;
	public $DtArquivo;
	public $HrArquivo;
	public function __construct() {
	}
}
class AFD_Empresa {
	public $DtGravacao;
	public $HrGravacao;
	public $TipoEmpregador;
	public $CNPJ;
	public $CEI;
	public $RazaoSocial;
	public $Local;
}
class AFD_Marcacao {
	public $Data;
	public $Hora;
	public $PIS;
	public function __construct() {
	}
}
class AFD_Relogio {
	public $DataAnterior;
	public $HoraAnterior;
	public $DataAjustada;
	public $HoraAjustada;
	public function __construct() {
	}
}
class AFD_Empregado {
	public $DataRegistro;
	public $HoraRegistro;
	public $Operacao;
	public $PIS;
	public $Nome;
	public $Chave;
	public function __construct() {
	}
}
class AFD {
	public $Header;
	public $Empresas;
	public $Maracoes;
	public $Relogio;
	public $Empregado;
	public function __construct() {
		$this->Header = new AFD_Header ();
		$this->Empresa = array ();
		$this->Maracoes = array ();
		$this->Relogio = array ();
		$this->Empregado = array ();
	}
	private function realizar_marcacoes() {
		$marcacoes_dia = array ();
		$dataAtual = 0;
		foreach ( $this->Maracoes as $marcacao ) {
			$pis = $marcacao->PIS;
			$data = "'" . substr ( $marcacao->Data, 4, 4 ) . "-" . substr ( $marcacao->Data, 2, 2 ) . "-" . substr ( $marcacao->Data, 0, 2 ) . "'";
			$hora = "'" . substr ( $marcacao->Hora, 0, 2 ) . ":" . substr ( $marcacao->Hora, 2, 2 ) . "'";
			if ($dataAtual != $data) {
				
				foreach ( $marcacoes_dia as $pisAtual => $marcacao_func ) {
					
					$ES = "Entrada";
					$nES = 1;
					$campo = "";
					$valores = "";
					$x = 0;
					foreach ( $marcacao_func as $marcES ) {
						$x ++;
						if ($ES == "Entrada") {
							$campo .= ",d$ES$nES,nCdTpMarcacaoE$nES,nCdOcorrenciaE$nES,hMarcacao$x";
							$ES = "Saida";
						} else {
							$campo .= ",d$ES$nES,nCdTpMarcacaoS$nES,nCdOcorrenciaS$nES,hMarcacao$x";
							$ES = "Entrada";
							$nES ++;
						}
						$valores .= "," . $marcES [1] . ",1,null," . $marcES [1];
					}
					$query = "insert into marcacao (nCdFuncionario, dMarcacao $campo) 
                            values ( (select nCdPessoa from funcionario where nPis = $pisAtual limit 0,1)
                                   , $dataAtual $valores);";
					
					consulta ( "athenas", $query );
				}
				
				unset ( $marcacoes_dia );
			}
			$dataAtual = $data;
			$marcacoes_dia [$pis] [] = array (
					$data,
					$hora 
			);
		}
		foreach ( $marcacoes_dia as $pisAtual => $marcacao_func ) {
			
			$ES = "Entrada";
			$nES = 1;
			$campo = "";
			$valores = "";
			$x = 0;
			foreach ( $marcacao_func as $marcES ) {
				$x ++;
				if ($ES == "Entrada") {
					$campo .= ",d$ES$nES,nCdTpMarcacaoE$nES,nCdOcorrenciaE$nES,hMarcacao$x";
					$ES = "Saida";
				} else {
					$campo .= ",d$ES$nES,nCdTpMarcacaoS$nES,nCdOcorrenciaS$nES,hMarcacao$x";
					$ES = "Entrada";
					$nES ++;
				}
				$valores .= "," . $marcES [1] . ",1,null," . $marcES [1];
			}
			$query = "insert into marcacao (nCdFuncionario, dMarcacao $campo) 
                            values ((select nCdPessoa from funcionario where nPis = $pisAtual limit 0,1)
                                   , $dataAtual $valores);";
			
			consulta ( "athenas", $query );
		}
	}
	public function processar_arquivo($file, $dInicio, $dFim) {
		$query = "delete marcacao where dMarcacao between '$dInicio' and '$dFim';";
		consulta ( "athenas", $query );
		$arq = fopen ( $file, "r" );
		while ( ($linha = fgets ( $arq )) !== FALSE ) {
			/*
			 * if (substr($linha, 9,1) == "1"){ $this->Header->TipoEmpregador = substr($linha,10,1); $this->Header->CNPJ = substr($linha,11,14); $this->Header->CEI = substr($linha,25,12); $this->Header->RazaoSocial = substr($linha,37,150); $this->Header->NumeroREP = substr($linha,187,17); $this->Header->DtInicioReg = substr($linha,204,8); $this->Header->DtFimReg = substr($linha,212,8); $this->Header->DtArquivo = substr($linha,220,8); $this->Header->HrArquivo = substr($linha,228,4); } if (substr($linha, 9,1) == "2"){ $empresa = new AFD_Empresa(); $empresa->DtGravacao = substr($linha,10,8); $empresa->HrGravacao = substr($linha,18,4); $empresa->TipoEmpregador = substr($linha,22,1); $empresa->CNPJ = substr($linha,23,14); $empresa->CEI = substr($linha,37,12); $empresa->RazaoSocial = substr($linha,49,150); $empresa->Local = substr($linha,199,100); $this->Emepresa[] = $empresa; }
			 */
			if (substr ( $linha, 9, 1 ) == "3") {
				$marcacao = new AFD_Marcacao ();
				$marcacao->Data = substr ( $linha, 10, 8 );
				$marcacao->Hora = substr ( $linha, 18, 4 );
				$marcacao->PIS = substr ( $linha, 22, 12 );
				
				$data = mktime ( 0, 0, 0, substr ( $marcacao->Data, 2, 2 ), substr ( $marcacao->Data, 0, 2 ), substr ( $marcacao->Data, 4, 4 ) );
				
				if (($data >= strtotime ( $dInicio )) && ($data <= strtotime ( $dFim ))) {
					$this->Maracoes [] = $marcacao;
				}
			} /*
			   * if (substr($linha, 9,1) == "4"){ $relogio = new AFD_Relogio(); $relogio->DataAnterior = substr($linha, 10,8); $relogio->HoraAnterior = substr($linha, 18,4); $relogio->DataAjustada = substr($linha, 22,8); $relogio->HoraAjustada = substr($linha, 30,4); $this-> Relogio[] = $relogio; } if (substr($linha, 9,1) == "5"){ $empregado = new AFD_Empregado(); $empregado->DataRegistro = substr($linha,10,8); $empregado->HoraRegistro = substr($linha,18,4); $empregado->Operacao = substr($linha,22,1); $empregado->PIS = substr($linha,23,12); $empregado-> Nome = rtrim(substr($linha,35,52)); $empregado->Chave = $empregado->Nome.substr($empregado->DataRegistro,4,4 ).substr($empregado->DataRegistro,2,2 ).substr($empregado->DataRegistro,0,2 ); $this->Empregado[] = $empregado; }
			   */
		}
		
		$this->realizar_marcacoes ();
	}
}
?>
