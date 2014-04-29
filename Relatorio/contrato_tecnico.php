<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
require_once ('../Util/html2pdf/html2pdf.class.php');
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );

$data = strftime ( "%d de %B de %Y" );

$registro = $_SESSION ['dados_contrato'];
$contratante_nome = $registro ['resp_nome'];
$contratante_nacionalidade = $registro ['resp_nacionalidade'];
$contratante_estado_civil = $registro ['resp_estciv'];
$contratante_RG = $registro ['resp_RG'];
$contratante_CPF = $registro ['resp_cpf'];
$contratante_dtNasc = $registro ['resp_dNasc'];
$contratante_endereco = $registro ['resp_endereco'];
$contratante_cidade = $registro ['resp_cidade'];
$contratante_uf = $registro ['resp_uf'];
$contratante_CEP = $registro ['resp_cep'];
$aluno_nome = $registro ['aluno_nome'];
$aluno_serie = $registro ['cNmCurso'];
$aluno_turno = $registro ['cTurnoStr'];

$contrato_anuidade = number_format ( $registro ['nVlrCurso'], 2, ",", '.' );
$contrato_anuidade_str = extenso ( $registro ['nVlrCurso'], true );
$contrato_mensalidade = number_format ( $registro ['nVlrCurso'] / $registro ['nQtdParcAnuidade'], 2, ",", '.' );
$contrato_mensalidade_str = extenso ( $registro ['nVlrCurso'] / $registro ['nQtdParcAnuidade'], true );
$contrato_qtd_parc = $registro ['nQtdParcAnuidade'];
$contrato_qtd_parc_str = trim ( str_replace ( "reais", "", str_replace ( "real", "", extenso ( $contrato_qtd_parc ) ) ) );

$periodo_letivo_inicio = $registro ['cInicioLetivo'];
$periodo_letivo_fim = $registro ['cFimLetivo'];
/* */

$html = "
<html>
<head>
<style>
.titulo{ text-align:center;
font-weight: bold;
}
.destaque{ color:white;
background-color:black;
font-weight: bold;
}
.paragrafo{ text-align:justify;
margin-left:20px;
margin-right:20px;
margin-bottom:0px;
}

