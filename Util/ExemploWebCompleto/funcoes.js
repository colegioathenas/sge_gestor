document.write('<object classid="clsid:2F9082AF-E2A7-4F20-9D6B-3855D79A3D86" id="BemaWeb" width="14" height="14"></object>');
	function AbreCupom(CPFCNPJ){
		iRetorno = BemaWeb.AbreCupom('');
	}
	function VendeItem(CodigoProduto, Descricao, Aliquota, sTipoQtde, Quantidade, iDecimal, Valor, sTipoDesconto, Desconto){
		iRetorno = BemaWeb.VendeItem(CodigoProduto, Descricao, Aliquota, sTipoQtde, Quantidade, iDecimal, Valor, sTipoDesconto, Desconto);
	}			
	function FechaCupomResumido(FormaPagamento,Mensagem){
		iRetorno = BemaWeb.FechaCupomResumido(FormaPagamento,Mensagem);
	}
	function VendeItemDepartamento(Codigo, Descricao, Aliquota, ValorUnitario, Quantidade, Acrescimo, Desconto, IndiceDepartamento, UnidadeMedida){
		iRetorno = BemaWeb.VendeItemDepartamento(Codigo, Descricao, Aliquota, ValorUnitario, Quantidade, Acrescimo, Desconto, IndiceDepartamento, UnidadeMedida);
	}
	function CancelaItemAnterior(){
		iRetorno = BemaWeb.CancelaItemAnterior();
	}
	function CancelaItemGenerico(NumeroItem){
		iRetorno = BemaWeb.CancelaItemGenerico(NumeroItem);
	}		
	function CancelaCupom(){
		iRetorno = BemaWeb.CancelaCupom();
	}
	function UsaUnidadeMedida(UnidadeMedida){
		iRetorno = BemaWeb.UsaUnidadeMedida(UnidadeMedida);
	}
	function EstornoFormasPagamento(FormaPagamento,ParaFormaPagamento,ValorEstornado){
		iRetorno = BemaWeb.EstornoFormasPagamento(FormaPagamento,ParaFormaPagamento,ValorEstornado);
	}
	function AumentaDescricaoItem(Descricao){
		iRetorno = BemaWeb.AumentaDescricaoItem(Descricao);
	}
	function Autenticacao(){
		iRetorno = BemaWeb.Autenticacao();
	}
	function FechaCupom(FormaPagamento, AcrescimoDesconto, TipoAcrescimoDesconto, ValorAcrescimoDesconto, ValorPago, Mensagem){
		iRetorno = BemaWeb.FechaCupom(FormaPagamento, AcrescimoDesconto, TipoAcrescimoDesconto, ValorAcrescimoDesconto, ValorPago, Mensagem);
	}
	function IniciaFechamentoCupom(AcrescimoDesconto, TipoAcrescimoDesconto, ValorAcrescimoDesconto){
		iRetorno = BemaWeb.IniciaFechamentoCupom(AcrescimoDesconto, TipoAcrescimoDesconto, ValorAcrescimoDesconto);
	}
	function EfetuaFormaPagamento(FormaPagamento,ValorPago){
		iRetorno = BemaWeb.EfetuaFormaPagamento(FormaPagamento,ValorPago);
	}
	function TerminaFechamentoCupom(MensagemPromocional){
		iRetorno = BemaWeb.TerminaFechamentoCupom(MensagemPromocional);
	}	
	function EfetuaFormaPagamentoDescricaoForma(FormaPagamento, ValorFormaPagamento, DescricaoFormaPagto){
		iRetorno = BemaWeb.EfetuaFormaPagamentoDescricaoForma(FormaPagamento, ValorFormaPagamento, DescricaoFormaPagto);
	}
	function VendeItemDepartamento(CodigoProduto,Descricao,Aliquota,Valor,Quantidade,sAcrescimo,sDesconto,Departamento,UnidadeMedida){
		iRetorno = BemaWeb.VendeItemDepartamento(CodigoProduto,Descricao,Aliquota,Valor,Quantidade,sAcrescimo,sDesconto,Departamento,UnidadeMedida);
	}
	function RelatorioGerencial(Texto){
		iRetorno = BemaWeb.RelatorioGerencial(Texto);
	}
	function FechaRelatorioGerencial(){
		iRetorno = BemaWeb.FechaRelatorioGerencial();
	}
	function AbreComprovanteNaoFiscalVinculado(FormaPagamento,ValorPago,COO){
		iRetorno = BemaWeb.AbreComprovanteNaoFiscalVinculado(FormaPagamento,ValorPago,COO);
	}
	function UsaComprovanteNaoFiscalVinculado(Texto){
		iRetorno = BemaWeb.UsaComprovanteNaoFiscalVinculado(Texto);
	}
	function Suprimento(Valor,FormaPagamento){
		iRetorno = BemaWeb.Suprimento(Valor,FormaPagamento);
	}
	function RecebimentoNaoFiscal(IndiceTotalizador,Valor,FormaPagamento){
		iRetorno = BemaWeb.RecebimentoNaoFiscal(IndiceTotalizador,Valor,FormaPagamento);		
	}
	function Sangria(Valor){
		iRetorno = BemaWeb.Sangria(Valor);
	}
	function LeituraX(){
		iRetorno = BemaWeb.LeituraX();
	}
	function LeituraXSerial(){
		iRetorno = BemaWeb.LeituraXSerial();
	}
	function ReducaoZ(Data, Hora){
		iRetorno = BemaWeb.ReducaoZ(Data, Hora);
	}
	function LeituraMemoriaFiscalData(DataInicial,DataFinal){
		iRetorno = BemaWeb.LeituraMemoriaFiscalData(DataInicial,DataFinal);
	}
	function LeituraMemoriaFiscalReducao(ReducaoInicial,ReducaoFinal){
		iRetorno = BemaWeb.LeituraMemoriaFiscalReducao(ReducaoInicial,ReducaoFinal);
	}
	function AlteraSimboloMoeda(SimboloMoeda){
		iRetorno = BemaWeb.AlteraSimboloMoeda(SimboloMoeda);
	}
	function ProgramaAliquota(ValorAliquota,iSituacao){
		iRetorno = BemaWeb.ProgramaAliquota(ValorAliquota,iSituacao);
	}
	function ProgramaHorarioVerao(){
		iRetorno = BemaWeb.ProgramaHorarioVerao();
	}
	function ProgramaArredondamento(){
		iRetorno = BemaWeb.ProgramaArredondamento();
	}
	function ProgramaTruncamento(){
		iRetorno = BemaWeb.ProgramaTruncamento();
	}
	function NomeiaDepartamento(IndiceDepartamento,NomeDepartamento){
		iRetorno = BemaWeb.NomeiaDepartamento(IndiceDepartamento,NomeDepartamento);
	}
	function NomeiaTotalizadorNaoSujeitoIcms(IndiceTotalizador,NomeTotalizador){
		iRetorno = BemaWeb.NomeiaTotalizadorNaoSujeitoIcms(IndiceTotalizador,NomeTotalizador);
	}
	function EspacoEntreLinhas(NumeroLinhas){
		iRetorno = BemaWeb.EspacoEntreLinhas(NumeroLinhas);
	}
	function LinhasEntreCupons(NumeroLinhas){
		iRetorno = BemaWeb.LinhasEntreCupons(NumeroLinhas);
	}
	function ForcaImpactoAgulhas(iForca){
		iRetorno = BemaWeb.ForcaImpactoAgulhas(iForca);
	}	
	function ResetaImpressora(){
		iRetorno = BemaWeb.ResetaImpressora();
	}
	function ProgramaMoedaSingular(Moeda){
		iRetorno = BemaWeb.ProgramaMoedaSingular(Moeda)
	}
	function AcionaGaveta(){
		iRetorno = BemaWeb.AcionaGaveta();
	}
	function ImprimeCheque( Banco, Valor, Favorecido, Cidade, Data, Mensagem ){
		iRetorno = BemaWeb.ImprimeCheque( Banco, Valor, Favorecido, Cidade, Data, Mensagem );
	}
	function AberturaDoDia(Valor,FormaPagamento){
		iRetorno = BemaWeb.AberturaDoDia(Valor,FormaPagamento);
	}
	function FechamentoDoDia(){
		iRetorno = BemaWeb.FechamentoDoDia();
	}
	function ImprimeConfiguracoesImpressora(){
		iRetorno = BemaWeb.ImprimeConfiguracoesImpressora()
	}
	function ImprimeDepartamentos(){
		iRetorno = BemaWeb.ImprimeDepartamentos();
	}
	function RelatorioTipo60Analitico(){
		iRetorno = BemaWeb.RelatorioTipo60Analitico();
	}
	function RelatorioTipo60Mestre(){
		iRetorno = BemaWeb.RelatorioTipo60Mestre();
	}
	function VerificaImpressoraLigada(){
		iRetorno = BemaWeb.VerificaImpressoraLigada();
		if (iRetorno == -6)
			alert("A Impressora se encontra DESLIGADA.");
		else
			alert("A Impressora se encontra LIGADA.");
	}	
	function MapaResumo(){
		iRetorno = BemaWeb.MapaResumo();
	}
