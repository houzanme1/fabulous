<?xml version="1.0" encoding="UTF-8"?>
<!-- Source: http://www.loc.gov/standards/marcxml/xslt/MARC21slim2OAIDC.xsl -->
<!-- MARCXML to DC conversion modified by prashant Pandey <prashant.pandey@unisa.edu.au> -->
<xsl:stylesheet version="1.0" xmlns:marc="http://www.loc.gov/MARC21/slim" xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" exclude-result-prefixes="marc">
	<xsl:output method="xml" indent="yes"/>
	<!--Added ISBN and deleted attributes 6/04 jer-->
	<xsl:template match="/">
		<xsl:if test="marc:collection">
			<!-- Was: <oai_dc:dcCollection>-->
			<xsl:for-each select="marc:collection">
				<xsl:for-each select="marc:record">
					<oai_dc:dc>
						<xsl:apply-templates select="."/>
					</oai_dc:dc>
				</xsl:for-each>
			</xsl:for-each>
			<!--Was: </oai_dc:dcCollection>-->
		</xsl:if>
		<xsl:if test="marc:record">
			<oai_dc:dc>
				<xsl:apply-templates/>
			</oai_dc:dc>
		</xsl:if>
	</xsl:template>
	<xsl:template match="marc:record">
		<xsl:variable name="leader" select="marc:leader"/>
		<xsl:variable name="leader6" select="substring($leader,7,1)"/>
		<xsl:variable name="leader7" select="substring($leader,8,1)"/>
		<xsl:variable name="controlField008" select="marc:controlfield[@tag=008]"/>
		<!-- TITLE -->
		<xsl:for-each select="marc:datafield[@tag=245]/marc:subfield[@code='a']">
			<dc:title>
				<xsl:value-of select="."/>
			</dc:title>
		</xsl:for-each>
		<!-- CREATOR -->
		<xsl:for-each select="marc:datafield[@tag=100]/marc:subfield[@code='a']">
			<dc:creator>
				<xsl:value-of select="."/>
			</dc:creator>
		</xsl:for-each>
		<!-- CONTRIBUTOR/CREATOR -->
		<xsl:for-each select="marc:datafield[@tag=700]">
			<xsl:variable name="editor" select="marc:subfield[@code='e']"/>
			<xsl:variable name="nameValue" select="marc:subfield[@code='a']"/>
			<xsl:choose>
				<xsl:when test="$editor = 'Editor' or $editor = 'Supervisor'">
					<dc:contributor>
						<xsl:value-of select="$nameValue"/>
					</dc:contributor>
				</xsl:when>
				<xsl:otherwise>
					<dc:creator>
						<xsl:value-of select="$nameValue"/>
					</dc:creator>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:for-each>
		<!-- CONTRIBUTOR/AFFILIATION -->
		<xsl:for-each select="marc:datafield[@tag=710]">
			<xsl:variable name="school" select="marc:subfield[@code='b']"/>
			<xsl:variable name="university" select="marc:subfield[@code='a']"/>
			<dc:contributor>
				<xsl:value-of select="concat($school,', ',$university)"/>
			</dc:contributor>
		</xsl:for-each>
		<!-- RESOURCE TYPE -->
		<xsl:for-each select="marc:datafield[@tag=655]/marc:subfield[@code='a']">
			<dc:type>
				<xsl:value-of select="."/>
			</dc:type>
		</xsl:for-each>
		<!-- PUBLISHER -->
		<xsl:for-each select="marc:datafield[@tag=260]/marc:subfield[@code='b']">
			<dc:publisher>
				<xsl:value-of select="."/>
			</dc:publisher>
		</xsl:for-each>
		<!-- DATE -->
		<xsl:for-each select="marc:datafield[@tag=260]/marc:subfield[@code='c']">
			<dc:date>
				<xsl:value-of select="."/>
			</dc:date>
		</xsl:for-each>
		<!-- LANGUAGE -->
		<xsl:variable name="lang" select="marc:datafield[@tag=546]/marc:subfield[@code='a']"/>
		<xsl:choose>
			<xsl:when test="$lang!=''">
				<dc:language>
					<xsl:value-of select="$lang"/>
				</dc:language>
			</xsl:when>
			<xsl:otherwise>
				<dc:language>eng</dc:language>
			</xsl:otherwise>
		</xsl:choose>
		<!-- FORMAT -->
		<xsl:for-each select="marc:datafield[@tag=856]/marc:subfield[@code='q']">
			<dc:format>
				<xsl:value-of select="."/>
			</dc:format>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=300]">
			<dc:format>
				<xsl:call-template name="subfieldSelect">
					<xsl:with-param name="codes">abc</xsl:with-param>
				</xsl:call-template>
			</dc:format>
		</xsl:for-each>
		<!-- DESCRIPTION -->
		<xsl:for-each select="marc:datafield[@tag=520]/marc:subfield[@code='a']">
			<dc:description>
				<xsl:value-of select="."/>
			</dc:description>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=521]/marc:subfield[@code='a']">
			<dc:description>
				<xsl:value-of select="."/>
			</dc:description>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=502]/marc:subfield[@code='a']">
			<dc:description>
				<xsl:value-of select="."/>
			</dc:description>
		</xsl:for-each>
		<!-- SUBJECT -->
		<xsl:for-each select="marc:datafield[@tag=600]/marc:subfield[@code='a']">
			<dc:subject>
				<xsl:value-of select="."/>
			</dc:subject>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=610]/marc:subfield[@code='a']">
			<dc:subject>
				<xsl:value-of select="."/>
			</dc:subject>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=611]/marc:subfield[@code='a']">
			<dc:subject>
				<xsl:value-of select="."/>
			</dc:subject>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=630]/marc:subfield[@code='a']">
			<dc:subject>
				<xsl:value-of select="."/>
			</dc:subject>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=650]/marc:subfield[@code='a']">
			<dc:subject>
				<xsl:value-of select="."/>
			</dc:subject>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=653]/marc:subfield[@code='a']">
			<xsl:variable name="sub" select="."/>
			<xsl:if test="$sub!=''">
				<dc:subject>
					<xsl:value-of select="$sub"/>
				</dc:subject>
			</xsl:if>
		</xsl:for-each>
		<!-- COVERAGE/COLLECTION FOR OAI SETS -->
		<dc:coverage>ARROW@UNISA</dc:coverage>
		
		<xsl:variable name="rType" select="marc:datafield[@tag=655]/marc:subfield[@code='a']"/>
		

		<xsl:if test="$rType='image'">
				<dc:coverage>Pictures Australia</dc:coverage>
			</xsl:if>
			
			<xsl:if test="$rType='thesis'">
				<dc:coverage>ADT</dc:coverage>
			</xsl:if>
		
		
		<!-- RELATION -->
		<xsl:for-each select="marc:datafield[@tag=711]|marc:datafield[@tag=830]">
			<dc:relation>
				<xsl:call-template name="subfieldSelect">
					<xsl:with-param name="codes">acdv</xsl:with-param>
				</xsl:call-template>
			</dc:relation>
		</xsl:for-each>
		<!-- IDENTIFIER -->
		<xsl:for-each select="marc:datafield[@tag=020]/marc:subfield[@code='a']">
			<xsl:variable name="isbn" select="."/>
			<xsl:if test="$isbn >= 1">
				<dc:identifier>
					<xsl:value-of select="concat('ISBN:',$isbn)"/>
				</dc:identifier>
			</xsl:if>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=022]/marc:subfield[@code='a']">
			<xsl:variable name="issn" select="."/>
			<xsl:if test="$issn >= 1">
				<dc:identifier>
					<xsl:value-of select="concat('ISSN:',$issn)"/>
				</dc:identifier>
			</xsl:if>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=583]/marc:subfield[@code='u']">
			<xsl:variable name="idt" select="."/>
			<xsl:if test="$idt!=''">
				<xsl:choose>
					<xsl:when test="starts-with($idt,'http')">
						<xsl:variable name="doi" select="substring-after($idt,'http://dx.doi.org/')"/>
						<dc:identifier>
							<xsl:value-of select="concat('DOI:',$doi)"/>
						</dc:identifier>
					</xsl:when>
					<xsl:otherwise>
						<dc:identifier>
							<xsl:value-of select="$idt"/>
						</dc:identifier>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:if>
		</xsl:for-each>
		<!-- RIGHTS -->
		<xsl:for-each select="marc:datafield[@tag=506]/marc:subfield[@code='a']">
			<dc:rights>
				<xsl:value-of select="."/>
			</dc:rights>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=540]/marc:subfield[@code='a']">
			<dc:rights>
				<xsl:value-of select="."/>
			</dc:rights>
		</xsl:for-each>
		<!-- SOURCE -->
		<xsl:for-each select="marc:datafield[@tag=787]">
			<dc:source>
				<xsl:call-template name="subfieldSelect">
					<xsl:with-param name="codes">tg</xsl:with-param>
				</xsl:call-template>
			</dc:source>
		</xsl:for-each>
		<xsl:for-each select="marc:datafield[@tag=541]/marc:subfield[@code='a']">
			<dc:source>
				<xsl:value-of select="."/>
			</dc:source>
		</xsl:for-each>
		<!--</oai_dc:dc>-->
	</xsl:template>
	<!-- 8/19/04: ntra added "marc:" prefix to datafield element -->
	<xsl:template name="datafield">
		<xsl:param name="tag"/>
		<xsl:param name="ind1">
			<xsl:text> </xsl:text>
		</xsl:param>
		<xsl:param name="ind2">
			<xsl:text> </xsl:text>
		</xsl:param>
		<xsl:param name="subfields"/>
		<xsl:element name="marc:datafield">
			<xsl:attribute name="tag"><xsl:value-of select="$tag"/></xsl:attribute>
			<xsl:attribute name="ind1"><xsl:value-of select="$ind1"/></xsl:attribute>
			<xsl:attribute name="ind2"><xsl:value-of select="$ind2"/></xsl:attribute>
			<xsl:copy-of select="$subfields"/>
		</xsl:element>
	</xsl:template>
	<xsl:template name="subfieldSelect">
		<xsl:param name="codes">abcdefghijklmnopqrstuvwxyz</xsl:param>
		<xsl:param name="delimeter">
			<xsl:text> </xsl:text>
		</xsl:param>
		<xsl:variable name="str">
			<xsl:for-each select="marc:subfield">
				<xsl:if test="contains($codes, @code)">
					<xsl:value-of select="text()"/>
					<xsl:value-of select="$delimeter"/>
				</xsl:if>
			</xsl:for-each>
		</xsl:variable>
		<xsl:value-of select="substring($str,1,string-length($str)-string-length($delimeter))"/>
	</xsl:template>
	<xsl:template name="buildSpaces">
		<xsl:param name="spaces"/>
		<xsl:param name="char">
			<xsl:text> </xsl:text>
		</xsl:param>
		<xsl:if test="$spaces>0">
			<xsl:value-of select="$char"/>
			<xsl:call-template name="buildSpaces">
				<xsl:with-param name="spaces" select="$spaces - 1"/>
				<xsl:with-param name="char" select="$char"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
	<xsl:template name="chopPunctuation">
		<xsl:param name="chopString"/>
		<xsl:param name="punctuation">
			<xsl:text>.:,;/ </xsl:text>
		</xsl:param>
		<xsl:variable name="length" select="string-length($chopString)"/>
		<xsl:choose>
			<xsl:when test="$length=0"/>
			<xsl:when test="contains($punctuation, substring($chopString,$length,1))">
				<xsl:call-template name="chopPunctuation">
					<xsl:with-param name="chopString" select="substring($chopString,1,$length - 1)"/>
					<xsl:with-param name="punctuation" select="$punctuation"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:when test="not($chopString)"/>
			<xsl:otherwise>
				<xsl:value-of select="$chopString"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="chopPunctuationFront">
		<xsl:param name="chopString"/>
		<xsl:variable name="length" select="string-length($chopString)"/>
		<xsl:choose>
			<xsl:when test="$length=0"/>
			<xsl:when test="contains('.:,;/[ ', substring($chopString,1,1))">
				<xsl:call-template name="chopPunctuationFront">
					<xsl:with-param name="chopString" select="substring($chopString,2,$length - 1)"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:when test="not($chopString)"/>
			<xsl:otherwise>
				<xsl:value-of select="$chopString"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<!-- reusable replace-string function -->
	<xsl:template name="replace-string">
		<xsl:param name="text"/>
		<xsl:param name="from"/>
		<xsl:param name="to"/>
		<xsl:choose>
			<xsl:when test="contains($text, $from)">
				<xsl:variable name="before" select="substring-before($text, $from)"/>
				<xsl:variable name="after" select="substring-after($text, $from)"/>
				<xsl:variable name="prefix" select="concat($before, $to)"/>
				<xsl:value-of select="$before"/>
				<xsl:value-of select="$to"/>
				<xsl:call-template name="replace-string">
					<xsl:with-param name="text" select="$after"/>
					<xsl:with-param name="from" select="$from"/>
					<xsl:with-param name="to" select="$to"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$text"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c)1998-2003 Copyright Sonic Software Corporation. All rights reserved.
<metaInformation>
<scenarios/><MapperInfo srcSchemaPath="" srcSchemaRoot="" srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no"/>
</metaInformation>
-->