</style>
<meta charset='utf-8'>
</head>
<body>
<p class='titulo'>CONTRATO DE PRESTAÇÃO DE SERVIÇOS EDUCACIONAIS 2014</p>
<p class='paragrafo'><span class='destaque'>CONTRATANTE:</span> $contratante_nome,  $contratante_nacionalidade, $contratante_estado_civil. RG nº : $contratante_RG, CPF nº : $contratante_CPF, Data Nascimento: $contratante_dtNasc.Endereço : $contratante_endereco, Cidade $contratante_cidade - $contratante_uf, CEP $contratante_CEP</p>
<p class='paragrafo'><span class='destaque'>BENEFICIARIO:</span> $aluno_nome </p>
<p class='paragrafo'><span class='destaque'>CURSO / SERIE:</span> $aluno_serie </p>
<p class='paragrafo'><span class='destaque'>TURNO:</span> $aluno_turno </p>
<p class='paragrafo'>Por meio do presente instrumento particular, o Instituto Educacional Jr Ltda, pessoa jurídica de direito privado, CNPJ nº 07.228.276/0001-70, situado nesta cidade na Praça Narciso José Lopes, nº 138, Centro - Arujá-SP, entidade mantenedora do Athenas – Instituto de Educação, neste ato representada por seu representante legal, doravante designada simplesmente CONTRATADA, e, de outro lado, o(a) ALUNO(A), neste ato representado(a) por seu representante legal, acima qualificado, doravante designado apenas CONTRATANTE, têm, entre si, justo e acertado o presente Contrato Individual de prestação de serviços educacionais, considerando o que dispõem os artigos 1º,inciso IV,5º, inciso I,173, inciso IV, 206 incisos II e III e 209, todos da Constituição Federal; artigos 389,476 e 597 do Código Civil Brasileiro; da Lei nº 8.069/90(Estatuto da Criança e do Adolescente); da Lei 8.078/90(Código do Consumidor), Lei nº 8.880/94,Lei nº 9.069/95 e Lei 9.870/99 e Medida Provisória 2173/24 de 23.08.01, mediante cláusulas e condições a seguir especificadas e a cujo cumprimento se obrigam mutuamente:</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA PRIMEIRA – DO OBJETO</span><br/>
O objeto deste Contrato é a prestação de serviços educacionais ao aluno/beneficiário, indicado pelo(s) CONTRATANTE(s), referente ao período letivo de ­$periodo_letivo_inicio a$periodo_letivo_fim de acordo com o Projeto Político Pedagógico e Regimento Escolar da CONTRATADA..<br/>
<b>PARÁGRAFO PRIMEIRO</b> –  A CONTRATADA é uma Instituição Educacional, cuja missão é oferecer à comunidade em que atua educação integral efetiva para a formação de gerações mais felizes, éticas, participativas e transformadoras da realidade social de forma construtiva, sabendo utilizar adequadamente seus conhecimentos, aliados a seus talentos individuais, e socialmente preparados para a vida. Oferece uma educação que privilegia o desenvolvimento sistemático de competências cognitivas e de uma formação humana voltada para a construção de valores, destacando-se, entre eles, a autonomia, a solidariedade, a criticidade e a criatividade.<br/>
<b>PARÁGRAFO SEGUNDO</b> – A prestação dos serviços educacionais, objeto deste contrato, tem seu início na data da assinatura do mesmo e seu término no último dia letivo previsto no <b>semestre</b>.<br/>
<b>PARÁGRAFO TERCEIRO</b> – A CONTRATADA poderá alterar a seu critério o calendário escolar, respeitadas as exigências legais de carga horária e de dias letivos, devendo comunicar ao aluno (a) a ocorrência da alteração.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA PRIMEIRA – DO OBJETO</span><br/>
A CONTRATADA assegura ao(s) CONTRATANTE(s) uma vaga no seu corpo discente, a ser utilizada conforme os dados especificados no Requerimento de Matrícula, que passa a fazer parte integrante deste Contrato, em benefício de quem o CONTRATANTE indicar, ministrando a educação e o ensino por meio de aulas e demais atividades escolares cujo planejamento pedagógico atenda ao disposto na legislação em vigor.<br/>
<b>PARÁGRAFO PRIMEIRO</b> –  As aulas serão ministradas nas salas de aula ou locais que a CONTRATADA indicar, tendo em vista a natureza dos objetos de conhecimento e as metodologias que se fizerem necessárias.<br/>
<b>PARÁGRAFO SEGUNDO</b> –  É de exclusiva responsabilidade da CONTRATADA a orientação técnica, administrativa e pedagógica decorrente da prestação dos serviços educacionais, exemplificativamente, no que se refere à distribuição dos alunos nas turmas, marcação das avaliações de aprendizagem, fixação de carga horária, indicação de professores, coordenadores e orientadores educacionais, além de outras providências que as atividades docentes exigirem, obedecendo ao seu exclusivo critério, sem ingerência do CONTRATANTE.<br/>
<b>PARÁGRAFO TERCEIRO</b> – O CONTRATANTE fica desde já ciente de que a Contratada não dispõe ou indica transporte escolar, sendo a utilização deste de inteira responsabilidade do(s) CONTRATANTE(s).<br/>
<b>PARÁGRAFO QUARTO</b> –  A CONTRATADA se reserva o direito de extinguir e/ou não oferecer o curso objeto do presente contrato, na hipótese de não existência de, no mínimo, 20 (vinte) alunos matriculados, inclusive se houver bolsistas ou não.<br/>
<b>Inciso I </b>- Fica os CONTRATANTE(s)  ciente de que o aluno /beneficiário só poderá frequentar as dependências da escola em turno oposto à sua matrícula, mediante autorização prévia da CONTRATADA, não constituindo obrigação da mesma a cessão de espaço físico e/ou material didático-pedagógico para atividades extracurriculares fora do horário de prestação de serviços contratados.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA TERCEIRA - DA  PRESTAÇÃO DE SERVIÇOS DE EDUCAÇÃO INCLUSIVA</span><br/>
Os alunos com necessidades educativas especiais serão aceitos pela escola, fazendo com que as diferenças sejam reconhecidas e valorizadas, reforçando o respeito ao direito de todos.<br/>
<b>PARÁGRAFO PRIMEIRO</b> – O(s) CONTRATANTE(s), além do valor deste contrato pactuada, suportará todas as despesas adicionais para a educação inclusiva.<br/>
<b>PARÁGRAFO SEGUNDO</b> –Para a efetivação da matrícula, será observada a disponibilidade de vagas, por turma e horário, na forma prevista no Regimento Escolar da CONTRATADA.<br/>
<b>PARÁGRAFO TERCEIRO</b> – O requerimento de matrícula sujeita-se a deferimento expresso por parte da ESCOLA CONTRATADA, podendo esta indeferi-lo, no caso de aluno portador de  necessidades educacionais especiais, caso a ESCOLA entenda inadequado o ingresso ou a permanência do ALUNO, seja em virtude das limitações operacionais da ESCOLA, seja em virtude das limitações psicopedagógicas do ALUNO.<br/>
<b>PARÁGRAFO QUARTO</b> –  A CONTRATADA se reserva o direito de extinguir e/ou não oferecer o curso objeto do presente contrato, na hipótese de não existência de, no mínimo, 20 (vinte) alunos matriculados, inclusive se houver bolsistas ou não.<br/>
<b>PARÁGRAFO QUINTO</b> –  A CONTRATADA poderá promover, ainda, a alteração de turmas, classes, horários e períodos de aulas, Calendário Escolar ou outras medidas que por motivos administrativos e/ou pedagógicos se mostrarem necessários, a seu exclusivo critério, preservando os preceitos pedagógicos e legais pertinentes.<br/>
<b>PARÁGRAFO SEXTO</b> – Quando a necessidade especial for declarada pelo(s) CONTRATANTE(s), faz-se necessário que o mesmo apresente a avaliação psicodiagnóstica e/ou acompanhamento médico, psicológico ou psicopedagógico, assim como, o acompanhamento através de relatórios, no tempo hábil solicitado pelo Serviço de Orientação Educacional da Escola (CONTRATADA).<br/>
<b>PARÁGRAFO SETIMO</b> – Quando a necessidade especial não for declarada pelo(s) CONTRATANTE(s), e o discente apresentar alguma dificuldade de aprendizagem em seu processo educativo, cognitivo ou relacional (dentro do espaço da Escola), a família será comunicada para que procure profissionais da área de saúde, apresentando os devidos relatórios para acompanhamento específico, pela Escola.<br/>
<b>PARÁGRAFO OITAVO</b> – Fica o(s) CONTRATANTE(s) responsável (is) por promover (em) o contato com o profissional da área de saúde que esteja acompanhando diretamente o aluno com a escola, de modo que o mesmo possa orientar os profissionais da Instituição de Ensino de como acompanhar o educando, buscando um maior desenvolvimento social e cognitivo.<br/>
<b>PARÁGRAFO NONO</b> – É de responsabilidade do(s) CONTRATANTE(s), o acompanhamento extraescolar de todas as necessidades pessoais e especiais do aluno, que possam facilitar e colaborar com seu desenvolvimento..<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA QUARTA - DO VALOR DOS SERVIÇOS PRESTADOS</span><br/>
Como contraprestação pelos serviços educacionais prestados ao (a) aluno (a) indicado (a) pelo contratante, durante o período letivo previsto na clausula primeira, conforme previsto na cláusula segunda, o(s) CONTRATANTE(s)  pagará(m) à CONTRATADA, de acordo com o curso e carga horaria, o valor semestral de R$ $contrato_anuidade ($contrato_anuidade_str) , podendo ser pago em até $contrato_qtd_parc_str ($contrato_qtd_parc), parcelas mensais no valor de R$ $contrato_mensalidade  ($contrato_mensalidade_str).<br/>
<b>PARÁGRAFO PRIMEIRO</b> – Outras formas de pagamento do valor das parcelas, especificado no caput, poderão ser objeto de acerto entre as partes, inclusive para atender os casos de matrícula intempestivos, onde o valor integral da anuidade deve ser preservado.<br/>
<b>PARÁGRAFO SEGUNDO</b> – O valor da contraprestação acima pactuado poderá ser reajustado quando expressamente permitido por lei, bem como para preservar o equilíbrio contratual, caso qualquer mudança legislativa ou normativa altere a equação econômico-financeira do presente instrumento.<br/>
<b>PARÁGRAFO TERCEIRO</b> – A CONTRATADA, por mera liberalidade, poderá conceder descontos, a qualquer título, individual ou coletivamente, de forma contínua ou sobre determinada parcela específica, sobre valores devidos pelo(s) CONTRATANTE(s), o que não caracterizará novação, podendo, desta forma, esses descontos serem reduzidos ou cancelados, a qualquer tempo, a critério exclusivo da CONTRATADA.<br/>
<b>PARÁGRAFO QUARTO</b> – O(s) CONTRATANTE(s) possui (em) conhecimento prévio das condições financeiras deste Contrato, que foram expostas na secretaria deste estabelecimento de ensino, (Lei no 9.870/99), conhecendo-as e aceitando-as livremente.<br/>
<b>PARÁGRAFO QUINTO</b> – A CONTRATADA poderá sem prévio aviso transferir os direitos e obrigações deste instrumento para outra personalidade jurídica ou terceiros sem prévio aviso.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA QUINTA  - DAS FORMAS E CONDIÇÕES DE PAGAMENTO</span><br/>
O pagamento da primeira parcela do contrato deverá ser efetuado no ato da matrícula, que só será reconhecida como efetivada, após a assinatura do contrato de prestação de serviços educacionais, pela CONTRATADA, e tem caráter de sinal, arras e princípio de pagamento, razão pela qual não será devolvida, no todo ou em parte, no caso de desistência por parte do(s) CONTRATANTE(s), sendo imprescindível sua quitação para celebração e concretização do presente Contrato.<br/>
<b>PARÁGRAFO PRIMEIRO</b> – Os pagamentos das demais parcelas deverão ser efetuados até o 5º dia util de cada mês, a partir do mês de ­FEVEREIRO , nos locais indicados pela CONTRATADA.<br/>
<b>PARÁGRAFO SEGUNDO</b> – O pagamento efetuado após a data de vencimento será acrescido de multa no percentual de 2% (dois por cento) sobre o valor da prestação em atraso, mais correção monetária com base no IGPM ou outro índice que o substitua, a critério da escola, e juros de mora de 1% (um por cento) ao mês ou de 0,033%, por dia de atraso.<br/>
<b>PARÁGRAFO TERCEIRO</b> – O não comparecimento do (a) aluno (a) aos atos escolares ora contratados não o exime do pagamento, tendo em vista a disponibilidade do serviço colocado ao CONTRATANTE(s).<br/>
<b>PARÁGRAFO QUARTO</b> – Em caso de inadimplência ou atraso no pagamento das mensalidades, o(s) CONTRATANTE(s) perderá todo e qualquer desconto do qual seja eventualmente beneficiário.<br/>
<b>PARÁGRAFO QUINTO</b> – O pagamento das obrigações financeiras por parte do(s) CONTRATANTE(s) comprovar-se-á mediante apresentação do recibo ou carnê que individualize a obrigação quitada.<br/>
<b>PARÁGRAFO SEXTO</b> – Em caso de inadimplência superior a 30 (trinta) dias, em todos os cursos, serviços e taxas contratados, a CONTRATADA poderá inscrever o nome do(s) CONTRATANTE(s) em banco de dados cadastral (SCPC) e promover a cobrança judicial ou extrajudicial do débito, por si ou por meio de escritórios especializados e Cartório de Protestos de Títulos, sendo que nestes casos o(s) CONTRATANTE(s) inadimplente(s) responderá (m) também, por honorários a estes devidos, com iguais direitos à CONTRATADA frente às obrigações não cumpridas pelo(s) CONTRATANTE(s).<br/>
<b>PARAGRAFO SÉTIMO</b> – A CONTRATADA poderá utilizar dos meios de comunicação disponíveis para cobrança em caso de inadimplência, entre eles: Correspondência via correio. E-mail, Telefone fixo, Telefone Móvel e  SMS.<br/>
<b>PARÁGRAFO OITAVO</b> – A CONTRATADA, a seu juízo, em caso de inadimplência poderá propor a rescisão do presente Contrato, independentemente da exigibilidade do débito vencido e seus consectários previstos no<br/>
parágrafo segundo e demais ônus legais cabíveis, inclusive honorários advocatícios, custas e outras despesas processuais e de cobrança.<br/>
PARÁGRAFO NONO – A CONTRATADA poderá valer-se do contrato, apurada a inadimplência do(s) CONTRATANTE(s) e a efetiva prestação do serviço pela CONTRATADA, para emitir e, se for o caso, protestar duplicatas e letras de câmbio de prestação de serviços, tudo em conformidade com a legislação vigente.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA SEXTA – DA PRESTAÇÃO DE SERVIÇOS EDUCACIONAIS</span><br/>
Os valores da contraprestação acima pactuada satisfazem, exclusivamente, a prestação de serviços decorrentes da carga horária constante da proposta curricular do Curso Técnico da CONTRATADA e de seu calendário escolar.<br/>
<b>PARÁGRAFO PRIMEIRO</b> – Este Contrato não inclui o fornecimento de material didático, livros, apostilas, estudos de recuperação, cursos paralelos e outros serviços facultativos.<br/>
<b>PARÁGRAFO SEGUNDO</b> – Os serviços extraordinários efetivamente prestados ao (a) aluno (a), dos quais citamos exemplificativamente cursos opcionais, cursos avulsos, cursos específicos, cursos decorrentes do regime de progressão parcial do aluno, atendimento ao aluno especial, em decorrência de laudo médico ou psicopedagógico, atividades extraclasse, segunda chamada de provas, testes, exames, atividades de adaptação de estudos, segunda via de documentos: declarações, Carteira de Identificação Escolar; boletins de notas, Histórico Escolar, documentação de conclusão, seguro contra acidentes e transferência; serão cobrados à parte, independente dos valores ora contratados, os serviços extracurriculares e as taxas administrativas conforme descriminação à disposição na Secretaria da Escola.<br/>
<b>PARÁGRAFO TERCEIRO</b> – Não estão ainda incluídos neste contrato os serviços especiais de reforço, dependência, transporte escolar, o uniforme , a alimentação e o material didático de uso exclusivo do BENEFICIÁRIO.<br/>
<b>PARÁGRAFO QUARTO</b> – O(s) CONTRATANTE(s) declara(m) que teve conhecimento dos valores cobrados por esses serviços extraordinários, exceção feita ao atendimento especial cujo valor dependerá das providências a serem tomadas em decorrência do laudo apresentado e autoriza a integralização dos serviços extraordinários utilizados no valor da parcela do semestre desse Contrato e sua consequente cobrança.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA SÉTIMA-DO ATENDIMENTO MÉDICO HOSPITALAR.</span><br/>
Obriga-se o(s) CONTRATANTE(s) no ato da matrícula a indicar e autorizar por escrito o médico, a clínica ou o hospital que preferencialmente deverá ser encaminhando(a) o(a) aluno(a), em caso de emergência.<br/>
<b>PARÁGRAFO PRIMEIRO</b> –  Caso não ocorra o nexo causal, ou falha no cumprimento legal do dever de vigilância, o(s) CONTRATANTE(s) deverá(ão) responsabilizar-se pelas despesas que houver pelo atendimento.<br/>
<b>PARÁGRAFO SEGUNDO</b> – Nos casos em que o aluno utiliza medicamento prescrito a intervalos menores, a exemplo de homeopatia a escola não se responsabilizará em administrá-lo.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA OITAVA– DAS CONDIÇÕES PARA RESCISÃO DO CONTRATO</span><br/>
O presente instrumento poderá ser rescindido por iniciativa do(s) CONTRATANTE(s), mediante requerimento por escrito, junto à secretaria da CONTRATADA, com antecedência mínima de 90 (noventa) dias, configurando cancelamento da matrícula do curso regular e transferência do aluno, quando for o caso.<br/>
<b>PARÁGRAFO PRIMEIRO</b> – Para efetivação da rescisão de que trata esta cláusula, o(s) CONTRATANTE(s) deverá cumprir com todas as obrigações ora estabelecidas por este instrumento e com a cláusula quinta até o mês de rescisão, inclusive.<br/>
<b>PARÁGRAFO SEGUNDO</b> – No caso da não apresentação do requerimento previsto nesta cláusula, o Contrato continuará em vigor e o(s) CONTRATANTE(s) deverá(m) pagar todas as parcelas previstas neste Contrato, com os valores das parcelas devidamente atualizados.<br/>
<b>PARÁGRAFO TERCEIRO</b> – O pedido de cancelamento, desistência ou trancamento não será acatado se efetuado após o início da quarta unidade, salvo por motivo de transferência para outra cidade, período a partir da qual o Contrato deverá ser integralmente quitado para a sua rescisão.<br/>
<b>PARAGRAFO QUARTO</b> – No caso de rescisão antes do início das aulas , o CONTRATANTE tem o direito de reembolso de 76% ( SETENTA E SEIS POR CENTO) do valor pago, concordando desde já que os 24% (VINTE E QUATRO POR CENTO) retidos destinam-se ao custeio das atividades administrativas e operacionais.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA NONA  – DAS RESPONSABILIDADES QUANTO À MATRÍCULA E ÀS INFORMAÇÕES SOBRE A VIDA ESCOLAR DO ALUNO</span><br/>
Ao firmar este Contrato, o(s) CONTRATANTE(s) declara ter conhecimento prévio do Regimento Escolar, que passa a fazer parte integrante do presente Contrato, submetendo-se às suas disposições, e às do Manual do Aluno, bem como às demais obrigações constantes da legislação aplicável à área de ensino e, ainda, às emanadas de outras fontes legais, desde que regulem supletivamente a matéria, inclusive o Projeto Político Pedagógico.<br/>
<b>PARÁGRAFO PRIMEIRO</b> – O(s) CONTRATANTE(s) assume(m) total responsabilidade quanto às declarações prestadas neste Contrato e no ato da matrícula relativa à aptidão legal do aluno para frequentar os cursos indicados, concordando, desde já, que a não entrega dos documentos legais comprobatórios das declarações prestadas, até 30 (trinta) dias contados do início das aulas, acarretará automático cancelamento da vaga aberta ao aluno, isentando-se a CONTRATADA de qualquer responsabilidade pelos eventuais danos resultantes.<br/>
<b>PARÁGRAFO SEGUNDO</b> – Obriga(m)-se o(s) CONTRATANTE(s) a fazer com que o aluno cumpra o calendário escolar e os horários estabelecidos pela CONTRATADA, assumindo total responsabilidade pelos problemas advindos da não observância destes.<br/>
<b>PARÁGRAFO TERCEIRO</b> – O(s) CONTRATANTE(s), ao inscrever o aluno em atividades esportivas extracurriculares, reconhece a existência de riscos inerentes a elas, pelo que isenta a CONTRATADA de qualquer responsabilidade, seja civil ou criminal, por eventuais acidentes delas decorrentes.<br/>
<b>PARÁGRAFO QUARTO</b> – O(s) CONTRATANTE(s) cede(m), gratuitamente, o direito de imagem do aluno, para figurar, individualmente ou coletivamente, em campanhas institucionais ou publicitárias da CONTRATADA, para todos os efeitos legais, observada a moral e os bons costumes.<br/>
<b>Inciso I</b> – As peças promocionais, publicitárias e/ou acadêmico de que trata a paragrafo quarto serão veiculadas por tempo indeterminado e em locais e veículos a critério do CONTRATANTE, sempre que convier ao CONTRATANTE.<br/>
<b>PARÁGRAFO QUINTO</b> – A CONTRATADA não se responsabiliza pela guarda e consequente indenização decorrente do extravio ou dos danos causados a qualquer objeto levado ou esquecido ao estabelecimento da CONTRATADA, inclusive papel moeda, aparelhos eletrônicos ou documentos, pertencentes ao(s) CONTRATANTE (s) ou sob a posse do(s) CONTRATANTE(s), do DISCENTE, ou de seus prepostos, ou acompanhantes, o que isenta a CONTRATADA de qualquer responsabilidade, civil ou criminal, exceto se decorrentes de atos de seus subordinados.<br/>
<b>Inciso I</b> – A CONTRATADA não se responsabiliza pelos objetos que o aluno venha a utilizar em seu corpo que possam causar danos ao seu corpo ou em outros alunos, devendo os mesmos ser retirados no horário de educação física, responsabilizando-se o(s) CONTRATANTE(s) por qualquer dano que esses objetos venham causar a terceiros dentro do recinto escolar.<br/>
<b>PARÁGRAFO SEXTO</b> – A CONTRATADA será indenizada pelo(s) CONTRATANTE(s) por qualquer dano ou prejuízo que este ou o aluno, preposto ou acompanhante de qualquer um deles, venha causar nos edifícios, instalações, mobiliários ou equipamentos da CONTRATADA.<br/>
<b>PARÁGRAFO SETIMO</b> – As partes comprometem-se a comunicar, reciprocamente, por escrito, qualquer mudança de endereço sob pena de serem consideradas válidas as correspondências enviadas aos endereços constantes do presente instrumento, inclusive para os efeitos de citação judicial.<br/>
<b>PARÁGRAFO OITAVO</b> – O(s) CONTRATANTE(s) compromete(m)-se a comunicar expressamente à CONTRATADA sobre a existência e o teor de decisões judiciais que venham alterar o regime da guarda do aluno, não se responsabilizando a CONTRATADA por quaisquer fatos que resultem da não observância deste parágrafo.<br/>
<b>Inciso I</b> - Na hipótese de ocorrência de separação judicial ou outra forma de determinação judicial que incorra na substituição da sua condição de responsável legal, o(s) CONTRATANTE(s) expressamente se obriga(m) a comunicar tal à ESCOLA, bem como a quem coube a guarda, e as demais informações complementares sobre a retirada do (a) aluno (a) da Escola) e a dar-lhe substituto idôneo.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA DÉCIMA – DA RENOVAÇÃO DA MATRÍCULA</span><br/>
A CONTRATADA não estará obrigada a renovar a matrícula do beneficiário do(s) CONTRATANTE(s), para o período letivo posterior, caso este não tenha cumprido rigorosamente as cláusulas do presente Contrato.<br/>
</p>
<p class='paragrafo'><span class='destaque'>CLÁUSULA DÉCIMA PRIMEIRA – DO FORO</span><br/>
As partes atribuem ao presente Contrato plena eficácia e força executiva extrajudicial. Fica eleito o foro de Arujá-SP, para dirimir as dúvidas que o presente Contrato possa suscitar.<br/>
E por estarem as partes de acordo com todos os termos e condições do presente instrumento, assinam o presente Contrato, em duas vias de igual teor e forma, juntamente com duas testemunhas, para que produzam todos os efeitos jurídicos.<br/>
</p>

	<p class='paragrafo'>
	
	ARUJA $data
	<br/><br/>
	<br/><br/>
	<br/><br/>
	<table style='width:100%'>
		
		<tr>
			<td style='width:40%;text-align:center;border-top-style:solid;border-top-width:1px'><b>INSTITUTO EDUCACIONAL JR LTDA</b><br/>CNPJ 07.228.276/0001-70</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td  style='width:40%;text-align:center;border-top-style:solid;border-top-width:1px'><b>$contratante_nome</b><br/>CPF $contratante_CPF</td>
		</tr>
	</table> 
	</p>
	<p class='paragrafo'>
	<span class='destaque'>TESTEMUNHAS</span>
	<br/><br/><br/><br/>
	<table style='width:100%'>
		<tr>
			<td style='width:40%;border-top-style:solid;border-top-width:1px'>Nome<br/>RG</td>
			<td> </td>
			<td style='width:40%;border-top-style:solid;border-top-width:1px'>Nome<br/>RG</td>
		</tr>
	</table> 
	</p>
  </body>
</html>
";
// echo $html;
$html2pdf = new HTML2PDF ( 'P', 'A4', 'en' );
$html2pdf->writeHTML ( $html );
$html2pdf->Output ( 'contrato_pdf.pdf' );

?>