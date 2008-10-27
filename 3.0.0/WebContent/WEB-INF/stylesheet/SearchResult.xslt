<?xml version="1.0" encoding="utf-8"?>
<!-- convert XML into the edit functionality html form, written by prashant Pandey <prashant.pandey@unisa.edu.au> -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">

    <table class="tabledata">
    <thead>
      <tr >
        <th>Select</th>
        <th>PID</th>
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
      
      <td>
        <input type="checkbox" name="Dcheck[]"><xsl:attribute name="value"><xsl:value-of select="$pid"/></xsl:attribute></input>
        
        </td>
        <td><xsl:value-of select="$pid"/></td>
        
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
      
      <td>
        <input type="checkbox" name="Dcheck[]"><xsl:attribute name="value"><xsl:value-of select="$pid"/></xsl:attribute></input>
        
        </td>
        <td><xsl:value-of select="$pid"/></td>
        
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



