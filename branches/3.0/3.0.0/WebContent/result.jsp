<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title><%

out.println(request.getAttribute("title")); 

%>

</title>

<script type="text/javascript">
<%@include file="script.js"%>
</script>

<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>
</head>
<jsp:include page="common/header.jsp" />
<jsp:include page="common/headerSearch.jsp" />

<h1>
<%

out.println(request.getAttribute("heading")); 

%>
</h1>
<body>

</body>

<%

out.println(request.getAttribute("body")); 

%>
 

	<div id="data">
<a href="javascript:history.go(-1)">back</a>
</div>


<br/>
<br/>
<jsp:include page="common/footer.jsp" />
</html>