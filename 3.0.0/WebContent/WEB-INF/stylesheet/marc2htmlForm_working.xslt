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
			<td>Indiciator 2</td>
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
				<tr>
					<td>
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF6600;" name="controlfieldTag_</xsl:text>
						<xsl:value-of select="$cFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="$Ctag"/>
						<xsl:text disable-output-escaping="yes">" size="2"> </xsl:text>
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
					<td >
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;" name="datafieldTag_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="$tag"/>
						<xsl:text disable-output-escaping="yes">" size="2"> </xsl:text>
					</td>
					<td >
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FF9933;" name="datafieldInd1_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="$ind1"/>
						<xsl:text disable-output-escaping="yes">" size="1"> </xsl:text>
					</td>
					<td >
						<xsl:text disable-output-escaping="yes"><![CDATA[<]]>input
type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #FFCC99;"  name="datafieldInd2_</xsl:text>
						<xsl:value-of select="$dFcounter"/>
						<xsl:text>" value="</xsl:text>
						<xsl:value-of select="$ind2"/>
						<xsl:text disable-output-escaping="yes">" size="1"> </xsl:text>
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
	</xsl:template>
</xsl:stylesheet>
