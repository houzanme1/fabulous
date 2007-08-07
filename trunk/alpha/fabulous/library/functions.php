<?php

function search_formA(){

  ?>
 <form action="search.php?id=activate" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}

function search_formD(){

  ?>
 <form action="search.php?id=deactivate" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}

function test()
{
  ?>
    <h1>Functions</h1><ul id="function">
<li class="first linear"><a href="" class="selected ">Add Metadata Tag</a></li>
<li class="linear"><a href="">Delete Metadata Tag</a></li>
<li class="linear"><a href="">Edit Metadata Tag</a></li>
</ul>
  <?php
}

function search_formE(){

  ?>
 <form action="search.php?id=edit" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}

function top_navigation() {

?>
<div id="navigation">
<ul>
	<li class="first"><a href="index.php">Home</span></a></li>
	<li><a href="searchform.php?id=activate"><span>Activate Datastream</span></a></li>
	<li><a href="searchform.php?id=deactivate"><span>De-Activate Datastream</span></a></li>
	<li><a href="ingest.php"><span>Batch Content Ingest</span></a></li>
	<li><a href="edit.php"><span>Batch Metadata Editing</span></a></li>
	<li><a href="help.php"><span>Help</span></a></li>
	<li><a href="logout.php"><span>Logout</span></a></li>
</ul>
</div>

<?php
}

function function_implementation($fields)
{
  print_r($fields);
  ?>
  <form action="edit.php" method="post" >
  <?php
        foreach ($fields as $key=>$val) {
            print '<input type=hidden name="pids[]" value="'.$val.'">';
            }
   ?>
	  <fieldset>
 <legend>Select the functionality:</legend>
  <table class="formdata_preview" width="100%" border=0>
      <tbody>
        <tr>
          <td colspan="2" valign=top>
           <div align="right"><span class="small">
               <a href="javascript:open_window('Functionality.html');">help?</a></span></div>
          </td>
        </tr>
        <tr>
          <td valign=top width="25%"> <strong>*</strong> Function Type: </td>
          <td>
            <select onchange="hideAll(this);" size=1 name=function_type>
              <option value="">Select Function ...</option>
              <option value="Edit">Edit</option>
              <option value="Add">Add</option>
              <option value="Delete">Delete</option>
           </select>
    	   <span id="function_type_error" >&nbsp;</span>
          </td>
        </tr>
      </tbody>
  </table>
 </fieldset>

<br/>

<!-- START Function TYPE DIVS -->

<!-- EDIT DATA ENtrY ELEMENTS -->

<DIV id="Edit" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Edit Functionality </LEGEND>
 <TABLE width="100%" border=0>
  <TBODY>
  <tr bgColor=#cccccc>
     <td colspan="2" valign=top><div align="right"><span class="small"><a href="javascript:open_window('edit.html');">help?</a></span></div></td>
          </tr>
  <tr>
    <td width="25%">Edit:</td>
    <td><input name=edit></td>
  </tr>

  </TBODY>
 </TABLE>
 </FIELDSET>
 <br>
</DIV>

<!-- ADD DATA ENtrY ELEMENTS -->

<DIV id="Add" style="display:none">
<FIELDSET><LEGEND>Additional information - About the Add functionality </LEGEND>
<TABLE width="100%" border=0>
  <TBODY>
  <tr >
          <td  colspan="8" valign=top><div align="right"><span class="small"><a href="javascript:open_window('add.html');">help?</a></span></div></td>
          </tr>
   <table  width="100%" id="function">
  <tbody>

  <tr >
    <td colspan="8"> Datafield (<i id="count_label">First</i>)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; </td>
    <td> <strong>*</strong> Datafield tag:</td>
    <td><input name=datafieldtag > <span id="function_error" >&nbsp;</span></td>
    <td>ind1:<input name=ind1> </td>
    <td>ind2:<input name=ind2 > </td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; </td>
    <td>Subfield Code: </td>
    <td><input name=subfieldCode ></td>
    <td>Subfield Value: </td>
    <td><input name=subfieldValue ></td>
  </tr>

  </tbody>
 </table>

 <div id="multiple_creators"></div>

 <!--
 <p>
 <a onclick="addField('creator','multiple_creators');" href="javascript:;">
 <B>+</B> Add another MARCXML Datafield</A>
 </p>

 -->

 </TBODY>
 </TABLE>
 </FIELDSET>
 <br>
</DIV>

<!-- Delete DATA ENtrY ELEMENTS -->

<DIV id="Delete" style="display:none">
<FIELDSET>
 <LEGEND>Additional information - About the Delete Functionality </LEGEND>
 <TABLE width="100%" border=0>
  <TBODY>
  <tr >
          <td colspan="3" valign=top><div align="right"><span class="small"><a href="javascript:open_window('delete.html');">help?</a></span></div></td>
          </tr>
  <table class="formdata_preview" width="100%" id="creator">
  <tbody>
  
  <tr >
    <td colspan="8"> Datafield (<i id="count_label">First</i>)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; </td>
    <td> <strong>*</strong> Datafield tag:</td>
    <td><input name=dataFieldtag class="submitCreatorInput"> <span id="creator_last_name_error" class="error">&nbsp;</span></td>

  </tr>


  </tbody>
 </table>

 <div id="multiple_creators"></div>

 <!--
 <p>
 <a onclick="addField('creator','multiple_creators');" href="javascript:;">
 <B>+</B> Add another MARCXML Datafield</A>
 </p>
 -->

 </TBODY>
 </TABLE>
 </FIELDSET>
 <br>
</DIV>

<fieldset>
  <legend>Submission</legend>
  <p align=center> <input type="submit" name="submit" value="Submit" /> </p>
 </fieldset>

</form>
  <?php
}

