<?xml version="1.0" encoding="windows-1252" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:import href="estilo.css"></xsl:import>
	<xsl:template match="/">
		<SCRIPT language="JavaScript">
					function MouseOver(Parent,Sub_Email) {
						Sub_Email.style.visibility = "visible";
						Parent.style.visibility = "visible";
					}
					function MouseOut(Sub_Email) {						
						Sub_Email.style.visibility = "hidden";
						//if (Parent != NULL)
						//	Parent.style.visibility = "hidden";											
					}
					function MouseOut2(Parent,Sub_Email) {						
						Sub_Email.style.visibility = "hidden";
						Parent.style.visibility = "hidden";											
					}					
					function MouseMoveVertical(Parent,Child) {																	
						Child.style.posTop =  Parent.offsetTop +  window.MenuPrincipal.offsetTop; 																		
						Child.style.posLeft = Parent.offsetWidth; 
						Child.style.visibility = "visible";
					}													
					function MouseMoveHorizontal(DivParent, Parent,Child,count) {																															
						Child.style.posTop =  DivParent.offsetTop + Parent.offsetTop;
						Child.style.posLeft = (parseInt(count) ) * 200 + Parent.offsetWidth; 
						Child.style.visibility = "visible";
					}			
					function MouseClick(Sub_Email) {						
						Sub_Email.style.visibility = "hidden";
					}					
			</SCRIPT>
		<HTML>
			<HEAD>
				<xsl:apply-imports />
				<script src="Forms/funcoes.js"></script>
				<script src="Forms/funcoes.vb" language="VbScript"></script>
			</HEAD>
			<BODY topmargin="0" leftmargin="0">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
					<tr>
						<td align="center" colspan="2" height="50" bgcolor="#3171B5">
						<font face="Verdana" size="6" color="#FFFFFF"><b>Exemplo de Impressão Fiscal</b></font></td>
					</tr>
					<tr>
						<td width="228" valign="top" align="left"> a
							<xsl:apply-templates select="ROOT" />
						</td>
						<td>
							<iframe name="frame_principal" src="forms/principal.htm" scrolling="no" frameborder="0"
								height="100%" width="100%" style="margin-left: 9"></iframe>
						</td>
					</tr>
					<tr>
						<td align="center" height="20" colspan="2" background="img/barra_baixo.gif"><font face="Verdana" size="1">Copyright © Bematech Tecnologia em Automação S/A.</font></td>
					</tr>
				</table>
			</BODY>
		</HTML>
	</xsl:template>
	<!-- TEMPLATE QUE PROCESSA O ROOT -->
	<xsl:template match="ROOT">
		<xsl:call-template name="TEMPLATEROOT" /> <!-- TEMPLATE QUE GERA A TABELA HORIZONTAL DE MENU -->
		<xsl:apply-templates select="ITEM" />
	</xsl:template>
	<!-- TEMPLATE PARA PROCESSAR AS TAGS ITEM -->
	<xsl:template match="ITEM">
		<xsl:if test="@TYPE = 'ROOT'">
			<xsl:apply-templates select="SUBITEMS" />
		</xsl:if>
	</xsl:template>
	<!-- TEMPLATE PARA PROCESSAR AS TAGS SUBITEMS -->
	<xsl:template match="SUBITEMS">
		<xsl:call-template name="TEMPLATENODE" />
		<xsl:apply-templates select="ITEM" />
	</xsl:template>
	<!-- TEMPLATE QUE GERA A TABELA HORIZONTAL DE MENU -->
	<xsl:template name="TEMPLATEROOT">
		<DIV ID="MenuPrincipal" class="FirsMenu">
			<TABLE border="0" cellpadding="0" cellspacing="0" width="200">
				<xsl:for-each select="ITEM">
					<tr>
						<TD height="20" class="outros" onmouseover="className='outros_over'">
							<xsl:if test="@TYPE = 'ROOT'">
								<xsl:attribute name="onmouseout">MouseOut(<xsl:value-of select="@NAME" />),className='outros'</xsl:attribute>
								<xsl:attribute name="onmousemove">MouseMoveVertical(this,<xsl:value-of select="@NAME" />)</xsl:attribute>
							</xsl:if>						
							 <img border="0" src="img/img_seta.gif" align="right" width="14" height="14"></img>
							 <xsl:value-of select="position()"></xsl:value-of>- <xsl:value-of select="@CAPTION" /> 							 										
					</TD>
					</tr>
				</xsl:for-each>
			</TABLE>
		</DIV>
	</xsl:template>
	<xsl:template name="TEMPLATENODE">
		<div class="tabela">
			<xsl:attribute name="onMouseOut">
				MouseOut2(<xsl:value-of select="ancestor::ITEM[attribute::TYPE='ROOT']/@NAME" />,this)
			</xsl:attribute>
			<xsl:attribute name="id">
				<xsl:value-of select="parent::ITEM/@NAME" />
			</xsl:attribute>
			<xsl:attribute name="onMouseOver">MouseOver(<xsl:value-of select="ancestor::ITEM[attribute::TYPE='ROOT']/@NAME" />,this)</xsl:attribute>
			<table border="0" cellpadding="0" cellspacing="0" width="200">
				<xsl:for-each select="ITEM">
					<TR>
						<xsl:if test="@TYPE = 'ROOT'">
							<TD height="20" class="outros" onmouseover="className='outros_over'">
								<xsl:attribute name="onmousemove">
									MouseMoveHorizontal(<xsl:value-of select="ancestor::ITEM[attribute::TYPE='ROOT']/@NAME" />,this,<xsl:value-of select="@NAME" />,<xsl:value-of select="count(ancestor::ITEM[attribute::TYPE='ROOT'])" />)
								</xsl:attribute>
								<xsl:attribute name="onMouseOut">
									MouseOut(<xsl:value-of select="@NAME" />),className='outros'
								</xsl:attribute>
								<img border="0" src="img/img_seta.gif" align="right" width="14" height="14"></img><xsl:value-of select="position()"></xsl:value-of>- <xsl:value-of select="@CAPTION" />
							</TD>
						</xsl:if>
						<xsl:if test="@TYPE = 'NODE'">
							<xsl:if test="@LINK">
								<a target="frame_principal">
									<xsl:attribute name="href">Forms/<xsl:value-of select="@LINK" /></xsl:attribute>
									<TD height="20" class="outros" onmouseover="className='outros_over'" onMouseOut="className='outros'"
										onmousedown="className='outros_click'">
										<xsl:attribute name="onclick">
										MouseClick(<xsl:value-of select="ancestor::ITEM[attribute::TYPE='ROOT']/@NAME" />)
									</xsl:attribute>
										<xsl:value-of select="position()"></xsl:value-of>- <xsl:value-of select="@CAPTION" />
									</TD>
								</a>
							</xsl:if>
							<xsl:if test="@FUNCTION">
								<TD height="20" class="outros" onmouseover="className='outros_over'" onMouseOut="className='outros'">
									<xsl:attribute name="onclick">
									MouseClick(<xsl:value-of select="ancestor::ITEM[attribute::TYPE='ROOT']/@NAME" />);className='outros_click';<xsl:value-of select="@FUNCTION" />
								</xsl:attribute>
									<xsl:value-of select="position()"></xsl:value-of>- <xsl:value-of select="@CAPTION" />
								</TD>
							</xsl:if>
						</xsl:if>
					</TR>
				</xsl:for-each>
			</table>
		</div>
	</xsl:template>
</xsl:stylesheet>
