<%@ page isErrorPage="true" import="java.io.*" %>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Error Page</title>
<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>
		
	</head>
	
	<body>
	
	<div class="error">
	<%-- Exception Handler --%>
<font color="red">
<br>
<br>
<br>
<%= exception.toString() %>
<br>
<br>
<br>
</font>
</div>

<%
out.println("<!--");
StringWriter sw = new StringWriter();
PrintWriter pw = new PrintWriter(sw);
exception.printStackTrace(pw);
out.print(sw);
sw.close();
pw.close();
out.println("-->");
%>
			
	</body>
</html>