function bottom_tags()
{
?>
<p id="imagefooter">


<a href="http://www.arrow.edu.au"><img
src="./include/images/arrowlogo.gif"
alt="Valid XHTML 1.0 Strict" height="40" width="50" /></a>
<a href="http://www.fedora.info"><img
src="./include/images/fedoralogo.gif"
alt="Valid XHTML 1.0 Strict" height="50" width="60" /></a>
<a href="http://validator.w3.org/check?uri=referer">
<img src="./include/images/xhtml.png" alt="Valid XHTML 1.0 Strict" height="15" width="60" /></a>
</div>
<?php
}


function UPLOADER($num_of_uploads, $file_types_array=array("xml","doc","pdf", "gif", "jpg"), $max_file_size=100048576, $upload_dir="./library/uploads/"){
  
  $uploadedFile=Array();
   global $dictionary;
 // print_r($GLOBALS);

  if(!is_numeric($max_file_size)){
  $max_file_size = 100048576;
  }
  if(!isset($_POST["submitted"])){
   $form = "<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>Upload files:<br /><input type='hidden' name='submitted' value='TRUE' id='".time()."'><input type='hidden' name='MAX_FILE_SIZE' value='".$max_file_size."'>";
   for($x=0;$x<$num_of_uploads;$x++){
     $form .= "<input type='file' name='file[]'><font color='red'>*</font><br />";
   }
  $form .="<br /><tr><td >Label: </td><td ><input type='text' name='label' id='label' value='CONTENT'></td></tr><br /><br />";
   $form .= "<input type='submit' value='Upload'><br /><font color='red'>*</font>Maximum file length (minus extension) is 15 characters. Anything over that will be cut to only 15 characters. Valid file type(s): ";
   for($x=0;$x<count($file_types_array);$x++){
     if($x<count($file_types_array)-1){
       $form .= $file_types_array[$x].", ";
     }else{
       $form .= $file_types_array[$x].".";
     }
   }
   $form .= "</form>";
   echo($form);
  }else{
    $dictionary["ingestLabel"] = $_POST['label'];
   foreach($_FILES["file"]["error"] as $key => $value){
     if($_FILES["file"]["name"][$key]!=""){
       if($value==UPLOAD_ERR_OK){
         $origfilename = $_FILES["file"]["name"][$key];
         $filename = explode(".", $_FILES["file"]["name"][$key]);
         $filenameext = $filename[count($filename)-1];
         unset($filename[count($filename)-1]);
         $filename = implode(".", $filename);
         $filename = substr($filename, 0, 15).".".$filenameext;
         $file_ext_allow = FALSE;
         for($x=0;$x<count($file_types_array);$x++){
           if($filenameext==$file_types_array[$x]){
             $file_ext_allow = TRUE;
           }
         }
         if($file_ext_allow){
           if($_FILES["file"]["size"][$key]<$max_file_size){
             if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $upload_dir.$filename)){
               array_push($uploadedFile, $filename);
               echo("File uploaded successfully to the Server Buffer. - <a href='".$upload_dir.$filename."' target='_blank'>".$filename."</a><br />");
             }else{
               echo($origfilename." was not successfully uploaded<br />");
             }
           }else{
             echo($origfilename." was too big, not uploaded<br />");
           }
         }else{
           echo($origfilename." had an invalid file extension, not uploaded<br />");
         }
       }else{
         echo($origfilename." was not successfully uploaded<br />");
       }
     }
   }
  }
 // print_r($uploadedFile);
  return $uploadedFile;
}

