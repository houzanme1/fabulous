<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Home</title>
<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>
		
	</head>
	<jsp:include page="common/header.jsp" />
	
	<jsp:include page="common/headerSearch.jsp" />
	<body>
	
	<form action="search.jsp" method="POST">
	
	<div class = "radio">
	<br>
	<br>
	<br>
	
	<input type="radio" name="options" value="RW" DISABLED> Repository Wide selection

<input type="radio" name="options" value="DEFAULT" checked> Manual Search Selection
<p>
<em>Note: Included for future release. Use this functionality (multiple selection) through the third party Front end applications such as VITAL etc by following the user guide.</em>
  </p>	
	
	<br>
	<br>
	<br>
</div>		
			<div id="data"><input type="submit" class="button" value="Procced"></div>
			
		</form>
		
	</body>
	<jsp:include page="common/footer.jsp" />
</html>