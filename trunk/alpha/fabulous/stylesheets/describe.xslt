<?xml version="1.0" encoding="ISO-8859-1"?><xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
  <body>
    <h1><xsl:value-of select="Result/repositoryName"/></h1>
    <table  id="results_table">
<thead>

</thead>
   
    <tr class="evn">
      <th>repositoryVersion :</th>
      <th><xsl:value-of select="Result/repositoryVersion"/></th>
    </tr>
    
     <tr class="odd">
    <th>repositoryBaseURL :</th>
      <th><xsl:value-of select="Result/repositoryBaseURL"/></th>
    </tr>
    
       <tr class="evn">
    <th>repositoryPIDNamespace :</th>
      <th><xsl:value-of select="Result/repositoryPIDNamespace"/></th>
    </tr>
    
       <tr class="odd">
    <th>OAINamespace :</th>
      <th><xsl:value-of select="Result/OAINamespace"/></th>
    </tr>
    
       <tr class="evn">
    <th>adminEmailList :</th>
      <th><xsl:value-of select="Result/adminEmailList/item"/></th>
    </tr>
    
       <tr class="odd">
    <th>defaultExportFormat :</th>
      <th><xsl:value-of select="Result/defaultExportFormat"/></th>
    </tr>
    
   
    </table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>