<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Search</title>

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
	
	<%-- Form Handler Code --%>
	


<% 
// to be erazed...only for testing
String options="";
options= request.getParameter("options");


//out.println("<div id=\"error\"><p>Your selected Option is "+options+"</p></div>");
%>

<%
if(options.compareToIgnoreCase("RW")== 0)
{
	%>
	<div id="data">
	<h1>Repository Wide Selection</h1>
	</div>
	
<div id ="main">


	
<form action="ProcessRWSearch" method="POST">

<fieldset>


 <LEGEND>Search Field - (for repository wide Modification leave search box blank</LEGEND>

		<br/>
		<label>Search:</label> 
        
        <select name="QueryTag">
				<option value="1">Title</option>
				<option value="2">Creator</option>
				<option value="3" selected>Keyword Search</option>
			</select>
			
			<input type="text" name="searchString" size="100"/>
			<br/>
			<br/>
			
	

 
 </fieldset>
 <br/>
<br/>


<fieldset>
 <legend>Select the functionality:</legend>
 <br/>
			
  <table class="formdata_preview" width="100%" border=0>
      <tbody>

        <tr>
          <td valign=top width="25%"> <strong>*</strong> Function Type: </td>
          <td>
            <select onchange="hideAll(this);" size=1 name=function_type>
              <option value="">Select Function ...</option>
              <option value="EditO">Modify Object Properties</option>
              <option value="EditD">Modify datastream Properties</option>
               <option value="MAdd">Add Datafield (Metadata)</option>
                <option value="MDel">Remove Datafield (Metadata)</option>
                 <option value="MReplace">Search and replace(Metadata)</option>
           </select>
          </td>
        </tr>
      </tbody>
  </table>
 </fieldset>

<br/>


<DIV id="EditO" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Modify Object Properties Functionality </LEGEND>
  
	
 <br/>
 <br/>
 <br/>
 <div id = "data">
 <table>
 
  <tr>
    <td width="25%">Label:</td>
    <td><input name=labelO size="100" value="no change"></td>
  </tr>
   <tr>
    <td width="25%">Owner ID:</td>
    <td><input name=OwnerID size="100" value="no change"><font color="red"> <strong>*</strong> Currently not supported</font></td>
  </tr>
  <tr>
    <td width="25%">State:</td>
    <td><select name="stateO">
              <option value="I">In-active</option>
              <option value="A">Active</option>
              <option value="no change" selected>no change</option>
           </select></td>
  </tr>
  
  
  </table>
  </div>
		<br/><br/><br/>
			<div id="data"><input type="submit" name="submit" class="button" value="Modify Objects">
			</div>
			
	
   

 </FIELDSET>
 <br/>
</DIV>

<DIV id="EditD" style="display:none">
<FIELDSET>
 <LEGEND>Additional information - About the Edit Datastream Properties Functionality </LEGEND>
 
   
    <br/>
    <br/>
    <br/>
	<table>
	<tr>
    <td width="25%">Enter Datastream ID to be Processed:</td>
    <td><input name=datastreamIDs></td>
  </tr>
 </table>
 <br/>
 <br/>
 <br/>
 <div id = "data">
 <table>
  <tr>
    <td width="25%">Alternate ID:</td>
    <td><input name=alternateID size="150" value="no change"></td>
  </tr>
  <tr>
    <td width="25%">Format URI:</td>
    <td><input name=formatURI size="150" value="no change"></td>
  </tr>
  <tr>
    <td width="25%">Label:</td>
    <td><input name=label size="150" value="no change"></td>
  </tr>
  <tr>
    <td width="25%">Datastream ID:</td>
    <td><input name=datastreamIDt value="no change"></td>
  </tr>
  <tr>
    <td width="25%">State:</td>
    <td><select name="state">
              <option value="I">In-active</option>
              <option value="A">Active</option>
              <option value="no change" selected>no change</option>
           </select></td>
  </tr>
  <tr>
    <td width="25%">Versionable:</td>
    <td><select name="versionable">
              <option value="true">false</option>
              <option value="false">true</option>
              <option value="no change" selected>no change</option>
           </select></td>
  </tr>
  </table>
  </div>
		<br/><br/><br/>
			<div id="data"><input type="submit" name="submit" class="button" value="Update Properties">
			</div>
			
		

 
 </FIELDSET>
</DIV>


<DIV id="MAdd" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Add Datafield (Metadata) Functionality </LEGEND>
  
	
 <br/>
 <br/>
 <div id = "data">
 
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
 
 <table class="tabledata" cellpadding="5" id="tblData">
 <tr>
 <td><input type="text" STYLE="color: black; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #9acd32;" name="datafieldTag_1" value="" size="2"> </td>
 <td>
 <select name="datafieldInd1_1" STYLE="color: black; font-family: Verdana;font-weight: bold; font-size: 12px;background-color: #FF9933;">
 <option value=" ">_</option>
 <option value="0">0</option>
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 <option value="6">6</option>
 <option value="7">7</option>
 <option value="8">8</option>
 <option value="9">9</option>
 </select>
 </td>
 <td>
 <select name="datafieldInd2_1" STYLE="color: black; font-family: Verdana;font-weight: bold; font-size: 12px;background-color: #FFCC99;">
 <option value=" ">_</option>
 <option value="0">0</option>
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 <option value="6">6</option>
 <option value="7">7</option>
 <option value="8">8</option>
 <option value="9">9</option>
 </select>
 </td>
 <td>
 <table class="tabledataS"  id="tblSub1" cellpadding="2"> 
 <tr>
 <td>
 <input type="text" STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CC99CC;" name="subfield_1_1" value="" size="1"> 
 </td>
 <td>
 <textarea rows="2" cols="80"  STYLE="color: black font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #CCCCCC;" name="subvalue_1_1"></textarea>
 </td>
 </tr>
 </table> 
 </td>
 <td>
 <input type="button" class="buttonS" value="+" title="Add Subfield" onclick="addSubfieldTest2(1);" > 
 <input type="button" class="buttonS" value="-" title="Remove Subfield" onclick="removeSubField(1);" > 
 </td>
 </tr>
 </table>
  </div>
		<br/>
			<div id="data"><input type="submit" name="submit" class="button" value="Add Datafield">
			</div>
 </FIELDSET>
 <br/>
</DIV>

<DIV id="MDel" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Remove Datafield (Metadata) Functionality </LEGEND>
  
	
 <br/>
 <br/>
 <br/>
 <div id = "data">
 <table>
 
 
 <tr><td> <strong>*</strong> Datafield tag:</td> <td><input name=dataFieldtagR > </td></tr>
 
 </table>
  </div>
		<br/><br/><br/>
			<div id="data"><input type="submit" name="submit" class="button" value="Remove Datafield">
			</div>
 </FIELDSET>
 <br/>
</DIV>

<DIV id="MReplace" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Search and Replace (Metadata) Functionality </LEGEND>
  
	
 <br/>
 <br/>
 <br/>
 <div id = "data">
 <table>
 <tr><td width="25%">Find What:</td><td><input size="100" name=sourceR></td></tr>
 <tr><td width="25%">Replace with:</td><td><input size="100" name=destinationR></td></tr>
 </table>
  </div>
		<br/><br/><br/>
			<div id="data"><input type="submit" name="submit" class="button" value="Modify Metadata">
			</div>
 </FIELDSET>
 <br/>
</DIV>





	</form>
</div>

<% 
}

else if(options.compareToIgnoreCase("DEFAULT")== 0)
{
	%>
	
	
	<div id="data">
	<h1>Manual Search Selection</h1>
	</div>
<form action="DisplaySearchResults" method="POST">
	
	<div class = "radio"><br>
	
	<br>
</div>
	<div class = "radio"><br>
	

<input type="radio" name="processaction" value="1">Activate DataStream
<input type="radio" name="processaction" value="2">De-Activate datastream
<input type="radio" name="processaction" value="3" checked>Batch Metadata Editing
<input type="radio" name="processaction" value="4">Batch Deletion


	
</div>
	
	<div id = "main">
		<br/>
			<br/>
		<label>Search:</label> 
        
        <select name="QueryTag">
				<option value="1">Title</option>
				<option value="2">Creator</option>
				<option value="3" selected>Keyword Search</option>
			</select>
			
			<input type="text" name="searchString" size="100"/>
			<br/>
			<br/>
        <label>Maximum Number of Results (Per Page):</label>
        <select name="MaxResults">
				<option value="20" selected>20</option>
				<option value="40">40</option>
				<option value="60">60</option>
				<option value="80">80</option>
			</select>
			<br/>
			<br/>
			
			
			<br/>
			<br/>
			<div id="data"><input type="submit" name="submit" class="button" value="search"></div>
			</div>
		</form>
		
		
	<%
}

%>


	<div id="data">
<a href="javascript:history.go(-1)">back</a>
</div>	
		
		
	</body>
	<jsp:include page="common/footer.jsp" />
</html>