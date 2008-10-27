<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">

    <table id="results_table">
    <thead>
      <tr >
        <th>PID</th>
        <th>InActive Datastreams</th>
        <th>Title</th>
         <th>Author</th>
        <th>Type</th>
         <th>Date</th>
        <th>State</th>
      </tr>
      </thead>
<xsl:choose>
    <xsl:when test="count(Result/item)>0">
		<xsl:for-each select="Result/item">
      
      <xsl:variable name="class">
   <xsl:choose>
    <xsl:when test="(position() mod 2 = 1)">odd</xsl:when>
    <xsl:otherwise>evn</xsl:otherwise>
   </xsl:choose>
   </xsl:variable>
   
      <tr class="{$class}">
      <xsl:variable name="pid" select="pid"/>
        <td><xsl:value-of select="$pid"/></td>
        <td>
        <xsl:for-each select="datastreams/item">
        <xsl:variable name="action" select="state"/>
        <p>
        <xsl:choose>
        <xsl:when test="$action='I'">
        <xsl:variable name="id" select="ID"/>
			<xsl:variable name="value2" select="concat($pid,';',$id)"/>
        <input type="checkbox" name="Dcheck[]"><xsl:attribute name="value"><xsl:value-of select="$value2"/></xsl:attribute><xsl:value-of select="ID"/></input></xsl:when>
        </xsl:choose>
       </p>
        </xsl:for-each>
        </td>
        <td><xsl:value-of select="title"/></td>
        <td><xsl:value-of select="creator"/></td>
         <td><xsl:value-of select="type"/></td>
        <td><xsl:value-of select="date"/></td>
         <td><xsl:value-of select="state"/></td>
      </tr>
      </xsl:for-each>
    </xsl:when>
    <xsl:otherwise>
    <xsl:for-each select="Result">
      
      <xsl:variable name="class">
   <xsl:choose>
    <xsl:when test="(position() mod 2 = 1)">odd</xsl:when>
    <xsl:otherwise>evn</xsl:otherwise>
   </xsl:choose>
   </xsl:variable>
   
      <tr class="{$class}">
      <xsl:variable name="pid" select="pid"/>
        <td><xsl:value-of select="$pid"/></td>
        <td>
        <xsl:for-each select="datastreams/item">
        <xsl:variable name="action" select="state"/>
        <p>
        <xsl:choose>
        <xsl:when test="$action='I'">
        <xsl:variable name="id" select="ID"/>
			<xsl:variable name="value2" select="concat($pid,';',$id)"/>
        <input type="checkbox" name="Dcheck[]"><xsl:attribute name="value"><xsl:value-of select="$value2"/></xsl:attribute><xsl:value-of select="ID"/></input></xsl:when>
        </xsl:choose>
       </p>
        </xsl:for-each>
        </td>
        <td><xsl:value-of select="title"/></td>
        <td><xsl:value-of select="creator"/></td>
         <td><xsl:value-of select="type"/></td>
        <td><xsl:value-of select="date"/></td>
         <td><xsl:value-of select="state"/></td>
      </tr>
      </xsl:for-each>
    
    </xsl:otherwise>
   </xsl:choose>      
      
      
    </table>
 
</xsl:template>
 

</xsl:stylesheet> 


