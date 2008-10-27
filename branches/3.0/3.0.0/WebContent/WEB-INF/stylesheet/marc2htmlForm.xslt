<?xml version="1.0" encoding="UTF-8"?>
<!-- edited with XMLSpy v2007 (http://www.altova.com) by Prashant Pandey (University of South Australia Library) -->
<!-- Source: http://www.loc.gov/standards/marcxml/xslt/MARC21slim2OAIDC.xsl -->
<!-- MARCXML to DC conversion modified by prashant Pandey <prashant.pandey@unisa.edu.au> -->
<xsl:stylesheet version="1.0" xmlns:marc="http://www.loc.gov/MARC21/slim" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" exclude-result-prefixes="marc">
	<xsl:output method="xml" indent="yes"/>
	<!--Added ISBN and deleted attributes 6/04 jer-->
	<xsl:template match="/">
		<xsl:if test="marc:collection">
			<xsl:for-each select="marc:collection">
				<xsl:for-each select="marc:record">
					<xsl:apply-templates select="."/>
				</xsl:for-each>
			</xsl:for-each>
		</xsl:if>
		<xsl:if test="marc:record">
			<xsl:apply-templates/>
		</xsl:if>
	</xsl:template>
	<xsl:template match="marc:record">
		<table class="tabledata">
			<td STYLE="color: #99CCFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #99CCFF;">P</td>
			<td>Leader</td>
			<td STYLE="color: #FF6600; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF6600;">P</td>
			<td>ControlField tag</td>
			<td STYLE="color: #9acd32; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;">P</td>
			<td>DataField tag</td>
			<td STYLE="color: #FF9933; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF9933;">P</td>
			<td>Indicator 1</td>
			<td STYLE="color: #FFCC99; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FFCC99;">P</td>
			<td>Indicator 2</td>
			<td STYLE="color: #CC99CC; font-family: Verdana; font-weight: bold; font-size: 12px; background-color:  #CC99CC;">P</td>
			<td>Subfield</td>
			<td STYLE="color: #CCCCCC; font-family: Verdana; font-weight: bold; font-size: 12px; background-color:  #CCCCCC;">P</td>
			<td>Value</td>
		</table>
		<hr size="4"> </hr>
		<!-- leader -->
		
		<table class="tabledata">
		<xsl:for-each select="marc:leader">
		<xsl:variable name="leaderV" select="."/>
			<td>
				<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #99CCFF;" name="leader" value="</xsl:text>
				<!--  	<xsl:text>" value="</xsl:text>-->
				<xsl:value-of select="$leaderV"/>
				<xsl:text disable-output-escaping="yes">" size="59"> </xsl:text>
			</td>
			</xsl:for-each>
		</table>
		
		
		
		
		<div id="data">
			<input type="button" value="Add ControlField" class="button" onclick="addRowToTableCtrl();"/>
			<input type="button" value="Remove ControlField" class="button" onclick="removeRowFromTable('tblCntrl');"/>
		</div>
		
		<!-- controlfield -->
		<table class="tabledata" cellpadding="5" id="tblCntrl">
			<xsl:for-each select="marc:controlfield">
				<xsl:variable name="Ctag" select="@tag"/>
				<xsl:variable name="cFcounter" select="position()"/>
				<xsl:variable name="cFTagName" select="concat('controlfieldTag_',$cFcounter)"/>
				<tr>
					<td>
					<xsl:element name="select">
	     <xsl:attribute name="STYLE">
     <xsl:text>color: black; </xsl:text><xsl:text>font-family: Verdana;</xsl:text><xsl:text>font-weight: bold;</xsl:text><xsl:text> font-size: 12px;</xsl:text><xsl:text>background-color: #FF6600;</xsl:text>
  </xsl:attribute>
	     <xsl:attribute name="name">
		<xsl:value-of select="$cFTagName" />
	     </xsl:attribute>
	     
	     
	     <xsl:choose>
										<xsl:when test="$Ctag='001'">
											<option value="001" selected="true">001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='002'">
											<option value="001">001</option>
											<option value="002" selected="true">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='003'">
											<option value="001">001</option>
											<option value="002">002</option>
											<option value="003" selected="true">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='004'">
											<option value="001" >001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" selected="true">004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='005'">
											<option value="001" >001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005" selected="true">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='006'">
											<option value="001">001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006" selected="true">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='007'">
											<option value="001" >001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" selected="true">007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='008'">
											<option value="001" >001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008" selected="true">008</option>
											<option value="009" >009</option>
										</xsl:when>
										<xsl:when test="$Ctag='009'">
											<option value="001" >001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" selected="true">009</option>
										</xsl:when>
										<xsl:otherwise>
											<option value="001">001</option>
											<option value="002">002</option>
											<option value="003">003</option>
											<option value="004" >004</option>
											<option value="005">005</option>
											<option value="006">006</option>
											<option value="007" >007</option>
											<option value="008">008</option>
											<option value="009" >009</option>
										</xsl:otherwise>
									</xsl:choose>
	   </xsl:element>
					
				
									
						
					</td>
					<td>
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CCCCCC;" name="controlfieldValue_</xsl:text>
						<xsl:value-of select="$cFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="."/>
						<xsl:text disable-output-escaping="yes">" size="50"> </xsl:text>
					</td>
				</tr>
			</xsl:for-each>
		</table>
		<!-- datafield -->
		<div id="data">
			<input type="button" value="Add DataField" class="button" onclick="addRowToTableData();"/>
			<input type="button" value="Remove DataField" class="button" onclick="removeRowFromTable('tblData');"/>
		</div>
		<table class="tabledata" cellpadding="5" id="tblData">
			<xsl:for-each select="marc:datafield">
				<xsl:variable name="dFcounter" select="position()"/>
				<tr>
					<xsl:variable name="tag" select="@tag"/>
					<xsl:variable name="ind1" select="@ind1"/>
					<xsl:variable name="ind2" select="@ind2"/>
					<td> <input type="button" class="buttonS" value="X" title="Remove DataField" onClick="RemoveInnerDatafield(this);" /></td>
					<td >
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;" name="datafieldTag_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="$tag"/>
						<xsl:text disable-output-escaping="yes">" size="2"> </xsl:text>
					</td>
					<td >
					<xsl:element name="select">
							<xsl:attribute name="name"><xsl:value-of select="concat('datafieldInd1_',$dFcounter)"/></xsl:attribute>
							<xsl:attribute name="STYLE"><xsl:text>color: black; </xsl:text><xsl:text>font-family: Verdana;</xsl:text><xsl:text>font-weight: bold;</xsl:text><xsl:text> font-size: 12px;</xsl:text><xsl:text>background-color: #FF9933;</xsl:text></xsl:attribute>
							<xsl:choose>
								<xsl:when test="$ind1=' '">
									<option value=" " selected="true">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='0'">
									<option value=" ">_</option>
									<option value="0" selected="true">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='1'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1" selected="true">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='2'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2" selected="true">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='3'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3" selected="true">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='4'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4" selected="true">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='5'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5" selected="true">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='6'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6" selected="true">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='7'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7" selected="true">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind1='8'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8" selected="true">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:otherwise>
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:otherwise>
							</xsl:choose>
						</xsl:element>
					
					</td>
					<td >
					<xsl:element name="select">
							<xsl:attribute name="name"><xsl:value-of select="concat('datafieldInd2_',$dFcounter)"/></xsl:attribute>
							<xsl:attribute name="STYLE"><xsl:text>color: black; </xsl:text><xsl:text>font-family: Verdana;</xsl:text><xsl:text>font-weight: bold;</xsl:text><xsl:text> font-size: 12px;</xsl:text><xsl:text>background-color: #FFCC99;</xsl:text></xsl:attribute>
							<xsl:choose>
								<xsl:when test="$ind2=' '">
									<option value=" " selected="true">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='0'">
									<option value=" ">_</option>
									<option value="0" selected="true">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='1'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1" selected="true">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='2'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2" selected="true">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='3'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3" selected="true">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='4'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4" selected="true">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='5'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5" selected="true">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='6'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6" selected="true">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='7'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7" selected="true">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='8'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8" selected="true">8</option>
									<option value="9">9</option>
								</xsl:when>
								<xsl:when test="$ind2='9'">
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9" selected="true">9</option>
								</xsl:when>
								<xsl:otherwise>
									<option value=" ">_</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</xsl:otherwise>
							</xsl:choose>
						</xsl:element>
					
					</td>
					<td>
	<!--<table class="tabledata" cellpadding="2" id="tblData">-->
	<xsl:text disable-output-escaping="yes"><![CDATA[<]]>table class="tabledataS"  id="tblSub</xsl:text>
	<xsl:value-of select="$dFcounter"/>
	<xsl:text>"</xsl:text>
	<xsl:text disable-output-escaping="yes"> cellpadding="2"> </xsl:text>
	
	<xsl:for-each select="marc:subfield">
	
		<xsl:variable name="sFcounter" select="position()"/>
		<xsl:variable name="subfield" select="@code"/>
			<xsl:variable name="value" select="."/>
			
		<tr>
			
			<td >
				<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CC99CC;" name="subfield_</xsl:text>
				<xsl:value-of select="$dFcounter"/>
				<xsl:text>_</xsl:text>
				<xsl:value-of select="$sFcounter"/>
				<xsl:text>" value="</xsl:text>
				<xsl:value-of select="$subfield"/>
				<xsl:text disable-output-escaping="yes">" size="1"> </xsl:text>
			</td>
			
			<td>
				<xsl:choose>
					<xsl:when test="$tag='520'">
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>textarea rows="10" cols="80"  STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CCCCCC;" name="subvalue_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>_</xsl:text>
						<xsl:value-of select="$sFcounter"/>
						<xsl:text disable-output-escaping="yes">"></xsl:text>
						<xsl:value-of select="$value"/>
						<xsl:text disable-output-escaping="yes"><![CDATA[</]]>textarea></xsl:text>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>textarea rows="2" cols="80"  STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CCCCCC;" name="subvalue_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>_</xsl:text>
						<xsl:value-of select="$sFcounter"/>
						<xsl:text disable-output-escaping="yes">"></xsl:text>
						<xsl:value-of select="$value"/>
						<xsl:text disable-output-escaping="yes"><![CDATA[</]]>textarea></xsl:text>
					</xsl:otherwise>
				</xsl:choose>
			</td>
			
		</tr>
		
	</xsl:for-each>
	
	<xsl:text disable-output-escaping="yes"><![CDATA[</]]>table</xsl:text>
	<xsl:text disable-output-escaping="yes">> </xsl:text>
</td>

					<td>
						<!--<input type="button" value="+" class="buttonS" title="Add Subfield" onclick="addSubfieldTest2('+iteration+');" />-->
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input type="button" class="buttonS" value="+" title="Add Subfield" onclick="addSubfieldTest2(</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>);</xsl:text>
						<xsl:text disable-output-escaping="yes">" > </xsl:text>
						<!--<input type="button"  value="-" class="buttonS" title="Remove Subfield" onclick="removeSubField('+iteration+');" />-->
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input type="button" class="buttonS" value="-" title="Remove Subfield" onclick="removeSubField(</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>);</xsl:text>
						<xsl:text disable-output-escaping="yes">" > </xsl:text>
					</td>
				</tr>
			</xsl:for-each>
		</table>
		
		<div id="data">
			<input type="button" value="Add DataField" class="button" onclick="addRowToTableData();"/>
			<input type="button" value="Remove DataField" class="button" onclick="removeRowFromTable('tblData');"/>
		</div>
		
	</xsl:template>
</xsl:stylesheet>
