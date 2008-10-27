<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>

<title>Login Page</title>

</head>
<body>
<jsp:include page="common/header.jsp" />
<div id="header-search">
  
</div>

<div id = "data">
<h1>Login</h1>
</div>
<form method=post action="j_security_check" >
<br/>
<br/>
<div id = "dataLogin">
<label>
User Name:</label>
<input type="text"  name= "j_username" >

<br/>
<br/>
<label>&nbsp;&nbsp;Password:</label>
<input type="password"  name= "j_password" >


</div>
<br/>
<br/>
<br/>
<br/>
<div id = "data">
<!-- 
<input type ="submit" value = "Login">
 -->
<input type="submit" value="Login" class="button">
<br/>
</div>
<br/>
<br/>
<!-- 
<a href="javascript:history.go(-1)">back</a>

<form method=post action="j_security_check" >
 <p>Enter your UserID:<input type="text"  name= "j_username" ></p>
 <p>Enter your Password:<input type="password"  name= "j_password" ></p>
 <p><input type ="submit" value = "Login"></p>
 
 -->
 
</form> 

</body>
<jsp:include page="common/footer.jsp" />
</html>