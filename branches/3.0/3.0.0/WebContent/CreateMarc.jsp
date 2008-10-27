<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create MarcXML</title>
<script type="text/javascript">
<%@include file="script.js"%>
</script>

<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>

</head>
<jsp:include page="common/header.jsp" />
<jsp:include page="common/headerSearch.jsp" />

<body>	
<table class="tabledata">
<tr>
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
   </tr>
</table>
<hr size="4"/>
<form action="CreateNewServlet" method="POST">
<br>
<div class = "radio">
<br>
<input type="radio" name="pidNamespace" value="unisa" checked>Default namespace
</div>
<br>

<table class="tabledata" cellpadding="1">
<tr>
<td>
<input type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #99CCFF;" name=leader  value="01863caa a2200217 a 4500" size="59">
</td>
</tr>
</table>

<div id="data">
<input type="button" value="Add ControlField" class="button" onclick="addRowToTableCtrl();" />
<input type="button" value="Remove ControlField" class="button" onclick="removeRowFromTable('tblCntrl');" />
</div>

<table class="tabledata" cellpadding="5" id ="tblCntrl"></table>

<div id="data">
<input type="button" value="Add DataField" class="button" onclick="addRowToTableData();" />
<input type="button" value="Remove DataField" class="button" onclick="removeRowFromTable('tblData');" />
</div>

<table class="tabledata" cellpadding="5" id = "tblData"></table>

<div id="data"><input type="submit" class="button" value="Ingest"/></div>

</form>
 
	
<div id="data">
<a href="javascript:history.go(-1)">back</a>
</div>

<br>
<br>
	
</body>

<jsp:include page="common/footer.jsp" />
</html>