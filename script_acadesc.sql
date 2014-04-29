-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: acadesc
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abonofaltas`
--

DROP TABLE IF EXISTS `abonofaltas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonofaltas` (
  `Codigo` int(11) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `Bim` varchar(1) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Faltas` int(11) DEFAULT NULL,
  `Motivo` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `acertoestoque`
--

DROP TABLE IF EXISTS `acertoestoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acertoestoque` (
  `ID` int(11) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `CodProduto` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `Usuario` int(11) DEFAULT NULL,
  `Motivo` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `acompmedico`
--

DROP TABLE IF EXISTS `acompmedico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acompmedico` (
  `Mat` varchar(10) DEFAULT NULL,
  `NumOcorrencia` int(11) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `Observacoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `id` int(11) DEFAULT NULL,
  `DataHora` datetime DEFAULT NULL,
  `Tarefas` longtext,
  `Tipo` int(11) DEFAULT NULL,
  `Finalizado` int(11) DEFAULT NULL,
  `Compromisso` varchar(60) DEFAULT NULL,
  `Usuario` int(11) DEFAULT NULL,
  `publico` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `Mat` varchar(8) DEFAULT NULL,
  `Nome` varchar(70) DEFAULT NULL,
  `DtNascimento` datetime DEFAULT NULL,
  `Sexo` int(11) DEFAULT NULL,
  `CidadeNasc` varchar(30) DEFAULT NULL,
  `UfNasc` varchar(2) DEFAULT NULL,
  `Nacionalidade` varchar(15) DEFAULT NULL,
  `RGAluno` varchar(15) DEFAULT NULL,
  `RA` varchar(20) DEFAULT NULL,
  `Religiao` varchar(30) DEFAULT NULL,
  `Endereco` varchar(50) DEFAULT NULL,
  `Bairro` varchar(30) DEFAULT NULL,
  `Cidade` varchar(30) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `Telefone` varchar(30) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DataEntrada` datetime DEFAULT NULL,
  `ColegioAnterior` varchar(40) DEFAULT NULL,
  `UltimaSerie` varchar(20) DEFAULT NULL,
  `CidadeColAnterior` varchar(30) DEFAULT NULL,
  `UFColegioAnterior` varchar(2) DEFAULT NULL,
  `ComQuemMora` int(11) DEFAULT NULL,
  `ComQuemMoraOutros` varchar(30) DEFAULT NULL,
  `PodeSairSozinho` int(11) DEFAULT NULL,
  `MeioDeTransporte` int(11) DEFAULT NULL,
  `EsperaForaDoColegio` int(11) DEFAULT NULL,
  `OndePodeEsperar` varchar(40) DEFAULT NULL,
  `Observacoes` longtext,
  `Obs_Medio` longtext,
  `Certificado_Medio` longtext,
  `Obs_Fundamental` longtext,
  `Certificado_Fundamental` longtext,
  `Hist_TotFaltas_Fund` int(11) DEFAULT NULL,
  `Hist_DiasLetivos_Fund` int(11) DEFAULT NULL,
  `Hist_TotFaltas_Medio` int(11) DEFAULT NULL,
  `Hist_DiasLetivos_Medio` int(11) DEFAULT NULL,
  `segundanacionalidade` varchar(30) DEFAULT NULL,
  `Senha` varchar(10) DEFAULT NULL,
  `MensagemBoleto` longtext,
  `FilhoFuncionario` int(11) DEFAULT NULL,
  `HoraEntrada` datetime DEFAULT NULL,
  `HoraSaida` datetime DEFAULT NULL,
  `ExpedicaoRG` varchar(15) DEFAULT NULL,
  `DataExpedicaoRG` datetime DEFAULT NULL,
  `EnviaCarta` int(11) DEFAULT NULL,
  `JurosDia` double DEFAULT NULL,
  `Multa` double DEFAULT NULL,
  `JurosDiferenciado` int(11) DEFAULT NULL,
  `CertidaoNasc` varchar(80) DEFAULT NULL,
  `MsgTesouraria` longtext,
  `BloquearPag` int(11) DEFAULT NULL,
  `ExcecaoFinanceiro` int(11) DEFAULT NULL,
  `Hist_ResolucaoSE_Fund` int(11) DEFAULT NULL,
  `Hist_ResolucaoSE_Medio` int(11) DEFAULT NULL,
  `Comunidade` int(11) DEFAULT NULL,
  `VeiculoComunicacao` int(11) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `industriario` int(11) DEFAULT NULL,
  `dependente` int(11) DEFAULT NULL,
  `Cor_Raca` varchar(15) DEFAULT NULL,
  `gdae` int(11) DEFAULT NULL,
  `Reservista` varchar(20) DEFAULT NULL,
  `ReservistaSerie` varchar(10) DEFAULT NULL,
  `Titulo` varchar(13) DEFAULT NULL,
  `TituloZona` varchar(4) DEFAULT NULL,
  `TituloSecao` varchar(4) DEFAULT NULL,
  `TelefoneCelular` varchar(30) DEFAULT NULL,
  `CodCandidato` varchar(6) DEFAULT NULL,
  `LetivoCandidato` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alunos_old`
--

DROP TABLE IF EXISTS `alunos_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos_old` (
  `ID` int(11) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `TelefoneAlu` varchar(15) DEFAULT NULL,
  `Sexo` int(11) DEFAULT NULL,
  `Nac` varchar(15) DEFAULT NULL,
  `Natuc` varchar(30) DEFAULT NULL,
  `Natue` varchar(2) DEFAULT NULL,
  `RG` varchar(15) DEFAULT NULL,
  `CIC` varchar(18) DEFAULT NULL,
  `CERTN` varchar(18) DEFAULT NULL,
  `Endr` varchar(50) DEFAULT NULL,
  `Endb` varchar(15) DEFAULT NULL,
  `Endc` varchar(30) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `Ende` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `NomeP` varchar(40) DEFAULT NULL,
  `NacP` varchar(15) DEFAULT NULL,
  `EmpP` varchar(25) DEFAULT NULL,
  `TelEmpP` varchar(15) DEFAULT NULL,
  `EndP` varchar(40) DEFAULT NULL,
  `TelP` varchar(15) DEFAULT NULL,
  `CelP` varchar(15) DEFAULT NULL,
  `EmailP` varchar(50) DEFAULT NULL,
  `RGP` varchar(15) DEFAULT NULL,
  `ProfP` varchar(30) DEFAULT NULL,
  `DtNascP` datetime DEFAULT NULL,
  `CPFP` varchar(18) DEFAULT NULL,
  `Nomem` varchar(40) DEFAULT NULL,
  `Nacm` varchar(15) DEFAULT NULL,
  `Empm` varchar(25) DEFAULT NULL,
  `Endm` varchar(40) DEFAULT NULL,
  `Telm` varchar(15) DEFAULT NULL,
  `Celm` varchar(15) DEFAULT NULL,
  `DtNascM` datetime DEFAULT NULL,
  `Emailm` varchar(50) DEFAULT NULL,
  `CPFM` varchar(18) DEFAULT NULL,
  `TelEmpM` varchar(15) DEFAULT NULL,
  `ProfM` varchar(30) DEFAULT NULL,
  `RgM` varchar(15) DEFAULT NULL,
  `Desp` varchar(40) DEFAULT NULL,
  `Situa` varchar(1) DEFAULT NULL,
  `dtEnt` datetime DEFAULT NULL,
  `dtNas` datetime DEFAULT NULL,
  `dtMat` datetime DEFAULT NULL,
  `AlunoMora` int(11) DEFAULT NULL,
  `QuemMora` varchar(50) DEFAULT NULL,
  `SairSozinho` int(11) DEFAULT NULL,
  `VemEscola` int(11) DEFAULT NULL,
  `AlergMedic` int(11) DEFAULT NULL,
  `Alergico` varchar(50) DEFAULT NULL,
  `Medico` int(11) DEFAULT NULL,
  `NomeMedico` varchar(30) DEFAULT NULL,
  `EndeMedico` varchar(40) DEFAULT NULL,
  `TelMedico` varchar(15) DEFAULT NULL,
  `DCongenita` int(11) DEFAULT NULL,
  `Congenita` varchar(50) DEFAULT NULL,
  `Hipertensao` int(11) DEFAULT NULL,
  `DefFisico` int(11) DEFAULT NULL,
  `DefVisual` int(11) DEFAULT NULL,
  `Diabetico` int(11) DEFAULT NULL,
  `Liemofilico` int(11) DEFAULT NULL,
  `Asmatico` int(11) DEFAULT NULL,
  `Epiletico` int(11) DEFAULT NULL,
  `DepInsulina` int(11) DEFAULT NULL,
  `Caxumba` int(11) DEFAULT NULL,
  `Sarampo` int(11) DEFAULT NULL,
  `Escarlatina` int(11) DEFAULT NULL,
  `Rubeola` int(11) DEFAULT NULL,
  `Catapora` int(11) DEFAULT NULL,
  `Coqueluche` int(11) DEFAULT NULL,
  `Tratamento` int(11) DEFAULT NULL,
  `Medicamento` int(11) DEFAULT NULL,
  `OutrasDoencas` varchar(50) DEFAULT NULL,
  `OutrasDInfantil` varchar(50) DEFAULT NULL,
  `QuandoDInfantil` varchar(50) DEFAULT NULL,
  `TxtTratamento` varchar(50) DEFAULT NULL,
  `IngerindoMedicamento` int(11) DEFAULT NULL,
  `TxtIngerindoMedicamento` varchar(50) DEFAULT NULL,
  `PlanoSaude` int(11) DEFAULT NULL,
  `TxtPlanoSaude` varchar(30) DEFAULT NULL,
  `HospitalClinica` varchar(40) DEFAULT NULL,
  `EnderecoHospitalClinica` varchar(40) DEFAULT NULL,
  `TelefoneHospitalClinica` varchar(15) DEFAULT NULL,
  `PessAutoC0L1` varchar(30) DEFAULT NULL,
  `PessAutoC0L2` varchar(30) DEFAULT NULL,
  `PessAutoC0L3` varchar(30) DEFAULT NULL,
  `PessAutoC1L1` varchar(30) DEFAULT NULL,
  `PessAutoC1L2` varchar(30) DEFAULT NULL,
  `PessAutoC1L3` varchar(30) DEFAULT NULL,
  `Religiao` varchar(30) DEFAULT NULL,
  `ColegioAnterior` varchar(40) DEFAULT NULL,
  `UltimaSerie` varchar(20) DEFAULT NULL,
  `ColAnteriorCidade` varchar(20) DEFAULT NULL,
  `ColAnteriorUF` varchar(2) DEFAULT NULL,
  `OndeLocal` varchar(30) DEFAULT NULL,
  `OutroLocal` int(11) DEFAULT NULL,
  `TratMedico` int(11) DEFAULT NULL,
  `MedicEspec` int(11) DEFAULT NULL,
  `OutrasD` int(11) DEFAULT NULL,
  `QualMedic` varchar(50) DEFAULT NULL,
  `EndMedico` varchar(50) DEFAULT NULL,
  `QuaisDCongenita` varchar(50) DEFAULT NULL,
  `QuandoOutDoen` varchar(30) DEFAULT NULL,
  `QuaisTratMedico` varchar(30) DEFAULT NULL,
  `QuaisMedicEspec` varchar(30) DEFAULT NULL,
  `QualPlanoSaude` varchar(40) DEFAULT NULL,
  `TelHospitalClinica` varchar(20) DEFAULT NULL,
  `EndHospitalClinica` varchar(30) DEFAULT NULL,
  `NomeResp` varchar(40) DEFAULT NULL,
  `TelefoneResp` varchar(15) DEFAULT NULL,
  `TelefoneCelResp` varchar(15) DEFAULT NULL,
  `CPFResp` varchar(14) DEFAULT NULL,
  `RGResp` varchar(20) DEFAULT NULL,
  `EndeResp` varchar(50) DEFAULT NULL,
  `ProfissaoResp` varchar(20) DEFAULT NULL,
  `EmpresaResp` varchar(50) DEFAULT NULL,
  `TelefoneEmpResp` varchar(15) DEFAULT NULL,
  `EMailResp` varchar(50) DEFAULT NULL,
  `Responsavel` varchar(1) DEFAULT NULL,
  `TipoSanguineo` varchar(10) DEFAULT NULL,
  `DataSaida` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alunostransferidos`
--

DROP TABLE IF EXISTS `alunostransferidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunostransferidos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anosletivos`
--

DROP TABLE IF EXISTS `anosletivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anosletivos` (
  `ID` int(11) DEFAULT NULL,
  `AnoLetivo` varchar(15) DEFAULT NULL,
  `AnoAnterior` varchar(15) DEFAULT NULL,
  `AnoPosterior` varchar(15) DEFAULT NULL,
  `transferiualunos` int(11) DEFAULT NULL,
  `NumPeriodos` int(11) DEFAULT NULL,
  `Metodologia` varchar(20) DEFAULT NULL,
  `NomePeriodo` varchar(20) DEFAULT NULL,
  `Abreviacao` varchar(10) DEFAULT NULL,
  `Letra` varchar(1) DEFAULT NULL,
  `MesInicioParc` int(11) DEFAULT NULL,
  `AnoInicioParc` int(11) DEFAULT NULL,
  `Supletivo` int(11) DEFAULT NULL,
  `Descricao` varchar(4) DEFAULT NULL,
  `AulasRecuperacao` int(11) DEFAULT NULL,
  `TipoBoletim` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arredondamento`
--

DROP TABLE IF EXISTS `arredondamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arredondamento` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atrasos`
--

DROP TABLE IF EXISTS `atrasos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atrasos` (
  `id` int(11) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Bimestre` varchar(1) DEFAULT NULL,
  `Atraso` int(11) DEFAULT NULL,
  `HoraEntrada` datetime DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aulasdadas`
--

DROP TABLE IF EXISTS `aulasdadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aulasdadas` (
  `Letivo` varchar(15) DEFAULT NULL,
  `classe` varchar(4) DEFAULT NULL,
  `bimestre` varchar(1) DEFAULT NULL,
  `disciplina` varchar(3) DEFAULT NULL,
  `AulasDadas` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aulasdadasaluno`
--

DROP TABLE IF EXISTS `aulasdadasaluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aulasdadasaluno` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `bimestre` varchar(1) DEFAULT NULL,
  `disciplina` varchar(3) DEFAULT NULL,
  `AulasDadas` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliacoes` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `Bimestre` int(11) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `pv1` double DEFAULT NULL,
  `pv2` double DEFAULT NULL,
  `pv3` double DEFAULT NULL,
  `pv4` double DEFAULT NULL,
  `pv5` double DEFAULT NULL,
  `tb1` double DEFAULT NULL,
  `tb2` double DEFAULT NULL,
  `tb3` double DEFAULT NULL,
  `tb4` double DEFAULT NULL,
  `tb5` double DEFAULT NULL,
  `Alterado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimestres`
--

DROP TABLE IF EXISTS `bimestres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimestres` (
  `ID` int(11) DEFAULT NULL,
  `Ano` varchar(15) DEFAULT NULL,
  `Bimestre` int(11) DEFAULT NULL,
  `Inicio` datetime DEFAULT NULL,
  `Fim` datetime DEFAULT NULL,
  `Diario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `boletos`
--

DROP TABLE IF EXISTS `boletos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boletos` (
  `Numero` varchar(7) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Mat` varchar(6) DEFAULT NULL,
  `Familia` int(11) DEFAULT NULL,
  `Conta` int(11) DEFAULT NULL,
  `Instrucoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `boletoscancelados`
--

DROP TABLE IF EXISTS `boletoscancelados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boletoscancelados` (
  `Id` int(11) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `familia` int(11) DEFAULT NULL,
  `Conta` int(11) DEFAULT NULL,
  `DataVencimento` datetime DEFAULT NULL,
  `DataCancelado` datetime DEFAULT NULL,
  `usuario` varchar(5) DEFAULT NULL,
  `motivo` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `candidatos`
--

DROP TABLE IF EXISTS `candidatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidatos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Inscricao` varchar(10) DEFAULT NULL,
  `Nome` varchar(60) DEFAULT NULL,
  `Sexo` varchar(1) DEFAULT NULL,
  `Curso` varchar(2) DEFAULT NULL,
  `Serie` varchar(2) DEFAULT NULL,
  `Turno` varchar(1) DEFAULT NULL,
  `Telefone1` varchar(25) DEFAULT NULL,
  `Telefone2` varchar(25) DEFAULT NULL,
  `DtNascimento` datetime DEFAULT NULL,
  `DtInscricao` datetime DEFAULT NULL,
  `NomePai` varchar(60) DEFAULT NULL,
  `NomeMae` varchar(60) DEFAULT NULL,
  `Contato` varchar(60) DEFAULT NULL,
  `Endereco` varchar(80) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Cidade` varchar(20) DEFAULT NULL,
  `Estado` varchar(2) DEFAULT NULL,
  `CEP` varchar(8) DEFAULT NULL,
  `MsgTesouraria` longtext,
  `Responsavel` varchar(50) DEFAULT NULL,
  `RG` varchar(15) DEFAULT NULL,
  `Nacionalidade` varchar(15) DEFAULT NULL,
  `CidadeNasc` varchar(15) DEFAULT NULL,
  `EstadoNasc` varchar(2) DEFAULT NULL,
  `CPFMae` varchar(15) DEFAULT NULL,
  `CPFPai` varchar(15) DEFAULT NULL,
  `CPFResp` varchar(15) DEFAULT NULL,
  `RGMae` varchar(15) DEFAULT NULL,
  `RGPai` varchar(15) DEFAULT NULL,
  `RGResp` varchar(15) DEFAULT NULL,
  `Observacoes` longtext,
  `email` varchar(50) DEFAULT NULL,
  `emailresp` varchar(50) DEFAULT NULL,
  `tiporesp` int(11) DEFAULT NULL,
  `VeiculoComunicacao` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cartas`
--

DROP TABLE IF EXISTS `cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartas` (
  `codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(40) DEFAULT NULL,
  `Conteudo` longtext,
  `FormatoRTF` int(11) DEFAULT NULL,
  `MarqSup` double DEFAULT NULL,
  `MargInf` double DEFAULT NULL,
  `MargEsq` double DEFAULT NULL,
  `MargDir` double DEFAULT NULL,
  `negrito` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cccusto`
--

DROP TABLE IF EXISTS `cccusto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cccusto` (
  `codigocc` varchar(10) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `Sintetico` int(11) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `classe1`
--

DROP TABLE IF EXISTS `classe1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classe1` (
  `Letivo` varchar(4) DEFAULT NULL,
  `Codigo` varchar(4) DEFAULT NULL,
  `Curso` varchar(2) DEFAULT NULL,
  `Serie` varchar(1) DEFAULT NULL,
  `Turma` varchar(5) DEFAULT NULL,
  `Turno` varchar(1) DEFAULT NULL,
  `QtdT` int(11) DEFAULT NULL,
  `QtdA` int(11) DEFAULT NULL,
  `Professor` varchar(50) DEFAULT NULL,
  `Sala` varchar(10) DEFAULT NULL,
  `localizacao` varchar(30) DEFAULT NULL,
  `info` longtext,
  `UsarTextoAno` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coc_xml`
--

DROP TABLE IF EXISTS `coc_xml`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coc_xml` (
  `j1` varchar(3) DEFAULT NULL,
  `j2` varchar(3) DEFAULT NULL,
  `mt1` varchar(3) DEFAULT NULL,
  `mt2` varchar(3) DEFAULT NULL,
  `pre` varchar(3) DEFAULT NULL,
  `ano1` varchar(3) DEFAULT NULL,
  `s_j1` varchar(3) DEFAULT NULL,
  `s_j2` varchar(3) DEFAULT NULL,
  `s_mt1` varchar(3) DEFAULT NULL,
  `s_mt2` varchar(3) DEFAULT NULL,
  `s_pre` varchar(3) DEFAULT NULL,
  `s_ano1` varchar(3) DEFAULT NULL,
  `e1` varchar(3) DEFAULT NULL,
  `e2` varchar(3) DEFAULT NULL,
  `e3` varchar(3) DEFAULT NULL,
  `e4` varchar(3) DEFAULT NULL,
  `e5` varchar(3) DEFAULT NULL,
  `e6` varchar(3) DEFAULT NULL,
  `e7` varchar(3) DEFAULT NULL,
  `e8` varchar(3) DEFAULT NULL,
  `s_e1` varchar(3) DEFAULT NULL,
  `s_e2` varchar(3) DEFAULT NULL,
  `s_e3` varchar(3) DEFAULT NULL,
  `s_e4` varchar(3) DEFAULT NULL,
  `s_e5` varchar(3) DEFAULT NULL,
  `s_e6` varchar(3) DEFAULT NULL,
  `s_e7` varchar(3) DEFAULT NULL,
  `s_e8` varchar(3) DEFAULT NULL,
  `m1` varchar(3) DEFAULT NULL,
  `m2` varchar(3) DEFAULT NULL,
  `m3` varchar(3) DEFAULT NULL,
  `s_m1` varchar(3) DEFAULT NULL,
  `s_m2` varchar(3) DEFAULT NULL,
  `s_m3` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `colegios`
--

DROP TABLE IF EXISTS `colegios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colegios` (
  `ID` int(11) DEFAULT NULL,
  `Matricula` varchar(8) DEFAULT NULL,
  `Curso` varchar(3) DEFAULT NULL,
  `Serie` varchar(2) DEFAULT NULL,
  `Ano` int(11) DEFAULT NULL,
  `Colegio` varchar(60) DEFAULT NULL,
  `Municipio` varchar(50) DEFAULT NULL,
  `Estado` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comprasprevisaopag`
--

DROP TABLE IF EXISTS `comprasprevisaopag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprasprevisaopag` (
  `NumPedido` int(11) DEFAULT NULL,
  `NumPag` int(11) DEFAULT NULL,
  `DtVenc` datetime DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Documento` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comprasproduto`
--

DROP TABLE IF EXISTS `comprasproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprasproduto` (
  `NumPedido` int(11) DEFAULT NULL,
  `CodFornecedor` int(11) DEFAULT NULL,
  `DataEmissao` datetime DEFAULT NULL,
  `Usuario` varchar(3) DEFAULT NULL,
  `Observacoes` longtext,
  `NumParcelas` int(11) DEFAULT NULL,
  `DataEntrega` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conceitos`
--

DROP TABLE IF EXISTS `conceitos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conceitos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `CodCriterio` int(11) DEFAULT NULL,
  `NumItem` int(11) DEFAULT NULL,
  `NotaInicial` double DEFAULT NULL,
  `NotaFinal` double DEFAULT NULL,
  `Conceito` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `Letivo` varchar(4) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Ende` varchar(40) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `CEP` varchar(9) DEFAULT NULL,
  `Bairro` varchar(30) DEFAULT NULL,
  `Cid` varchar(25) DEFAULT NULL,
  `Est` varchar(2) DEFAULT NULL,
  `ProxMat` varchar(6) DEFAULT NULL,
  `CamFoto` varchar(255) DEFAULT NULL,
  `MediaDispensa` varchar(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `TipoBoletim` int(11) DEFAULT NULL,
  `Site` varchar(50) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `Textohistorico1` varchar(100) DEFAULT NULL,
  `Textohistorico2` varchar(100) DEFAULT NULL,
  `LeiHistorico` varchar(100) DEFAULT NULL,
  `secretaria` varchar(50) DEFAULT NULL,
  `RG_Secretaria` varchar(30) DEFAULT NULL,
  `diretor` varchar(50) DEFAULT NULL,
  `Reg_Mec_Diretor` varchar(30) DEFAULT NULL,
  `RG_Diretor` varchar(30) DEFAULT NULL,
  `textofinalhistorico` varchar(50) DEFAULT NULL,
  `MaiorFalta` int(11) DEFAULT NULL,
  `ObsHistorico` longtext,
  `ordemnumeracao` int(11) DEFAULT NULL,
  `diretoriopadraoetiqueta` varchar(255) DEFAULT NULL,
  `cornomecarteirinha` int(11) DEFAULT NULL,
  `CNPJ` varchar(20) DEFAULT NULL,
  `ContaCaixa` int(11) DEFAULT NULL,
  `Complemento` varchar(30) DEFAULT NULL,
  `hist_subtotalch` int(11) DEFAULT NULL,
  `BoletimNumDisciplinas` int(11) DEFAULT NULL,
  `BoletimPrimLinha` int(11) DEFAULT NULL,
  `BoletimAbrevCurso` int(11) DEFAULT NULL,
  `BoletimLinhas` int(11) DEFAULT NULL,
  `BoletimColunas` int(11) DEFAULT NULL,
  `registro_secretaria` varchar(30) DEFAULT NULL,
  `TelaBaixa` int(11) DEFAULT NULL,
  `CodBaixa` int(11) DEFAULT NULL,
  `SeqMovCaixa` int(11) DEFAULT NULL,
  `TextoDeclaracaoFreqPag` longtext,
  `MostraPagAnterior` int(11) DEFAULT NULL,
  `MensagemBoleto` longtext,
  `portaboletim` varchar(20) DEFAULT NULL,
  `AnoArquivo` varchar(15) DEFAULT NULL,
  `AutMatricula` int(11) DEFAULT NULL,
  `TextoLivro` varchar(200) DEFAULT NULL,
  `DescontoVencimento` int(11) DEFAULT NULL,
  `Mantenedor` varchar(80) DEFAULT NULL,
  `ImpCodBarra` int(11) DEFAULT NULL,
  `FaltasDiscPrim` int(11) DEFAULT NULL,
  `Hist_Religioso` int(11) DEFAULT NULL,
  `DiversificadaAta` int(11) DEFAULT NULL,
  `VencParcelas` int(11) DEFAULT NULL,
  `NomeSupervisora` varchar(70) DEFAULT NULL,
  `Linha1Supervisora` varchar(70) DEFAULT NULL,
  `Linha2Supervisora` varchar(70) DEFAULT NULL,
  `GravaRegistry` int(11) DEFAULT NULL,
  `UltRecibo` int(11) DEFAULT NULL,
  `TitFont_Nome` varchar(50) DEFAULT NULL,
  `TitFont_Tamanho` int(11) DEFAULT NULL,
  `TitFont_Cor` int(11) DEFAULT NULL,
  `TitFont_Estilo` int(11) DEFAULT NULL,
  `NumRemessa` int(11) DEFAULT NULL,
  `UltAlteracaoACADESC` int(11) DEFAULT NULL,
  `UltAlteracaoFinanc` int(11) DEFAULT NULL,
  `AjustaLogo` int(11) DEFAULT NULL,
  `JurosDia` double DEFAULT NULL,
  `Multa` double DEFAULT NULL,
  `NomeFantasia` varchar(50) DEFAULT NULL,
  `InscEstadual` varchar(20) DEFAULT NULL,
  `Telefone2` varchar(20) DEFAULT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `Contato` varchar(30) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL,
  `CorNomeColegio` int(11) DEFAULT NULL,
  `MostraSituacaoBol` int(11) DEFAULT NULL,
  `SexoDiretor` varchar(1) DEFAULT NULL,
  `PassagemReserva` int(11) DEFAULT NULL,
  `PassagemMatricula` int(11) DEFAULT NULL,
  `TransfereParcelas` int(11) DEFAULT NULL,
  `TransfereDescontos` int(11) DEFAULT NULL,
  `VencimentoReserva` datetime DEFAULT NULL,
  `valorReserva` double DEFAULT NULL,
  `DiaVencPadrao` int(11) DEFAULT NULL,
  `VerificarSituacaoPassagem` int(11) DEFAULT NULL,
  `TransferirNaMatricula` int(11) DEFAULT NULL,
  `TransferirNaReserva` int(11) DEFAULT NULL,
  `ExibirNome` int(11) DEFAULT NULL,
  `TipoBoleto` varchar(1) DEFAULT NULL,
  `MediaFinalRec` int(11) DEFAULT NULL,
  `MostrarSitAprovado` int(11) DEFAULT NULL,
  `CapitularNome` int(11) DEFAULT NULL,
  `ResolucaoSE_Padrao` int(11) DEFAULT NULL,
  `PrefixoUsuarioSite` varchar(10) DEFAULT NULL,
  `CodBarraCarteirinha` int(11) DEFAULT NULL,
  `hisFont_Nome` varchar(50) DEFAULT NULL,
  `hisFont_Tamanho` int(11) DEFAULT NULL,
  `hisFont_Cor` int(11) DEFAULT NULL,
  `hisFont_Estilo` int(11) DEFAULT NULL,
  `caminholibwin` varchar(100) DEFAULT NULL,
  `TituloBaseComum` varchar(60) DEFAULT NULL,
  `TituloParteDiversificada` varchar(50) DEFAULT NULL,
  `DirCopiaSeguranca` varchar(255) DEFAULT NULL,
  `ExibiSiteBoletim` int(11) DEFAULT NULL,
  `CamFotoProfessores` varchar(255) DEFAULT NULL,
  `NivelSuperior` int(11) DEFAULT NULL,
  `Mostrar_Situacao_Por_Disciplina` int(11) DEFAULT NULL,
  `dataentrada` int(11) DEFAULT NULL,
  `dispfalta` int(11) DEFAULT NULL,
  `MostraFiliacao` int(11) DEFAULT NULL,
  `CargaHorariaHistorico` int(11) DEFAULT NULL,
  `ArredondamentoDiario` int(11) DEFAULT NULL,
  `OutrosAta` int(11) DEFAULT NULL,
  `EnderecoRazao` int(11) DEFAULT NULL,
  `TipoExportLibwin` int(11) DEFAULT NULL,
  `LeiHistoricoFund9` varchar(100) DEFAULT NULL,
  `SerieFaltasGeral` int(11) DEFAULT NULL,
  `UsarTextoAno` int(11) DEFAULT NULL,
  `TextoAno_AnoLimite` varchar(15) DEFAULT NULL,
  `UltimaCHVEnviado` varchar(30) DEFAULT NULL,
  `FilhasAta` int(11) DEFAULT NULL,
  `TipoDispensaNaoExibir` varchar(4) DEFAULT NULL,
  `Transferencia_9anos_8anos` varchar(1) DEFAULT NULL,
  `OutrosEstados` int(11) DEFAULT NULL,
  `SE_EnsFund` varchar(50) DEFAULT NULL,
  `SE_EnsMed` varchar(50) DEFAULT NULL,
  `2profaula` int(11) DEFAULT NULL,
  `GravaAulasRecup` int(11) DEFAULT NULL,
  `DiarioNovo` int(11) DEFAULT NULL,
  `TracosCampoemBrancoBoletim` int(11) DEFAULT NULL,
  `MediaPeriodoBol` int(11) DEFAULT NULL,
  `DescAprovado` varchar(20) DEFAULT NULL,
  `DescAprovConsel` varchar(20) DEFAULT NULL,
  `DescReprovado` varchar(20) DEFAULT NULL,
  `DescRecuperacao` varchar(20) DEFAULT NULL,
  `DescDependencia` varchar(20) DEFAULT NULL,
  `MediaFinalBol` int(11) DEFAULT NULL,
  `ExibirOBSSitFinal` int(11) DEFAULT NULL,
  `ClasseObrigatoria` int(11) DEFAULT NULL,
  `RecParalelaGrafico` int(11) DEFAULT NULL,
  `ObsConteudoProgramatico` int(11) DEFAULT NULL,
  `ValidarNotasFechadas` int(11) DEFAULT NULL,
  `MovArqRetorno` int(11) DEFAULT NULL,
  `IncluirMat` int(11) DEFAULT NULL,
  `VencMat` datetime DEFAULT NULL,
  `DescricaoReserva` varchar(80) DEFAULT NULL,
  `TransfereDiaVencimento` int(11) DEFAULT NULL,
  `UsarAutenticacao` int(11) DEFAULT NULL,
  `EventoVendas` int(11) DEFAULT NULL,
  `TurmaCandidatos` varchar(5) DEFAULT NULL,
  `UsarTabPrecos` int(11) DEFAULT NULL,
  `ImprimirObsRecibo` int(11) DEFAULT NULL,
  `MostraDescontoDetalhe` int(11) DEFAULT NULL,
  `InscricaoMunicipal` varchar(8) DEFAULT NULL,
  `CodigoServicoPrestado` varchar(5) DEFAULT NULL,
  `AliqISS` int(11) DEFAULT NULL,
  `SeqNFB` int(11) DEFAULT NULL,
  `NaoImpCodBarraCarne` int(11) DEFAULT NULL,
  `ReciboCupom` int(11) DEFAULT NULL,
  `MesVigente` int(11) DEFAULT NULL,
  `ConfirmaBoleto` int(11) DEFAULT NULL,
  `MoedaSingular` varchar(30) DEFAULT NULL,
  `MoedaPlural` varchar(30) DEFAULT NULL,
  `ContaCorrenteObrig` int(11) DEFAULT NULL,
  `AlteraDataCaixa` int(11) DEFAULT NULL,
  `Permitepagdtfutura` int(11) DEFAULT NULL,
  `avencer` int(11) DEFAULT NULL,
  `capitularboleto` int(11) DEFAULT NULL,
  `obs_planopag` int(11) DEFAULT NULL,
  `calcJurosDtCaixa` int(11) DEFAULT NULL,
  `verficarPagamentos` int(11) DEFAULT NULL,
  `hisendfont_nome` varchar(50) DEFAULT NULL,
  `hisendfont_Tamanho` int(11) DEFAULT NULL,
  `hisendfont_Cor` int(11) DEFAULT NULL,
  `hisendfont_Estilo` int(11) DEFAULT NULL,
  `hisendfont_CaixaAlta` int(11) DEFAULT NULL,
  `UtilizarDependencia` int(11) DEFAULT NULL,
  `FormulasPorUsuario` int(11) DEFAULT NULL,
  `alterarConta` int(11) DEFAULT NULL,
  `AgruparPagamentos` int(11) DEFAULT NULL,
  `VerificarImpFamilia` int(11) DEFAULT NULL,
  `ListFreqNovoLayout` int(11) DEFAULT NULL,
  `ExibirNomeUsuario` int(11) DEFAULT NULL,
  `NotaMediaRecDiario` int(11) DEFAULT NULL,
  `TruncarNotaDiscPai` int(11) DEFAULT NULL,
  `ConfigTelaRPS` varchar(80) DEFAULT NULL,
  `AlterarJurosDescCaixa` int(11) DEFAULT NULL,
  `ImpRecLancto` int(11) DEFAULT NULL,
  `CaixaPorAluno` int(11) DEFAULT NULL,
  `CaixaPorCandidato` int(11) DEFAULT NULL,
  `CaixaPorNossoNumero` int(11) DEFAULT NULL,
  `CaixaPorFamilia` int(11) DEFAULT NULL,
  `CaixaConsultaPlano` int(11) DEFAULT NULL,
  `CaixaDesmembramento` int(11) DEFAULT NULL,
  `SimboloUniMonetaria` varchar(4) DEFAULT NULL,
  `ConsultaVisualizaAluno` int(11) DEFAULT NULL,
  `Diario_DestacarRepetentes` int(11) DEFAULT NULL,
  `crBranca` varchar(50) DEFAULT NULL,
  `crPreta` varchar(50) DEFAULT NULL,
  `crParda` varchar(50) DEFAULT NULL,
  `crAmarela` varchar(50) DEFAULT NULL,
  `crIndigena` varchar(50) DEFAULT NULL,
  `crNaoDeclarada` varchar(50) DEFAULT NULL,
  `ftpHost` varchar(50) DEFAULT NULL,
  `ftpLogin` varchar(50) DEFAULT NULL,
  `ftpSenha` varchar(50) DEFAULT NULL,
  `ftpDiretorio` varchar(50) DEFAULT NULL,
  `ftpTipoExp` int(11) DEFAULT NULL,
  `CaixaAlinharTextoCupom` int(11) DEFAULT NULL,
  `Email_host` varchar(50) DEFAULT NULL,
  `Email_UserName` varchar(50) DEFAULT NULL,
  `Email_EMailAddresses` varchar(50) DEFAULT NULL,
  `Email_Address` varchar(50) DEFAULT NULL,
  `Email_Port` varchar(5) DEFAULT NULL,
  `Email_Name` varchar(50) DEFAULT NULL,
  `Email_Password` varchar(50) DEFAULT NULL,
  `pag_Matricula` int(11) DEFAULT NULL,
  `pag_Parcela` int(11) DEFAULT NULL,
  `pag_Evento` int(11) DEFAULT NULL,
  `pag_Reserva` int(11) DEFAULT NULL,
  `pag_Renegociacao` int(11) DEFAULT NULL,
  `pag_Vendas` int(11) DEFAULT NULL,
  `pag_pagparcial` int(11) DEFAULT NULL,
  `RecuperacaoFIAP` int(11) DEFAULT NULL,
  `recup_paralela` int(11) DEFAULT NULL,
  `pag_antsomenteprest` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configcamposboletim`
--

DROP TABLE IF EXISTS `configcamposboletim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configcamposboletim` (
  `Campo` int(11) DEFAULT NULL,
  `Esquerda` int(11) DEFAULT NULL,
  `Topo` int(11) DEFAULT NULL,
  `Tamanho` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configjuros`
--

DROP TABLE IF EXISTS `configjuros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configjuros` (
  `Letivo` varchar(15) DEFAULT NULL,
  `DiaInicial` int(11) DEFAULT NULL,
  `DiaFinal` int(11) DEFAULT NULL,
  `Multa` double DEFAULT NULL,
  `Juros` double DEFAULT NULL,
  `correcao` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configrecibo`
--

DROP TABLE IF EXISTS `configrecibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configrecibo` (
  `Nome_X` int(11) DEFAULT NULL,
  `Mat_X` int(11) DEFAULT NULL,
  `Classe_X` int(11) DEFAULT NULL,
  `CidadeData_X` int(11) DEFAULT NULL,
  `NomePai_X` int(11) DEFAULT NULL,
  `NomeMae_X` int(11) DEFAULT NULL,
  `Descricao_X` int(11) DEFAULT NULL,
  `ValorPago_X` int(11) DEFAULT NULL,
  `Observacao_X` int(11) DEFAULT NULL,
  `Extenso1_X` int(11) DEFAULT NULL,
  `Extenso2_X` int(11) DEFAULT NULL,
  `Nome_Y` int(11) DEFAULT NULL,
  `Mat_Y` int(11) DEFAULT NULL,
  `Classe_Y` int(11) DEFAULT NULL,
  `CidadeData_Y` int(11) DEFAULT NULL,
  `NomePai_Y` int(11) DEFAULT NULL,
  `NomeMae_Y` int(11) DEFAULT NULL,
  `Descricao_Y` int(11) DEFAULT NULL,
  `ValorPago_Y` int(11) DEFAULT NULL,
  `Observacao_Y` int(11) DEFAULT NULL,
  `Extenso1_Y` int(11) DEFAULT NULL,
  `Extenso2_Y` int(11) DEFAULT NULL,
  `Nome_Tam` int(11) DEFAULT NULL,
  `Mat_Tam` int(11) DEFAULT NULL,
  `Classe_Tam` int(11) DEFAULT NULL,
  `CidadeData_Tam` int(11) DEFAULT NULL,
  `NomePai_Tam` int(11) DEFAULT NULL,
  `NomeMae_Tam` int(11) DEFAULT NULL,
  `Descricao_Tam` int(11) DEFAULT NULL,
  `ValorPago_Tam` int(11) DEFAULT NULL,
  `Observacao_Tam` int(11) DEFAULT NULL,
  `Extenso1_Tam` int(11) DEFAULT NULL,
  `Extenso2_Tam` int(11) DEFAULT NULL,
  `Nome_Imp` int(11) DEFAULT NULL,
  `Mat_Imp` int(11) DEFAULT NULL,
  `Classe_Imp` int(11) DEFAULT NULL,
  `CidadeData_Imp` int(11) DEFAULT NULL,
  `NomePai_Imp` int(11) DEFAULT NULL,
  `NomeMae_Imp` int(11) DEFAULT NULL,
  `Descricao_Imp` int(11) DEFAULT NULL,
  `ValorPago_Imp` int(11) DEFAULT NULL,
  `Observacao_Imp` int(11) DEFAULT NULL,
  `Extenso1_Imp` int(11) DEFAULT NULL,
  `Extenso2_Imp` int(11) DEFAULT NULL,
  `Linhas` int(11) DEFAULT NULL,
  `Colunas` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configserieshistorico`
--

DROP TABLE IF EXISTS `configserieshistorico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configserieshistorico` (
  `Mat` varchar(10) DEFAULT NULL,
  `Serie` varchar(2) DEFAULT NULL,
  `TipoTermo` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conselho`
--

DROP TABLE IF EXISTS `conselho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conselho` (
  `id` int(11) DEFAULT NULL,
  `Matricula` varchar(8) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `AlterarMedia` int(11) DEFAULT NULL,
  `AlterarSituacao` int(11) DEFAULT NULL,
  `AlterarMed1ia` int(11) DEFAULT NULL,
  `Media` double DEFAULT NULL,
  `Mostrarsit_Conselho` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contas`
--

DROP TABLE IF EXISTS `contas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(30) DEFAULT NULL,
  `Agencia` varchar(10) DEFAULT NULL,
  `DigAgencia` varchar(1) DEFAULT NULL,
  `Conta` varchar(11) DEFAULT NULL,
  `DigConta` varchar(1) DEFAULT NULL,
  `CodCedente` varchar(20) DEFAULT NULL,
  `DigCodCedente` varchar(1) DEFAULT NULL,
  `NumBanco` varchar(3) DEFAULT NULL,
  `NomeCliente` varchar(30) DEFAULT NULL,
  `Carteira` varchar(10) DEFAULT NULL,
  `TipoRegPos` int(11) DEFAULT NULL,
  `TipoRegTam` int(11) DEFAULT NULL,
  `DataPagTipo` varchar(10) DEFAULT NULL,
  `DataPagPos` int(11) DEFAULT NULL,
  `DataPagTam` int(11) DEFAULT NULL,
  `OcorrenciaTipo` varchar(10) DEFAULT NULL,
  `OcorrenciaPos` int(11) DEFAULT NULL,
  `OcorrenciaTam` int(11) DEFAULT NULL,
  `NumBoletoTipo` varchar(10) DEFAULT NULL,
  `NumBoletoPos` int(11) DEFAULT NULL,
  `NumBoletoTam` int(11) DEFAULT NULL,
  `ValorRecTipo` varchar(10) DEFAULT NULL,
  `ValorRecPos` int(11) DEFAULT NULL,
  `ValorRecTam` int(11) DEFAULT NULL,
  `DirRetorno` varchar(250) DEFAULT NULL,
  `Ocorrenciabaixa` varchar(20) DEFAULT NULL,
  `ControleTipo` varchar(5) DEFAULT NULL,
  `ControlePos` int(11) DEFAULT NULL,
  `ControleTam` int(11) DEFAULT NULL,
  `FormatoCNAB` int(11) DEFAULT NULL,
  `CodCarteira` varchar(1) DEFAULT NULL,
  `TaxaBoleto` double DEFAULT NULL,
  `CodConvenio` varchar(20) DEFAULT NULL,
  `NomeCedenteNaViaSacado` int(11) DEFAULT NULL,
  `Extensao` varchar(3) DEFAULT NULL,
  `ProximoArqRemessa` int(11) DEFAULT NULL,
  `DistribuicaoBoleto` int(11) DEFAULT NULL,
  `controletipoPos` int(11) DEFAULT NULL,
  `controletipoTam` int(11) DEFAULT NULL,
  `NumeroContrato` varchar(15) DEFAULT NULL,
  `ContaCaixa` varchar(1) DEFAULT NULL,
  `layout` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contato1`
--

DROP TABLE IF EXISTS `contato1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contato1` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contato2`
--

DROP TABLE IF EXISTS `contato2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contato2` (
  `Codigo` int(11) DEFAULT NULL,
  `Contato` int(11) DEFAULT NULL,
  `Titulo` varchar(40) DEFAULT NULL,
  `Descricao` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS `contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contatos` (
  `Id` int(11) DEFAULT NULL,
  `Mat` varchar(50) DEFAULT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Detalhes` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conteudoprog`
--

DROP TABLE IF EXISTS `conteudoprog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudoprog` (
  `ID` int(11) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `CodClasse` varchar(3) DEFAULT NULL,
  `DataInicial` datetime DEFAULT NULL,
  `DataFinal` datetime DEFAULT NULL,
  `Conteudo` longtext,
  `c_prof` int(11) DEFAULT NULL,
  `c_dis` varchar(3) DEFAULT NULL,
  `ObsConteudo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cotacaomoeda`
--

DROP TABLE IF EXISTS `cotacaomoeda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotacaomoeda` (
  `codigo` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `criteriopadrao`
--

DROP TABLE IF EXISTS `criteriopadrao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteriopadrao` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Criterio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `criterios`
--

DROP TABLE IF EXISTS `criterios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterios` (
  `Codigo` int(11) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `Descricao` varchar(50) DEFAULT NULL,
  `PesoBim1` int(11) DEFAULT NULL,
  `PesoBim2` int(11) DEFAULT NULL,
  `PesoBim3` int(11) DEFAULT NULL,
  `PesoBim4` int(11) DEFAULT NULL,
  `PesoRecuperacao` int(11) DEFAULT NULL,
  `CalculoRecuperacao` varchar(1) DEFAULT NULL,
  `NotaCorte` double DEFAULT NULL,
  `ArredMediaBim` int(11) DEFAULT NULL,
  `ArredMediaFinal` int(11) DEFAULT NULL,
  `LimiteRecuperacao` int(11) DEFAULT NULL,
  `Decimais` int(11) DEFAULT NULL,
  `NotaMaxima` int(11) DEFAULT NULL,
  `UsarExtensoMax` int(11) DEFAULT NULL,
  `UsarExtensoMin` int(11) DEFAULT NULL,
  `FrequenciaGlobalMinima` double DEFAULT NULL,
  `CalculoNotaFinal` varchar(1) DEFAULT NULL,
  `ConsiderarRecuperacaoMenor` int(11) DEFAULT NULL,
  `DecimaisMedia` int(11) DEFAULT NULL,
  `CalculoRecBim` int(11) DEFAULT NULL,
  `NotaCorteRec` double DEFAULT NULL,
  `CalculoRecSem` int(11) DEFAULT NULL,
  `LimiteDependencia` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `criterioseries`
--

DROP TABLE IF EXISTS `criterioseries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterioseries` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Curso` varchar(3) DEFAULT NULL,
  `Serie` varchar(1) DEFAULT NULL,
  `Criterio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `Codigo` varchar(2) DEFAULT NULL,
  `Descri` varchar(30) DEFAULT NULL,
  `ProxCur` varchar(2) DEFAULT NULL,
  `Series` varchar(15) DEFAULT NULL,
  `Abreviacao` varchar(6) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `ModeloHistorico` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dadosmedicos`
--

DROP TABLE IF EXISTS `dadosmedicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dadosmedicos` (
  `Mat` varchar(8) DEFAULT NULL,
  `Alergico` int(11) DEFAULT NULL,
  `QualAlergia` varchar(80) DEFAULT NULL,
  `TipoMedico` int(11) DEFAULT NULL,
  `NomeMedico` varchar(60) DEFAULT NULL,
  `EnderecoMedico` varchar(100) DEFAULT NULL,
  `TelefoneMedico` varchar(30) DEFAULT NULL,
  `PossuiDoencaCongenita` int(11) DEFAULT NULL,
  `QualDoencaCongenita` varchar(50) DEFAULT NULL,
  `Hipertensao` int(11) DEFAULT NULL,
  `Hemofilia` int(11) DEFAULT NULL,
  `DeficienciaFisica` int(11) DEFAULT NULL,
  `DeficienciaVisual` int(11) DEFAULT NULL,
  `Asma` int(11) DEFAULT NULL,
  `Epilepsia` int(11) DEFAULT NULL,
  `Convulsao` int(11) DEFAULT NULL,
  `Diabete` int(11) DEFAULT NULL,
  `DependeInsulina` int(11) DEFAULT NULL,
  `Caxumba` int(11) DEFAULT NULL,
  `Sarampo` int(11) DEFAULT NULL,
  `Escarlatina` int(11) DEFAULT NULL,
  `Rubeola` int(11) DEFAULT NULL,
  `Catapora` int(11) DEFAULT NULL,
  `Coqueluche` int(11) DEFAULT NULL,
  `OutrasDoencas` varchar(70) DEFAULT NULL,
  `FazTratamento` int(11) DEFAULT NULL,
  `QualTratamento` varchar(80) DEFAULT NULL,
  `AcompFonoaudiologico` int(11) DEFAULT NULL,
  `AcompPsicologico` int(11) DEFAULT NULL,
  `OutrosAcompanhamentos` varchar(80) DEFAULT NULL,
  `IngerindoMedicacao` int(11) DEFAULT NULL,
  `QualMedicacao` varchar(80) DEFAULT NULL,
  `PossuiPlanoSaude` int(11) DEFAULT NULL,
  `QualPlanoSaude` varchar(80) DEFAULT NULL,
  `NomeHospital` varchar(80) DEFAULT NULL,
  `EnderecoHospital` varchar(100) DEFAULT NULL,
  `TelefoneHospital` varchar(20) DEFAULT NULL,
  `TipoSanguineo` varchar(10) DEFAULT NULL,
  `Bronquite` int(11) DEFAULT NULL,
  `AcompMedico` int(11) DEFAULT NULL,
  `RemedioFebre` varchar(150) DEFAULT NULL,
  `Pode_Medicar` int(11) DEFAULT NULL,
  `Observacoes_Med` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dadosresponsaveis`
--

DROP TABLE IF EXISTS `dadosresponsaveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dadosresponsaveis` (
  `Mat` varchar(8) DEFAULT NULL,
  `NomePai` varchar(60) DEFAULT NULL,
  `DtNascimentoPai` datetime DEFAULT NULL,
  `NacionalidadePai` varchar(20) DEFAULT NULL,
  `TelefonePai` varchar(20) DEFAULT NULL,
  `CelularPai` varchar(20) DEFAULT NULL,
  `CPFPai` varchar(18) DEFAULT NULL,
  `RGPai` varchar(15) DEFAULT NULL,
  `EnderecoPai` varchar(80) DEFAULT NULL,
  `ProfissaoPai` varchar(50) DEFAULT NULL,
  `EmpresaPai` varchar(30) DEFAULT NULL,
  `TelEmpresaPai` varchar(20) DEFAULT NULL,
  `EmailPai` varchar(150) DEFAULT NULL,
  `NomeMae` varchar(60) DEFAULT NULL,
  `DtNascimentoMae` datetime DEFAULT NULL,
  `NacionalidadeMae` varchar(20) DEFAULT NULL,
  `TelefoneMae` varchar(20) DEFAULT NULL,
  `CelularMae` varchar(20) DEFAULT NULL,
  `CPFMae` varchar(18) DEFAULT NULL,
  `RGMae` varchar(15) DEFAULT NULL,
  `EnderecoMae` varchar(80) DEFAULT NULL,
  `ProfissaoMae` varchar(50) DEFAULT NULL,
  `EmpresaMae` varchar(30) DEFAULT NULL,
  `TelEmpresaMae` varchar(20) DEFAULT NULL,
  `Emailmae` varchar(150) DEFAULT NULL,
  `NomeResp` varchar(60) DEFAULT NULL,
  `DtNascimentoResp` datetime DEFAULT NULL,
  `NacionalidadeResp` varchar(20) DEFAULT NULL,
  `TelefoneResp` varchar(20) DEFAULT NULL,
  `CelularResp` varchar(20) DEFAULT NULL,
  `CPFResp` varchar(18) DEFAULT NULL,
  `RGResp` varchar(15) DEFAULT NULL,
  `EnderecoResp` varchar(80) DEFAULT NULL,
  `ProfissaoResp` varchar(50) DEFAULT NULL,
  `EmpresaResp` varchar(30) DEFAULT NULL,
  `TelEmpresaResp` varchar(20) DEFAULT NULL,
  `EmailResp` varchar(50) DEFAULT NULL,
  `NomeConj` varchar(40) DEFAULT NULL,
  `DtNascimentoConj` datetime DEFAULT NULL,
  `NacionalidadeConj` varchar(20) DEFAULT NULL,
  `TelefoneConj` varchar(20) DEFAULT NULL,
  `CelularConj` varchar(20) DEFAULT NULL,
  `ProfissaoConj` varchar(50) DEFAULT NULL,
  `EmpresaConj` varchar(30) DEFAULT NULL,
  `TelEmpresaConj` varchar(20) DEFAULT NULL,
  `EmailConj` varchar(50) DEFAULT NULL,
  `EstadoCivilPais` int(11) DEFAULT NULL,
  `NovaUniao` int(11) DEFAULT NULL,
  `Responsavel` int(11) DEFAULT NULL,
  `SexoResp` varchar(1) DEFAULT NULL,
  `ParentescoResp` varchar(30) DEFAULT NULL,
  `BairroPai` varchar(40) DEFAULT NULL,
  `CidadePai` varchar(40) DEFAULT NULL,
  `UFPai` varchar(40) DEFAULT NULL,
  `CEPPai` varchar(40) DEFAULT NULL,
  `BairroMae` varchar(40) DEFAULT NULL,
  `CidadeMae` varchar(40) DEFAULT NULL,
  `UFMae` varchar(40) DEFAULT NULL,
  `CEPMae` varchar(40) DEFAULT NULL,
  `BairroResp` varchar(40) DEFAULT NULL,
  `CidadeResp` varchar(40) DEFAULT NULL,
  `UFResp` varchar(40) DEFAULT NULL,
  `CEPResp` varchar(40) DEFAULT NULL,
  `ResponsavelPedagogico` int(11) DEFAULT NULL,
  `NomeRespPed` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dataeventos`
--

DROP TABLE IF EXISTS `dataeventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataeventos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Parcela` int(11) DEFAULT NULL,
  `Vencimento` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dbcep`
--

DROP TABLE IF EXISTS `dbcep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dbcep` (
  `CODCEP` varchar(9) DEFAULT NULL,
  `LOCAL` varchar(125) DEFAULT NULL,
  `TIPO` varchar(10) DEFAULT NULL,
  `BAIRRO` varchar(60) DEFAULT NULL,
  `BAIRRO2` varchar(60) DEFAULT NULL,
  `CIDADE` varchar(60) DEFAULT NULL,
  `ESTADO` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dependencia`
--

DROP TABLE IF EXISTS `dependencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependencia` (
  `Mat` varchar(10) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `LetivoDisciplina` varchar(15) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `Observacoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diario`
--

DROP TABLE IF EXISTS `diario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diario` (
  `Letivo` varchar(15) DEFAULT NULL,
  `CodClasse` varchar(3) DEFAULT NULL,
  `Periodo` varchar(2) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `NotasFechadas` int(11) DEFAULT NULL,
  `AulasPrevistas` int(11) DEFAULT NULL,
  `observacoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diasuteis`
--

DROP TABLE IF EXISTS `diasuteis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diasuteis` (
  `c_id` int(11) DEFAULT NULL,
  `c_data` datetime DEFAULT NULL,
  `c_motivo` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disciplina1`
--

DROP TABLE IF EXISTS `disciplina1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina1` (
  `Codigo` varchar(3) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Tipo` varchar(1) DEFAULT NULL,
  `Suple` int(11) DEFAULT NULL,
  `Sigla` varchar(5) DEFAULT NULL,
  `Reprova` int(11) DEFAULT NULL,
  `Historico` int(11) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `TipoComposicao` varchar(1) DEFAULT NULL,
  `DisciplinaPai` varchar(3) DEFAULT NULL,
  `CalculoComp` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disciplina2`
--

DROP TABLE IF EXISTS `disciplina2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina2` (
  `Curso` varchar(2) DEFAULT NULL,
  `Serie` varchar(1) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `Carga` int(11) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `Ordem` int(11) DEFAULT NULL,
  `Habilitacao` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dispensa`
--

DROP TABLE IF EXISTS `dispensa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispensa` (
  `id` int(11) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Bim` varchar(4) DEFAULT NULL,
  `tipo` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dividajuridico`
--

DROP TABLE IF EXISTS `dividajuridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dividajuridico` (
  `Codigo` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `ValorDivida` double DEFAULT NULL,
  `NumParcelas` int(11) DEFAULT NULL,
  `Encerrada` int(11) DEFAULT NULL,
  `Observacoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente` (
  `C_REG` int(11) DEFAULT NULL,
  `C_ALMOCO_FIM` varchar(4) DEFAULT NULL,
  `C_ALMOCO_INI` varchar(4) DEFAULT NULL,
  `C_BAIR` varchar(20) DEFAULT NULL,
  `C_CDNAS` varchar(20) DEFAULT NULL,
  `C_CELULAR` varchar(20) DEFAULT NULL,
  `C_CEP` varchar(8) DEFAULT NULL,
  `C_CIC` varchar(16) DEFAULT NULL,
  `C_CIDA` varchar(30) DEFAULT NULL,
  `C_CTPS` varchar(15) DEFAULT NULL,
  `C_DIS` varchar(20) DEFAULT NULL,
  `C_DTADM` datetime DEFAULT NULL,
  `C_DTDEM` datetime DEFAULT NULL,
  `C_DTEXP` datetime DEFAULT NULL,
  `C_EMAIL` varchar(40) DEFAULT NULL,
  `C_ENDE` varchar(40) DEFAULT NULL,
  `C_FONE` varchar(20) DEFAULT NULL,
  `C_FONE2` varchar(20) DEFAULT NULL,
  `C_FORMA` varchar(2) DEFAULT NULL,
  `C_HABMEC` varchar(70) DEFAULT NULL,
  `C_INTER_MANHA_FIM` varchar(4) DEFAULT NULL,
  `C_INTER_MANHA_INI` varchar(4) DEFAULT NULL,
  `C_INTER_TARDE_FIM` varchar(4) DEFAULT NULL,
  `C_INTER_TARDE_INI` varchar(4) DEFAULT NULL,
  `C_MOTDEM` varchar(40) DEFAULT NULL,
  `C_NAC` varchar(15) DEFAULT NULL,
  `C_NASC` datetime DEFAULT NULL,
  `C_NOME` varchar(40) DEFAULT NULL,
  `C_NOMEM` varchar(40) DEFAULT NULL,
  `C_NOMEP` varchar(40) DEFAULT NULL,
  `C_ORI` varchar(40) DEFAULT NULL,
  `C_ORIGEM` varchar(6) DEFAULT NULL,
  `C_PER_DOM` varchar(1) DEFAULT NULL,
  `C_PER_QUA` varchar(1) DEFAULT NULL,
  `C_PER_QUI` varchar(1) DEFAULT NULL,
  `C_PER_SAB` varchar(1) DEFAULT NULL,
  `C_PER_SEG` varchar(1) DEFAULT NULL,
  `C_PER_SEX` varchar(1) DEFAULT NULL,
  `C_PER_TER` varchar(1) DEFAULT NULL,
  `C_PERPDR` varchar(1) DEFAULT NULL,
  `C_PROF` varchar(30) DEFAULT NULL,
  `C_REGMEC` varchar(9) DEFAULT NULL,
  `C_RG` varchar(15) DEFAULT NULL,
  `C_SECAO` varchar(4) DEFAULT NULL,
  `C_SERIE` varchar(1) DEFAULT NULL,
  `C_SEXO` varchar(1) DEFAULT NULL,
  `C_STATUS` varchar(1) DEFAULT NULL,
  `C_TIPO` int(11) DEFAULT NULL,
  `C_TIT` varchar(13) DEFAULT NULL,
  `C_UF` varchar(2) DEFAULT NULL,
  `C_UFNAS` varchar(2) DEFAULT NULL,
  `C_ZONA` varchar(4) DEFAULT NULL,
  `C_usuario` varchar(30) DEFAULT NULL,
  `c_SENHA` varchar(10) DEFAULT NULL,
  `Usuario` int(11) DEFAULT NULL,
  `C_OBS` longtext,
  `codbanco` varchar(4) DEFAULT NULL,
  `agencia` varchar(6) DEFAULT NULL,
  `contacorrente` varchar(12) DEFAULT NULL,
  `Estadocivil` int(11) DEFAULT NULL,
  `FuncionarioPossuiAlergia` int(11) DEFAULT NULL,
  `FuncionarioPossuiAlergiaQuais` varchar(100) DEFAULT NULL,
  `FuncionarioPossuiDoencaCongenita` int(11) DEFAULT NULL,
  `FuncionarioPossuiDoencaCongenitaQuais` varchar(100) DEFAULT NULL,
  `Hipertensao` int(11) DEFAULT NULL,
  `Asma` int(11) DEFAULT NULL,
  `Convulsao` int(11) DEFAULT NULL,
  `Bronquite` int(11) DEFAULT NULL,
  `Diabete` int(11) DEFAULT NULL,
  `DepInsulina` int(11) DEFAULT NULL,
  `OutrasDoencas` varchar(100) DEFAULT NULL,
  `FazendoAlgumTratamentoMedico` int(11) DEFAULT NULL,
  `FazendoAlgumTratamentoMedicoQuais` varchar(100) DEFAULT NULL,
  `IngerindoMedicacaoEspecifica` int(11) DEFAULT NULL,
  `IngerindoMedicacaoEspecificaQuais` varchar(100) DEFAULT NULL,
  `TipoSanguineo` varchar(3) DEFAULT NULL,
  `ObsMedicas` longtext,
  `C_PIS` varchar(25) DEFAULT NULL,
  `C_dependentes` longtext,
  `C_ValeTrans` int(11) DEFAULT NULL,
  `RD` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docprofessores`
--

DROP TABLE IF EXISTS `docprofessores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docprofessores` (
  `codDoc` int(11) DEFAULT NULL,
  `Descricao` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Obrigatorio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentosalunos`
--

DROP TABLE IF EXISTS `documentosalunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentosalunos` (
  `CodDocumento` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentosseries`
--

DROP TABLE IF EXISTS `documentosseries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentosseries` (
  `CodDocumento` int(11) DEFAULT NULL,
  `Curso` varchar(3) DEFAULT NULL,
  `Serie` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `especializacao`
--

DROP TABLE IF EXISTS `especializacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especializacao` (
  `C_CODIGO` varchar(3) DEFAULT NULL,
  `C_DESCRI` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(30) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Parcelas` int(11) DEFAULT NULL,
  `Desconto` int(11) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `FilhoFuncionario` int(11) DEFAULT NULL,
  `VencMensalidades` int(11) DEFAULT NULL,
  `MesPrimeiroVenc` int(11) DEFAULT NULL,
  `AnoPrimeiroVenc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `familia`
--

DROP TABLE IF EXISTS `familia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familia` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Responsavel` varchar(50) DEFAULT NULL,
  `Endereco` varchar(80) DEFAULT NULL,
  `Numero` varchar(20) DEFAULT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Cidade` varchar(40) DEFAULT NULL,
  `Estado` varchar(2) DEFAULT NULL,
  `CEP` varchar(9) DEFAULT NULL,
  `CPFResp` varchar(11) DEFAULT NULL,
  `JurosDia` double DEFAULT NULL,
  `Multa` double DEFAULT NULL,
  `JurosDiferenciado` int(11) DEFAULT NULL,
  `FamiliaInativa` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feriados`
--

DROP TABLE IF EXISTS `feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feriados` (
  `Data` datetime DEFAULT NULL,
  `Motivo` varchar(40) DEFAULT NULL,
  `bancario` int(11) DEFAULT NULL,
  `escolar` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formacao`
--

DROP TABLE IF EXISTS `formacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formacao` (
  `C_FORMA` varchar(2) DEFAULT NULL,
  `C_DESCRI` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formulas`
--

DROP TABLE IF EXISTS `formulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulas` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Texto` varchar(200) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Observacoes` longtext,
  `ContaD` varchar(9) DEFAULT NULL,
  `ContaC` varchar(9) DEFAULT NULL,
  `Logradouro` varchar(50) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Complemento` varchar(30) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Cidade` varchar(40) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `Contato` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequencia` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `Situacao` varchar(1) DEFAULT NULL,
  `Aula` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `Codigo` int(11) DEFAULT NULL,
  `NomeGrupo` varchar(30) DEFAULT NULL,
  `Acesso` longtext,
  `Acesso0` longtext,
  `Acesso1` longtext,
  `Acesso2` longtext,
  `Acesso3` longtext,
  `Acesso4` longtext,
  `Acesso5` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historico_fundamental`
--

DROP TABLE IF EXISTS `historico_fundamental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_fundamental` (
  `Matricula` varchar(8) DEFAULT NULL,
  `LetivoDisc` varchar(15) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Nota1` varchar(10) DEFAULT NULL,
  `Nota2` varchar(10) DEFAULT NULL,
  `Nota3` varchar(10) DEFAULT NULL,
  `Nota4` varchar(10) DEFAULT NULL,
  `Nota5` varchar(10) DEFAULT NULL,
  `Nota6` varchar(10) DEFAULT NULL,
  `Nota7` varchar(10) DEFAULT NULL,
  `Nota8` varchar(10) DEFAULT NULL,
  `Carga1` double DEFAULT NULL,
  `Carga2` double DEFAULT NULL,
  `Carga3` double DEFAULT NULL,
  `Carga4` double DEFAULT NULL,
  `Carga5` double DEFAULT NULL,
  `Carga6` double DEFAULT NULL,
  `Carga7` double DEFAULT NULL,
  `Carga8` double DEFAULT NULL,
  `Nota9` varchar(10) DEFAULT NULL,
  `Carga9` double DEFAULT NULL,
  `Ordem` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historico_medio`
--

DROP TABLE IF EXISTS `historico_medio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_medio` (
  `Matricula` varchar(8) DEFAULT NULL,
  `LetivoDisc` varchar(15) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Nota1` varchar(10) DEFAULT NULL,
  `Nota2` varchar(10) DEFAULT NULL,
  `Nota3` varchar(10) DEFAULT NULL,
  `Carga1` double DEFAULT NULL,
  `Carga2` double DEFAULT NULL,
  `Carga3` double DEFAULT NULL,
  `Ordem` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `Letivo` varchar(4) DEFAULT NULL,
  `Aula` varchar(1) DEFAULT NULL,
  `Dia` varchar(1) DEFAULT NULL,
  `Periodo` varchar(1) DEFAULT NULL,
  `Professor` varchar(4) DEFAULT NULL,
  `Curso` varchar(2) DEFAULT NULL,
  `Serie` varchar(1) DEFAULT NULL,
  `turma` varchar(5) DEFAULT NULL,
  `Disciplina` varchar(2) DEFAULT NULL,
  `Hora` varchar(5) DEFAULT NULL,
  `Outros` varchar(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `C_AULA` varchar(1) DEFAULT NULL,
  `C_CURSO` varchar(2) DEFAULT NULL,
  `C_DIA` int(11) DEFAULT NULL,
  `C_DIS` varchar(3) DEFAULT NULL,
  `C_HORA` varchar(5) DEFAULT NULL,
  `C_OUTROS` varchar(9) DEFAULT NULL,
  `C_PER` int(11) DEFAULT NULL,
  `C_PROF` int(11) DEFAULT NULL,
  `C_SERIE` varchar(1) DEFAULT NULL,
  `c_turma` varchar(5) DEFAULT NULL,
  `CodFormula` int(11) DEFAULT NULL,
  `TabArredondamento` int(11) DEFAULT NULL,
  `letivo` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `indicetr`
--

DROP TABLE IF EXISTS `indicetr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicetr` (
  `data` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itensarredondamento`
--

DROP TABLE IF EXISTS `itensarredondamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itensarredondamento` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Item` int(11) DEFAULT NULL,
  `NotaInicial` double DEFAULT NULL,
  `NotaFinal` double DEFAULT NULL,
  `Nota` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itenscompra`
--

DROP TABLE IF EXISTS `itenscompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itenscompra` (
  `NumPedido` int(11) DEFAULT NULL,
  `CodProduto` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `PrecoUnitario` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itenscriterio`
--

DROP TABLE IF EXISTS `itenscriterio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itenscriterio` (
  `Criterio` int(11) DEFAULT NULL,
  `Item` int(11) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `Campo` int(11) DEFAULT NULL,
  `FaixaInicial` double DEFAULT NULL,
  `FaixaFinal` double DEFAULT NULL,
  `Situacao` varchar(1) DEFAULT NULL,
  `Periodo` int(11) DEFAULT NULL,
  `DescricaoSituacao` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itensnf`
--

DROP TABLE IF EXISTS `itensnf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itensnf` (
  `Codigo` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `NumItem` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `Descricao` varchar(40) DEFAULT NULL,
  `Valor` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `itensvenda`
--

DROP TABLE IF EXISTS `itensvenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itensvenda` (
  `NumPedido` int(11) DEFAULT NULL,
  `CodProduto` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `Preco` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `maladireta`
--

DROP TABLE IF EXISTS `maladireta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maladireta` (
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(40) DEFAULT NULL,
  `conteudo` longtext,
  `FormatoRTF` int(11) DEFAULT NULL,
  `MarqSup` double DEFAULT NULL,
  `MargInf` double DEFAULT NULL,
  `MargEsq` double DEFAULT NULL,
  `MargDir` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `membrosfamilia`
--

DROP TABLE IF EXISTS `membrosfamilia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membrosfamilia` (
  `Familia` int(11) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moeda`
--

DROP TABLE IF EXISTS `moeda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moeda` (
  `codigo` int(11) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `simbolo` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movcaixa`
--

DROP TABLE IF EXISTS `movcaixa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movcaixa` (
  `Seq` int(11) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `Historico` varchar(100) DEFAULT NULL,
  `DataPagto` datetime DEFAULT NULL,
  `ValorTitulo` double DEFAULT NULL,
  `ValorPago` double DEFAULT NULL,
  `Estorno` int(11) DEFAULT NULL,
  `dataefetivacao` datetime DEFAULT NULL,
  `NumCheque` varchar(20) DEFAULT NULL,
  `NumRecibo` int(11) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimentocpag`
--

DROP TABLE IF EXISTS `movimentocpag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimentocpag` (
  `Seq` int(11) DEFAULT NULL,
  `Titulo` varchar(20) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `NumDocumento` varchar(20) DEFAULT NULL,
  `Conta` int(11) DEFAULT NULL,
  `Fornecedor` int(11) DEFAULT NULL,
  `DtEmissao` datetime DEFAULT NULL,
  `DtVencto` datetime DEFAULT NULL,
  `DtPagto` datetime DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Historico` varchar(100) DEFAULT NULL,
  `ValorPago` double DEFAULT NULL,
  `Observacoes` longtext,
  `DtProrrogacao` datetime DEFAULT NULL,
  `Contabilizado` int(11) DEFAULT NULL,
  `NumPedido` int(11) DEFAULT NULL,
  `CodigoCC` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msgboleto`
--

DROP TABLE IF EXISTS `msgboleto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msgboleto` (
  `id` int(11) DEFAULT NULL,
  `curso` varchar(3) DEFAULT NULL,
  `serie` varchar(2) DEFAULT NULL,
  `Turma` varchar(5) DEFAULT NULL,
  `mat` varchar(10) DEFAULT NULL,
  `DataInicio` datetime DEFAULT NULL,
  `DataFim` datetime DEFAULT NULL,
  `Exibir` int(11) DEFAULT NULL,
  `Mensagem` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notasdependencia`
--

DROP TABLE IF EXISTS `notasdependencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notasdependencia` (
  `ID` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `LetivoDisciplina` varchar(15) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `Letivo` varchar(15) DEFAULT NULL,
  `Bim` varchar(2) DEFAULT NULL,
  `Nota` double DEFAULT NULL,
  `Faltas` int(11) DEFAULT NULL,
  `AulasDadas` int(11) DEFAULT NULL,
  `NotaRecPeriodo` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notasfaltas`
--

DROP TABLE IF EXISTS `notasfaltas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notasfaltas` (
  `ID` int(11) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Bim` varchar(2) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL,
  `Nota` double DEFAULT NULL,
  `Falta` int(11) DEFAULT NULL,
  `atrasos` int(11) DEFAULT NULL,
  `NotaRecPeriodo` double DEFAULT NULL,
  `AulasDadas` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notasfechadas`
--

DROP TABLE IF EXISTS `notasfechadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notasfechadas` (
  `Letivo` varchar(15) DEFAULT NULL,
  `CodClasse` varchar(3) DEFAULT NULL,
  `Bim` varchar(2) DEFAULT NULL,
  `Disc` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notasfiscaisgravadas`
--

DROP TABLE IF EXISTS `notasfiscaisgravadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notasfiscaisgravadas` (
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(40) DEFAULT NULL,
  `NatOperacao` varchar(30) DEFAULT NULL,
  `TipoServico` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `observ`
--

DROP TABLE IF EXISTS `observ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observ` (
  `id` int(11) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Letivo` varchar(4) DEFAULT NULL,
  `Obs` longtext,
  `Bimestre` varchar(1) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Evento` int(11) DEFAULT NULL,
  `Parcela` int(11) DEFAULT NULL,
  `Descricao` varchar(60) DEFAULT NULL,
  `DtVenc` datetime DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `DtPagto` datetime DEFAULT NULL,
  `Juros` double DEFAULT NULL,
  `PercDesconto` double DEFAULT NULL,
  `Desconto` double DEFAULT NULL,
  `Conta` int(11) DEFAULT NULL,
  `NumBoleto` varchar(30) DEFAULT NULL,
  `Cheque` int(11) DEFAULT NULL,
  `NumCheque` varchar(20) DEFAULT NULL,
  `DataEfetivacao` datetime DEFAULT NULL,
  `candidato` int(11) DEFAULT NULL,
  `dataefetivação` datetime DEFAULT NULL,
  `seqbaixa` int(11) DEFAULT NULL,
  `Observacoes` longtext,
  `NumRecibo` int(11) DEFAULT NULL,
  `DataImpBoleto` datetime DEFAULT NULL,
  `CodAutenticacao` varchar(45) DEFAULT NULL,
  `CodDividaJuridico` int(11) DEFAULT NULL,
  `BloquearBoleto` int(11) DEFAULT NULL,
  `TaxaBoleto` double DEFAULT NULL,
  `UsuarioQueBaixou` varchar(3) DEFAULT NULL,
  `DataHoraBaixa` datetime DEFAULT NULL,
  `NumRecSerieB` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagamentosjuridico`
--

DROP TABLE IF EXISTS `pagamentosjuridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentosjuridico` (
  `CodDivida` int(11) DEFAULT NULL,
  `NumPagamento` int(11) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  `Descricao` varchar(100) DEFAULT NULL,
  `Valor` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pesoscriterio`
--

DROP TABLE IF EXISTS `pesoscriterio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesoscriterio` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Periodo` int(11) DEFAULT NULL,
  `Peso` int(11) DEFAULT NULL,
  `NotaMaxima` double DEFAULT NULL,
  `NotaCorte` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pessoasautorizadas`
--

DROP TABLE IF EXISTS `pessoasautorizadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoasautorizadas` (
  `Mat` varchar(8) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Parentesco` varchar(20) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `RG` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `planos`
--

DROP TABLE IF EXISTS `planos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Parcelas` int(11) DEFAULT NULL,
  `ValorMat` double DEFAULT NULL,
  `DtInicioParc` datetime DEFAULT NULL,
  `DtMatricula` datetime DEFAULT NULL,
  `InicioBolsa` datetime DEFAULT NULL,
  `FimBolsa` datetime DEFAULT NULL,
  `PercBolsa` double DEFAULT NULL,
  `DiaVencimento` int(11) DEFAULT NULL,
  `Preco` double DEFAULT NULL,
  `ValorParcela` double DEFAULT NULL,
  `MesInicioParc` int(11) DEFAULT NULL,
  `AnoInicioParc` int(11) DEFAULT NULL,
  `Observacoes` longtext,
  `PercBolsa2` double DEFAULT NULL,
  `PercBolsa3` double DEFAULT NULL,
  `InicioBolsa2` datetime DEFAULT NULL,
  `InicioBolsa3` datetime DEFAULT NULL,
  `FimBolsa2` datetime DEFAULT NULL,
  `FimBolsa3` datetime DEFAULT NULL,
  `VencParcela` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `planosdataseventos`
--

DROP TABLE IF EXISTS `planosdataseventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planosdataseventos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `Evento` int(11) DEFAULT NULL,
  `Parcela` int(11) DEFAULT NULL,
  `Vencimento` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `planoseventos`
--

DROP TABLE IF EXISTS `planoseventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planoseventos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Evento` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Parcelas` int(11) DEFAULT NULL,
  `VencMensalidades` int(11) DEFAULT NULL,
  `MesPrimeiroVenc` int(11) DEFAULT NULL,
  `AnoPrimeiroVenc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `precos`
--

DROP TABLE IF EXISTS `precos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descricao` varchar(30) DEFAULT NULL,
  `SerieInicial` int(11) DEFAULT NULL,
  `SerieFinal` int(11) DEFAULT NULL,
  `Turno` varchar(10) DEFAULT NULL,
  `Preco` double DEFAULT NULL,
  `ValorMatricula` double DEFAULT NULL,
  `MatInclusa` int(11) DEFAULT NULL,
  `CursoInicial` varchar(2) DEFAULT NULL,
  `CursoFinal` varchar(2) DEFAULT NULL,
  `ReciboMat` int(11) DEFAULT NULL,
  `ReciboPrest` int(11) DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `ReciboOutros` int(11) DEFAULT NULL,
  `Reserva` double DEFAULT NULL,
  `jurosmat` int(11) DEFAULT NULL,
  `jurosprest` int(11) DEFAULT NULL,
  `jurosoutros` int(11) DEFAULT NULL,
  `DescontoMatricula` double DEFAULT NULL,
  `ReciboJuridico` int(11) DEFAULT NULL,
  `JurosJuridico` int(11) DEFAULT NULL,
  `ValorReserva` double DEFAULT NULL,
  `QtdAnuidade` int(11) DEFAULT NULL,
  `CodigoCC` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `precosdataseventos`
--

DROP TABLE IF EXISTS `precosdataseventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precosdataseventos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `TabPreco` int(11) DEFAULT NULL,
  `Evento` int(11) DEFAULT NULL,
  `Parcela` int(11) DEFAULT NULL,
  `Vencimento` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `precoseventos`
--

DROP TABLE IF EXISTS `precoseventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precoseventos` (
  `Letivo` varchar(15) DEFAULT NULL,
  `TabPreco` int(11) DEFAULT NULL,
  `Evento` int(11) DEFAULT NULL,
  `Obrigatorio` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Parcelas` int(11) DEFAULT NULL,
  `VencMensalidades` int(11) DEFAULT NULL,
  `MesPrimeiroVenc` int(11) DEFAULT NULL,
  `AnoPrimeiroVenc` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `UnidadeMedida` varchar(5) DEFAULT NULL,
  `Saldo` int(11) DEFAULT NULL,
  `QtdMinima` int(11) DEFAULT NULL,
  `Preco` double DEFAULT NULL,
  `Fabricante` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profdocprofessores`
--

DROP TABLE IF EXISTS `profdocprofessores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profdocprofessores` (
  `codDoc` int(11) DEFAULT NULL,
  `codProfessor` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `situacaoaluno`
--

DROP TABLE IF EXISTS `situacaoaluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacaoaluno` (
  `Letivo` varchar(50) DEFAULT NULL,
  `Matricula` varchar(8) DEFAULT NULL,
  `Disciplina` varchar(3) DEFAULT NULL,
  `MediaBimestres` double DEFAULT NULL,
  `MediaFinal` double DEFAULT NULL,
  `Situacao` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tabfechacx`
--

DROP TABLE IF EXISTS `tabfechacx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabfechacx` (
  `DataCx` datetime DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `curso` varchar(2) DEFAULT NULL,
  `serie` varchar(1) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turmas` (
  `Letivo` varchar(4) DEFAULT NULL,
  `Codigo` varchar(4) DEFAULT NULL,
  `Mat` varchar(8) DEFAULT NULL,
  `Numero` varchar(3) DEFAULT NULL,
  `Situacao` varchar(1) DEFAULT NULL,
  `Suplementar` int(11) DEFAULT NULL,
  `TurmaOrigem` varchar(4) DEFAULT NULL,
  `TurmaDestino` varchar(4) DEFAULT NULL,
  `ColegioDestino` varchar(50) DEFAULT NULL,
  `DataTransferencia` datetime DEFAULT NULL,
  `Numeroorigem` varchar(3) DEFAULT NULL,
  `Numerodestino` varchar(3) DEFAULT NULL,
  `MotivoDesistencia` longtext,
  `DataDesistencia` datetime DEFAULT NULL,
  `Habilitacao` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ultimospagamentos`
--

DROP TABLE IF EXISTS `ultimospagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ultimospagamentos` (
  `codigo` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `Codigo` int(11) DEFAULT NULL,
  `Usuario` varchar(20) DEFAULT NULL,
  `Senha` varchar(10) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Iniciais` varchar(3) DEFAULT NULL,
  `Grupo` int(11) DEFAULT NULL,
  `AnoLetivo` varchar(4) DEFAULT NULL,
  `Rede` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `veiculoscomunicacao`
--

DROP TABLE IF EXISTS `veiculoscomunicacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculoscomunicacao` (
  `Codigo` int(11) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vendasproduto`
--

DROP TABLE IF EXISTS `vendasproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendasproduto` (
  `NumPedido` int(11) DEFAULT NULL,
  `Mat` varchar(10) DEFAULT NULL,
  `DataEmissao` datetime DEFAULT NULL,
  `NumPagamentos` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Observacoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'acadesc'
--
/*!50003 DROP PROCEDURE IF EXISTS `dadosAluno` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `dadosAluno`(_mat VARCHAR(6))
BEGIN
SELECT Nome, RA, RGAluno, DtNascimento, CidadeNasc, UfNasc, CEP, Bairro, Endereco
      , Cidade, UF, Nacionalidade,Telefone, Email, NomePai, NomeMae
      , NomeResp,DtNascimentoResp,RGResp,CPFResp,CEPResp,EnderecoResp,BairroResp
      , CidadeResp,UFResp,TelefoneResp,CelularResp,TelEmpresaResp,EmailResp,ParentescoResp
FROM Alunos 
     inner join DadosResponsaveis on Alunos.Mat = DadosResponsaveis.Mat
 where Alunos.Mat = _mat;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listaNomes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `listaNomes`(term varchar(255))
BEGIN
 Select Case Cursos.Codigo 
           WHEN '10' THEN Classe1.Serie+1
           WHEN '11' THEN Classe1.Serie + 1
           WHEN '12' THEN Classe1.Serie + 10
       ELSE 1 
       END as Classe, Alunos.Nome, Alunos.Mat, DadosResponsaveis.CPFResp
  from Turmas 
       inner join Classe1 on Turmas.Codigo = Classe1.Codigo and Turmas.letivo = Classe1.letivo
       inner join Alunos  on Turmas.Mat = Alunos.Mat
       inner join Cursos  on Cursos.Codigo = Classe1.Curso
       inner join DadosResponsaveis  on DadosResponsaveis.Mat = Alunos.Mat
where Turmas.letivo = '2012' 
  and Alunos.Nome like term;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-03 18:26:33
