	
	function VerificaEstadoImpressora()
		Dim ACK,ST1,ST2 
		iRetorno = BemaWeb.VerificaEstadoImpressora(ACK, ST1, ST2)
		MsgBox "ACK:" + ACK + " ST1:" + ST1 + " ST2:" + ST2
	end function
	
	function RetornoAliquotas()
		Dim cAliquotas
		iRetorno = BemaWeb.RetornoAliquotas( cAliquotas )
		MsgBox cAliquotas
	end function
	
	function VerificaTotalizadoresParciais()
		Dim cTots
		iRetorno = BemaWeb.VerificaTotalizadoresParciais( cTots )
		MsgBox cTots
	end function
	
	function SubTotal()
		Dim cSubTotal
		iRetorno = BemaWeb.SubTotal( cSubTotal )
		MsgBox cSubTotal
	end function
	
	function NumeroCupom()
		Dim cNumeroCupom
		iRetorno = BemaWeb.NumeroCupom( cNumeroCupom )
		MsgBox cNumeroCupom
	end function
	
	function VerificaDepartamentos()
		Dim cDepartamentos
		iRetorno = BemaWeb.VerificaDepartamentos( cDepartamentos )
		MsgBox cDepartamentos
	end function
	
	function VerificaFormasPagamento()
		Dim sFormas
		iRetorno = BemaWeb.VerificaFormasPagamento( sFormas )
		 MsgBox sFormas
	end function
	
	function FlagsFiscais()
		Dim iFlagsFiscais
		iRetorno = BemaWeb.FlagsFiscais( iFlagsFiscais )
		MsgBox iFlagsFiscais
	end function
	
	function GrandeTotal()
		Dim cGrandeTotal
		iRetorno = BemaWeb.GrandeTotal( cGrandeTotal )
		MsgBox cGrandeTotal
	end function
	
	function Descontos()
		Dim cDescontos
		iRetorno = BemaWeb.Descontos( cDescontos )
		MsgBox cDescontos
	end function
	
	function Cancelamentos()
		Dim cCancelamentos
		iRetorno = BemaWeb.Cancelamentos( cCancelamentos )
		MsgBox cCancelamentos
	end function
	
	function NumeroCuponsCancelados()
		Dim cCuponsCancelados
		iRetorno = BemaWeb.NumeroCuponsCancelados( cCuponsCancelados )
		MsgBox cCuponsCancelados
	end function
	
	function NumeroCaixa()
		Dim cCaixa
		iRetorno = BemaWeb.NumeroCaixa(cCaixa)
		MsgBox cCaixa
	end function
	
	function NumeroLoja()
		Dim cLoja
		iRetorno = BemaWeb.NumeroLoja(cLoja)
		MsgBox cLoja
	end function
	
	function UltimoItemVendido()
		Dim cItem
		iRetorno = BemaWeb.UltimoItemVendido(cItem)
		MsgBox cItem
	end function
	
	function NumeroSubstituicoesProprietario()
		Dim cSubst
		iRetorno = BemaWeb.NumeroSubstituicoesProprietario(cSubst)
		MsgBox cSubst
	end function
	
	function NumeroSerie()
		Dim cNumeroSerie		
		iRetorno = BemaWeb.NumeroSerie(cNumeroSerie)
		MsgBox cNumeroSerie
	end function
	
	function NumeroOperacoesNaoFiscais()
		Dim cOperacoes
		iRetorno = BemaWeb.NumeroOperacoesNaoFiscais(cOperacoes)
		MsgBox cOperacoes
	end function
	
	function NumeroIntervencoes()
		Dim cIntervencoes
		iRetorno = BemaWeb.NumeroIntervencoes(cIntervencoes)
		MsgBox cIntervencoes
	end function
	
	function NumeroReducoes()
		Dim cReducoes
		iRetorno = BemaWeb.NumeroReducoes( cReducoes )
		MsgBox cReducoes
	end function
	
	function VersaoFirmware()
		Dim cVersao
		iRetorno = BemaWeb.VersaoFirmware(cVersao)
		MsgBox cVersao
	end function
	
	function VerificaModoOperacao()
		Dim cModoOP
		iRetorno = BemaWeb.VerificaModoOperacao(cModoOP)
		MsgBox cModoOP
	end function
	
	function VerificaTruncamento()
		Dim cModo
		iRetorno = BemaWeb.VerificaTruncamento(cModo)
		MsgBox cModo
	end function
	
	function VerificaEpromConectada()
		Dim cEpromConectada
		iRetorno = BemaWeb.VerificaEpromConectada(cEpromConectada)
		MsgBox cEpromConectada
	end function
	
	function VerificaTotalizadoresNaoFiscais()
		Dim cTotalizadores
		iRetorno = BemaWeb.VerificaTotalizadoresNaoFiscais(cTotalizadores)
		MsgBox cTotalizadores
	end function
	
	function VerificaAliquotasIss()
		Dim cAliquotas
		iRetorno = BemaWeb.VerificaAliquotasIss(cAliquotas)
		MsgBox cAliquotas
	end function
	
	function VerificaRecebimentoNaoFiscal()
		Dim cRecebimento
		iRetorno = BemaWeb.VerificaRecebimentoNaoFiscal(cRecebimento)
		MsgBox cRecebimento
	end function
	
	function VerificaDepartamentos()
		Dim cDepartamentos
		iRetorno = BemaWeb.VerificaDepartamentos(cDepartamentos)
		MsgBox cDepartamentos
	end function
	
	function VerificaTipoImpressora()
		Dim iTipo
		iRetorno = BemaWeb.VerificaTipoImpressora(iTipo)
		MsgBox iTipo
	end function	
	
	function VerificaIndiceAliquotasIss()
		Dim cIndiceAliquotas
		iRetorno = BemaWeb.VerificaIndiceAliquotasIss(cIndiceAliquotas)
		MsgBox cIndiceAliquotas
	end function
	
	function ValorTotalizadorNaoFiscal(Totalizador)
		Dim Valor
		iRetorno = BemaWeb.ValorTotalizadorNaoFiscal(Totalizador,Valor)
		MsgBox ("Valor da forma de pagamento " + Totalizador + ": " + Valor)
	end function
		
	function ValorFormaPagamento(FormaPagamento)
		Dim Valor
		iRetorno = BemaWeb.ValorFormaPagamento(FormaPagamento,Valor)
		MsgBox ("Valor da forma de pagamento " + FormaPagamento + ": " + Valor)
	end function
	
	function Acrescimos()
		Dim Acresc
		iRetorno = BemaWeb.Acrescimos(Acresc)
		MsgBox ( "Acr&eacute;scimos: " + Acresc)
	end function
	
	function NumeroCuponsCancelados()
		Dim  CuponsCancelados
		iRetorno = BemaWeb.NumeroCuponsCancelados(CuponsCancelados)
		MsgBox CuponsCancelados
	end function
	
	function MinutosImprimindo() 
		Dim Valor
		iRetorno = BemaWeb.MinutosImprimindo( Valor )
		MsgBox Valor
	end function
	
	function MinutosLigada()
		Dim Valor
		iRetorno = BemaWeb.MinutosLigada(Valor)
		MsgBox Valor	
	end function
	
	function FlagsFiscais()
		Dim iFlag
		iRetorno = BemaWeb.FlagsFiscais( iFlag )
		MsgBox iFlag
	end function
	
	function SimboloMoeda()
		Dim Valor
		iRetorno = BemaWeb.SimboloMoeda(Valor)
		MsgBox Valor
	end function
	
	function CGCIE()
		Dim CGC,IE
		iRetorno = BemaWeb.CGC_IE(CGC,IE)
		MsgBox "CGC: " + CGC + " IE: " + IE
	end function
	
	function GrandeTotal()
		Dim Valor
		iRetorno = BemaWeb.GrandeTotal(Valor)
		MsgBox Valor
	end function
	
	function ClicheProprietario()
		Dim Cliche
		iRetorno = BemaWeb.ClicheProprietario(Cliche)
		MsgBox Cliche
	end function
	
	function VerificaEpromConectada()
		Dim EPROM
		VerificaEpromConectada(EPROM)
		if EPROM = 1 then
			MsgBox "Eprom Conectada"
		else 
			MsgBox "Eprom Desconectada"			
		end if		
	end function
	
	function DataHoraImpressora()
		Dim Data, Hora	
		iRetorno = BemaWeb.DataHoraImpressora( Data, Hora )
		MsgBox "Data: " + Data + " Hora: " + Hora
	end function
	
	function ContadoresTotalizadoresNaoFiscais()
		Dim Valor
		iRetorno = BemaWeb.ContadoresTotalizadoresNaoFiscais(Valor)
		MsgBox Valor
	end function
	
	function DataHoraReducao()
		Dim Data, Hora
		iRetorno = BemaWeb.DataHoraReducao( Data, Hora )
		MsgBox "Data: " + Data + " Hora: " + Hora
	end function
	
	function DataMovimento()
		Dim Data
		iRetorno = BemaWeb.DataMovimento( Data )
		MsgBox "Data do movimento: " + Data
	end function
	
	function VerificaEstadoGaveta()
		Dim iEstadoGaveta 
		iRetorno = BemaWeb.VerificaEstadoGaveta( iEstadoGaveta )
		MsgBox iEstadoGaveta 
	end function
	
	function VerificaModoOperacao()
		Dim Modo
		iRetorno = BemaWeb.VerificaModoOperacao( Modo )
		if Modo = "1" then
			MsgBox "A Impressora se encontra em Opera&ccedil;&atilde;o Normal."
		else
			MsgBox "A Impressora se encontra em Interven&ccedil;&atilde;o T&eacute;cnica."
		end if
	end function