// Extract raw XML from node.
function dumpNode($node)
{
	$result = $node->asXML();
	$left = strpos($result,"?>");
	$left = strpos($result,">", $left + 2);
	$right = strrpos($result,"<");
	$return = substr($result,$left + 1, $right - $left - 1);
	$return = str_replace("&amp;", "&", $return);
	return $return;
}

// Workaround: Get tagName from XML node.
function getTagName($node)
{
	$result = ($node->asXML());
	$right = strpos($result,">", 2);
	$left = strpos($result," ", 2);
	if($left != "" && $left < $right)
		$right = $left;
	
	return substr($result, 1, $right - 1);
}

function authenticate($user, $pass, $host, $port, $ver, $index)
{
    global $dictionary;
    $servers=$dictionary['servers'];
    $server=$servers[$index];
    if($user===$server['user'] && $pass===$server['password'] && $host===$server['host'] && $port===$server['port'] && $ver===$server['version'])
    {
      return true;
    }
    else
    {
      return false;
    }
}

function loginForm()
{
  global $dictionary;
  $servers= $dictionary['servers'];
  $serverCount=count($servers) ;
 // print_r($serverCount);
  ?>
       <form method="post" name="frmLogin" id="frmLogin">
<table>
<tr>
<td >Host Name</td>
<td >
<select name = "server" id="server">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['host'].":".$counter.">".$server['host']."</option>";
 }
?>
  </select>
</tr>
<tr>
<td >Port</td>
<td >

<select name = "port" id="port">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['port'].">".$server['port']."</option>";
 }
?>
  </select>
</tr>

<tr>
<td >Version</td>
<td >

<select name = "ver" id="ver">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['version'].">".$server['version']."</option>";
 }
?>
  </select>
</tr>

<tr>
<td >User Id</td>
<td >


<select name = "txtUserId" id="txtUserId">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['user'].">".$server['user']."</option>";
 }
?>
  </select></td>
</tr>



<tr>
<td >Password</td>
<td ><input name="txtPassword" type="password" id="txtPassword"></td>
</tr>
<tr>
<td >&nbsp;</td>
<td ><input type="submit" name="btnLogin" value="Login"></td>
</tr>
</table>
</form>
<?php
}
// Return locale string.
function get($key)
{
	global $dictionary;
	if(isset($dictionary[$key])) return $dictionary[$key];
	else return "[" . $key . "]";
}

function load_config($file)
{
        global $dictionary;


   if(!file_exists($file))
   	return;

   // Load via SimpleXML.
   $xml_document = simplexml_load_file($file);

   // Add all of the settings to the dictionary.
   foreach ($xml_document->xpath('/settings/*') as $item)
   {
   	$item_content = dumpNode($item);
   	$item_name = getTagName($item);
   	if($item_name[strlen($item_name)-1] == "/")
   		$item_name = substr($item_name, 0, strlen($item_name)-1); 
   	$dictionary["$item_name"] = $item_content;
   }

   $servers=array();
   $uploadFileType=array();
   // Add all of the languages to the dictionary.
   foreach($xml_document->xpath('/settings/servers/server') as $item)
   {
     //print_r($item);
     $temp=object2array($item);
     array_push($servers, $temp);
   }
   
    foreach($xml_document->xpath('/settings/uploadFileType') as $item)
   {
     $temp=object2array($item);
     array_push($uploadFileType, $temp);
   }

   $dictionary["servers"] = $servers;
   $dictionary["uploadFileType"] = $uploadFileType;
 //  print_r($dictionary);

}


function object2array($object)
{
   $return = NULL;
       
   if(is_array($object))
   {
       foreach($object as $key => $value)
           $return[$key] = object2array($value);
   }
   else
   {
       $var = get_object_vars($object);
       if($var)
       {
           foreach($var as $key => $value)
               $return[$key] = object2array($value);
       }
       else
           return $object;
   }

   return $return;
}



load_config("configuration/config.xml");
?>